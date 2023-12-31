<?php

namespace App\Core\Config;

class Config {

    private $settings = [];
    private static $_instance;

    public function __construct($file)
    {
        $this->settings[] = require ($file); 
    }

    public static function getInstance($file)
    {
        if (self::$_instance === null) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    public function get($key) 
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }

}