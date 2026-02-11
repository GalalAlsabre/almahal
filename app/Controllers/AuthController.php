<?php

namespace app\Controllers;

use core\Controller;
use app\Models\User;

class AuthController extends Controller {
    public function index() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login', [], null);
    }

    public function login() {
        if ($this->isPost()) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['full_name'] = $user['full_name'];
                $this->redirect('/dashboard');
            } else {
                $this->view('auth/login', ['error' => 'خطأ في اسم المستخدم أو كلمة المرور'], null);
            }
        } else {
            $this->redirect('/auth');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/auth');
    }
}
