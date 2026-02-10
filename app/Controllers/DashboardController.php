<?php

namespace app\Controllers;

use core\Controller;
use app\Models\Room;
use app\Models\Booking;

class DashboardController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /auth");
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
