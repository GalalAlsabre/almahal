<?php

namespace app\Controllers;

use core\Controller;
use app\Models\Room;
use app\Models\RoomType;

class RoomsController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /auth");
            exit;
        }
    }

    public function index() {
        $roomModel = new Room();
        $roomTypeModel = new RoomType();

        $rooms = $roomModel->getWithDetails();
        $types = $roomTypeModel->all();

        $this->view('rooms/index', [
            'title' => 'إدارة الغرف',
            'active_menu' => 'rooms',
            'rooms' => $rooms,
            'types' => $types
        ]);
    }

    public function update_status() {
        if ($this->isPost()) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $roomModel = new Room();
            $roomModel->query("UPDATE rooms SET status = ? WHERE id = ?", [$status, $id]);
            $this->json(['success' => true]);
        }
    }
}
