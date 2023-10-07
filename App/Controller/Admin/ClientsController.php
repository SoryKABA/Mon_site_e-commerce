<?php

namespace App\Controller\Admin;

use App;
use App\Core\SendMail\SendMail;
use App\Controller\Admin\AppController;

class ClientsController extends AppController {

    public function index() {
        
        $utilisateur = $this->loadModel('user')->find($_SESSION['auth']);
        $customers = $this->loadModel('customer')->all();
        $this->render('admin.clients.clients', compact('utilisateur', 'customers'));
    }

    public function sender() {
        
        $mail = new SendMail(true);
        $error = null;
        $success = false;
        if(!empty($_GET['id'])) {
            $client = $this->loadModel('customer')->find($_GET['id']);
            if (empty($_POST['message'])) {
                $error = "Le champ message ne doit pas être vide ";
            }
            if (!empty($_POST)) {
                if ($mail->sendMail($client->getCustomermail(), htmlentities(nl2br($_POST['message'])))) {
                    $success = true;
                }
            }
        }else {
            $clients = $this->loadModel('customer')->all();
            if (!empty($_POST)) {
                foreach ($clients as $client) {
                    $message = htmlentities($_POST['message']) . "cliquez sur ce <a href='http://localhost:85/index.php?page=newposts'>lien</a> pour les voir";
                    if ($mail->sendMail($client->getCustomermail(), $message)) {
                        $success = true;
                    }    
                }
            }
        }
        $this->render('admin.clients.senderMessage', compact('success', 'error'));
    }

    public function delete() {

        $post = $this->loadModel('customer');
        if (!empty($_POST)) {

            $ok = $post->delete((int)$_POST['id']);
            if ($ok) {
                 $this->index();
            }
         }
    }
}