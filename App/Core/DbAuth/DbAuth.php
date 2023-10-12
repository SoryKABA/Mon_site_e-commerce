<?php

namespace App\Core\DbAuth;

use App\Core\Database\Database;

class DbAuth {

    protected $db;
    protected $table;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function logged()
    {
        return isset($_SESSION['auth']);
    }

    
}