<?php

namespace app\Controllers;

use core\Controller;
use app\Models\Room;
use app\Models\Booking;

class DashboardController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $base = (strpos($scriptName, 'index.php') !== false) ? str_replace('/public/index.php', '', $scriptName) : '';
            $url = $protocol . "://" . $host . $base . '/auth';
            header("Location: " . $url);
            exit;
        }
    }

    public function index() {
        $roomModel = new Room();
        $bookingModel = new Booking();

        $rooms = $roomModel->getWithDetails();
        $activeBookings = $bookingModel->getActiveWithDetails();

        $stats = [
            'total_rooms' => count($rooms),
            'available_rooms' => count(array_filter($rooms, fn($r) => $r['status'] == 'available')),
            'busy_rooms' => count(array_filter($rooms, fn($r) => $r['status'] == 'busy')),
            'dirty_rooms' => count(array_filter($rooms, fn($r) => $r['status'] == 'dirty')),
        ];

        $this->view('dashboard/index', [
            'title' => 'لوحة التحكم',
            'active_menu' => 'dashboard',
            'rooms' => $rooms,
            'stats' => $stats,
            'activeBookings' => $activeBookings
        ]);
    }
}
