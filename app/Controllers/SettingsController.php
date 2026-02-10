<?php

namespace app\Controllers;

use core\Controller;
use core\Model;

class SettingsController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /dashboard");
            exit;
        }
    }

    public function index() {
        $db = \core\Database::getInstance();
        $stmt = $db->query("SELECT * FROM settings");
        $settings = $stmt->fetchAll();

        $set = [];
        foreach($settings as $s) {
            $set[$s['setting_key']] = $s['setting_value'];
        }

        $this->view('settings/index', [
            'title' => 'إعدادات النظام',
            'active_menu' => 'settings',
            'settings' => $set
        ]);
    }
}
