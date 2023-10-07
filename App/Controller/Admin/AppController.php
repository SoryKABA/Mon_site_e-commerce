<?php 

namespace App\Controller\Admin;

use App\Core\DbAuth\AuthUser;
use App\Controller\AppController as ControllerAppController;
use \App;
class AppController extends ControllerAppController {

    protected $template = 'admindefault';

    public function __construct() {

        parent::__construct();
        $auth = new AuthUser(App::getInstance()->getDB());
        if (!$auth->logged()) {
            dd($this->forbidden());
        }
    }

}