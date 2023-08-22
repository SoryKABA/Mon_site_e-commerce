<?php

namespace App\Core\DbAuth;

use App\Core\Database\Database;

class DbAuth {

    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function user()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['auth'];
        if ($id === null) {
            return null;
        }
        $user = $this->db->prepare("SELECT * FROM users WHERE id = ?", [$id], null, true);
        return $user ?: null;
    }

    public function login($adressMail, $password)
    {
        $user = $this->db->prepare("SELECT * FROM users WHERE userlogin = ?", [$adressMail], null, true);
        if ($user) {
            if (password_verify($password, $user->password)) {
                $_SESSION['auth'] = $user->id;
                return true;
            }
        }
        return false;
    }

    public function logged()
    {
        return isset($_SESSION['auth']);
    }
}