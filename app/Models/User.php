<?php

namespace app\Models;

use core\Model;

class User extends Model {
    protected $table = 'users';

    public function login($username, $password) {
        $user = $this->query("SELECT * FROM users WHERE username = ?", [$username])->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
