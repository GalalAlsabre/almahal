<?php

namespace app\Controllers;

use core\Controller;
use core\Database;

class ReportsController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /auth");
            exit;
        }
    }

    public function index() {
        $this->view('reports/index', [
            'title' => 'التقارير المالية',
            'active_menu' => 'reports'
        ]);
    }

    public function trial_balance() {
        $db = Database::getInstance();
        $sql = "SELECT a.code, a.name,
                SUM(ji.debit) as total_debit,
                SUM(ji.credit) as total_credit
                FROM accounts a
                LEFT JOIN journal_items ji ON a.id = ji.account_id
                GROUP BY a.id";
        $data = $db->query($sql)->fetchAll();

        $this->view('reports/trial_balance', [
            'title' => 'ميزان المراجعة',
            'active_menu' => 'reports',
            'data' => $data
        ]);
    }

    public function income_statement() {
        $db = Database::getInstance();

        $revenues = $db->query("SELECT a.name, SUM(ji.credit) - SUM(ji.debit) as balance
                                FROM accounts a JOIN journal_items ji ON a.id = ji.account_id
                                WHERE a.type = 'revenue' GROUP BY a.id")->fetchAll();

        $expenses = $db->query("SELECT a.name, SUM(ji.debit) - SUM(ji.credit) as balance
                                FROM accounts a JOIN journal_items ji ON a.id = ji.account_id
                                WHERE a.type = 'expense' GROUP BY a.id")->fetchAll();

        $this->view('reports/income_statement', [
            'title' => 'قائمة الدخل (الأرباح والخسائر)',
            'active_menu' => 'reports',
            'revenues' => $revenues,
            'expenses' => $expenses
        ]);
    }
}
