<?php

namespace App\Controller;

use App;
use App\Core\Controller\Controller;
define('ROOT', '../App' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

class AppController extends Controller {

    protected $template = 'default';

    public function __construct() {
        
        $this->viewPath = ROOT;
    }

    protected function loadModel($model_name) {
        return App::getInstance()->getTable($model_name);
    }

    protected function loadAuth($auth_name) {
        return App::getInstance()->getDbAuth($auth_name);
    }
}