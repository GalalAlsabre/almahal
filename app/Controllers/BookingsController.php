<?php

namespace app\Controllers;

use core\Controller;
use app\Models\Room;
use app\Models\Guest;
use app\Models\Booking;
use app\Models\User; // Not really needed here but anyway

class BookingsController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /auth");
            exit;
        }
    }

    public function index() {
        $bookingModel = new Booking();
        $bookings = $bookingModel->getActiveWithDetails();
        $this->view('bookings/index', [
            'title' => 'إدارة الحجوزات',
            'active_menu' => 'bookings',
            'bookings' => $bookings
        ]);
    }

    public function new() {
        $roomId = $_GET['room_id'] ?? null;
        if (!$roomId) { $this->redirect('/dashboard'); }

        $roomModel = new Room();
        $room = $roomModel->query("SELECT r.*, rt.name as type_name, rt.base_price
                                   FROM rooms r JOIN room_types rt ON r.type_id = rt.id
                                   WHERE r.id = ?", [$roomId])->fetch();

        $this->view('bookings/new', [
            'title' => 'تسكين جديد',
            'active_menu' => 'bookings',
            'room' => $room
        ]);
    }

    public function create() {
        if ($this->isPost()) {
            $db = \core\Database::getInstance();
            $db->beginTransaction();
            try {
                // 1. Guest
                $guestModel = new Guest();
                $guest_name = $_POST['guest_name'];
                $phone = $_POST['phone'];
                $id_number = $_POST['id_number'];

                $guestModel->query("INSERT INTO guests (name, phone, id_number) VALUES (?, ?, ?)", [$guest_name, $phone, $id_number]);
                $guest_id = $db->lastInsertId();

                // 2. Booking
                $room_id = $_POST['room_id'];
                $check_in = date('Y-m-d');
                $deposit = $_POST['deposit'] ?? 0;

                $bookingModel = new Booking();
                $bookingModel->query("INSERT INTO bookings (guest_id, room_id, check_in_date, paid_amount, status) VALUES (?, ?, ?, ?, 'active')",
                    [$guest_id, $room_id, $check_in, $deposit]);
                $booking_id = $db->lastInsertId();

                // 3. Update Room Status
                $roomModel = new Room();
                $roomModel->query("UPDATE rooms SET status = 'busy' WHERE id = ?", [$room_id]);

                // 4. Accounting Entry (Deposit)
                if ($deposit > 0) {
                    $this->createJournalEntry($db, "قبض عربون من النزيل: $guest_name", "Booking #$booking_id", [
                        ['code' => '1101', 'debit' => $deposit, 'credit' => 0], // الصندوق
                        ['code' => '1201', 'debit' => 0, 'credit' => $deposit]  // ذمم النزلاء
                    ]);
                }

                $db->commit();
                $this->redirect('/dashboard');
            } catch (\Exception $e) {
                $db->rollBack();
                die("Error: " . $e->getMessage());
            }
        }
    }

    private function createJournalEntry($db, $desc, $ref, $items) {
        $stmt = $db->prepare("INSERT INTO journal_entries (entry_date, description, reference) VALUES (DATE('now'), ?, ?)");
        $stmt->execute([$desc, $ref]);
        $entry_id = $db->lastInsertId();

        foreach ($items as $item) {
            // Fetch account ID by code
            $accStmt = $db->prepare("SELECT id FROM accounts WHERE code = ?");
            $accStmt->execute([$item['code']]);
            $account = $accStmt->fetch();
            $account_id = $account['id'];

            $stmt = $db->prepare("INSERT INTO journal_items (entry_id, account_id, debit, credit) VALUES (?, ?, ?, ?)");
            $stmt->execute([$entry_id, $account_id, $item['debit'], $item['credit']]);
        }
    }

    public function checkout_view() {
        $roomId = $_GET['room_id'] ?? null;
        if (!$roomId) { $this->redirect('/dashboard'); }

        $bookingModel = new Booking();
        $booking = $bookingModel->query("SELECT b.*, g.name as guest_name, r.room_number, rt.base_price, rt.name as type_name
                                         FROM bookings b
                                         JOIN guests g ON b.guest_id = g.id
                                         JOIN rooms r ON b.room_id = r.id
                                         JOIN room_types rt ON r.type_id = rt.id
                                         WHERE r.id = ? AND b.status = 'active'", [$roomId])->fetch();

        if (!$booking) { $this->redirect('/dashboard'); }

        // Calculate nights
        $check_in = new \DateTime($booking['check_in_date']);
        $today = new \DateTime(date('Y-m-d'));
        $diff = $check_in->diff($today);
        $nights = $diff->days;
        if ($nights == 0) $nights = 1; // Minimum 1 night

        $total_room_charge = $nights * $booking['base_price'];
        $remaining = $total_room_charge - $booking['paid_amount'];

        $this->view('bookings/checkout', [
            'title' => 'تسجيل خروج',
            'active_menu' => 'bookings',
            'booking' => $booking,
            'nights' => $nights,
            'total_room_charge' => $total_room_charge,
            'remaining' => $remaining
        ]);
    }

    public function checkout_process() {
        if ($this->isPost()) {
            $booking_id = $_POST['booking_id'];
            $db = \core\Database::getInstance();
            $db->beginTransaction();
            try {
                $bookingModel = new Booking();
                $booking = $bookingModel->query("SELECT b.*, g.name as guest_name, r.id as room_id
                                                 FROM bookings b
                                                 JOIN guests g ON b.guest_id = g.id
                                                 JOIN rooms r ON b.room_id = r.id
                                                 WHERE b.id = ?", [$booking_id])->fetch();

                $total_final = $_POST['total_final'];
                $remaining_paid = $_POST['remaining_paid'];

                // 1. Update Booking
                $bookingModel->query("UPDATE bookings SET actual_check_out = CURRENT_TIMESTAMP, total_amount = ?, paid_amount = paid_amount + ?, status = 'completed' WHERE id = ?",
                    [$total_final, $remaining_paid, $booking_id]);

                // 2. Update Room Status -> dirty
                $db->prepare("UPDATE rooms SET status = 'dirty' WHERE id = ?")->execute([$booking['room_id']]);

                // 3. Accounting Entries
                // Entry A: Revenue Recognition (Total stay charge)
                // From Receivables to Revenue
                $this->createJournalEntry($db, "إيراد إقامة: " . $booking['guest_name'], "Booking #$booking_id", [
                    ['code' => '1201', 'debit' => $total_final, 'credit' => 0], // ذمم النزلاء
                    ['code' => '4101', 'debit' => 0, 'credit' => $total_final]  // إيرادات الإقامة
                ]);

                // Entry B: Payment of remaining (if any)
                if ($remaining_paid > 0) {
                    $this->createJournalEntry($db, "تحصيل متبقي من النزيل: " . $booking['guest_name'], "Booking #$booking_id", [
                        ['code' => '1101', 'debit' => $remaining_paid, 'credit' => 0], // الصندوق
                        ['code' => '1201', 'debit' => 0, 'credit' => $remaining_paid]  // ذمم النزلاء
                    ]);
                }

                $db->commit();
                $this->redirect('/dashboard');
            } catch (\Exception $e) {
                $db->rollBack();
                die("Error: " . $e->getMessage());
            }
        }
    }
}
