<?php

namespace App\Core\Database;

class Database {
    protected $db_user;
    protected $db_host;
    protected $db_name;
    protected $db_pass;
    
    public function __construct($db_name, $db_host = 'localhost', $db_user = 'root', $db_pass = '')
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

}