<?php

namespace app\Controllers;

use core\Controller;
use core\Database;

class AccountingController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /auth");
            exit;
        }
    }

    public function index() {
        $db = Database::getInstance();

        // Get Accounts and their current balances
        $sql = "SELECT a.*,
                (SELECT SUM(debit) - SUM(credit) FROM journal_items WHERE account_id = a.id) as balance
                FROM accounts a";
        $accounts = $db->query($sql)->fetchAll();

        $this->view('accounting/index', [
            'title' => 'الإدارة المالية',
            'active_menu' => 'accounting',
            'accounts' => $accounts
        ]);
    }

    public function journal() {
        $db = Database::getInstance();
        $entries = $db->query("SELECT * FROM journal_entries ORDER BY id DESC")->fetchAll();

        $this->view('accounting/journal', [
            'title' => 'قيود اليومية',
            'active_menu' => 'accounting',
            'entries' => $entries
        ]);
    }

    public function voucher_receipt() {
        $this->view('accounting/voucher_receipt', [
            'title' => 'سند قبض',
            'active_menu' => 'accounting'
        ]);
    }

    public function voucher_payment() {
        // Get expense accounts
        $db = Database::getInstance();
        $expenses = $db->query("SELECT * FROM accounts WHERE type = 'expense'")->fetchAll();

        $this->view('accounting/voucher_payment', [
            'title' => 'سند صرف',
            'active_menu' => 'accounting',
            'expenses' => $expenses
        ]);
    }

    public function save_voucher() {
        if ($this->isPost()) {
            $db = Database::getInstance();
            $db->beginTransaction();
            try {
                $type = $_POST['voucher_type']; // receipt or payment
                $amount = $_POST['amount'];
                $desc = $_POST['description'];
                $date = $_POST['date'] ?: date('Y-m-d');

                $stmt = $db->prepare("INSERT INTO journal_entries (entry_date, description, reference) VALUES (?, ?, ?)");
                $stmt->execute([$date, $desc, ucfirst($type) . " Voucher"]);
                $entry_id = $db->lastInsertId();

                if ($type == 'receipt') {
                    // Receipt: Debit Cash (1101), Credit Account (X)
                    $credit_acc_id = $_POST['credit_account_id'];

                    $stmt = $db->prepare("INSERT INTO journal_items (entry_id, account_id, debit, credit) VALUES (?, (SELECT id FROM accounts WHERE code = '1101'), ?, ?)");
                    $stmt->execute([$entry_id, $amount, 0]); // Debit Cash

                    $stmt = $db->prepare("INSERT INTO journal_items (entry_id, account_id, debit, credit) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$entry_id, $credit_acc_id, 0, $amount]); // Credit Account
                } else {
                    // Payment: Debit Expense (X), Credit Cash (1101)
                    $debit_acc_id = $_POST['debit_account_id'];

                    $stmt = $db->prepare("INSERT INTO journal_items (entry_id, account_id, debit, credit) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$entry_id, $debit_acc_id, $amount, 0]); // Debit Expense

                    $stmt = $db->prepare("INSERT INTO journal_items (entry_id, account_id, debit, credit) VALUES (?, (SELECT id FROM accounts WHERE code = '1101'), ?, ?)");
                    $stmt->execute([$entry_id, 0, $amount]); // Credit Cash
                }

                $db->commit();
                $this->redirect('/accounting');
            } catch (\Exception $e) {
                $db->rollBack();
                die("Error: " . $e->getMessage());
            }
        }
    }
}
