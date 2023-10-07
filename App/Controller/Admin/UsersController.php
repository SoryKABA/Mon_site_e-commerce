<?php

namespace App\Controller\Admin;

use App;
use App\HTML\Form;
use Valitron\Validator;
use App\Modele\UserModele;
use App\Objection\Objection;
use App\Validator\UserValidator;
use App\Controller\Admin\AppController;

class UsersController extends AppController {

    const STATUT = [
        'admin',
        'super admin',
        'standard',
        'invité'
    ];

    public function users() {
        $utilisateur = $this->loadModel('user')->find($_SESSION['auth']);
        $users = $this->loadModel('user')->all();

        if (is_null($utilisateur->getStatut()) || !in_array($utilisateur->getStatut(), ['admin', 'super admin'])) {
            header("Location: admin.php?page=admin.posts.index&refus=1");
            exit();
        }
        $this->render('admin.users.users', compact('utilisateur', 'users'));
    }
    public function profil() {
        $user = $this->loadModel('user')->find($_SESSION['auth']);
        $this->render('admin.users.profil', compact('user'));
    }

    public function edit() {
          
        $errors = [];
        $id = (int)$_GET['id'];
        $admin = $this->loadModel('user')->find($_SESSION['auth']);
        $user = App::getInstance()->getTable('user')->find($id);
        if (!empty($_POST)) {
            $v = new Validator($_POST);
            Validator::lang('fr');
            $v->rule('required', ['username', 'userlogin', 'password', 'statut']);
            $v->rule('email', 'userlogin');
            $v->rule('lengthBetween', 'username', 5, 100);
            $v->rule('lengthBetween', 'password', 4, 20);
            Objection::objet($user, $_POST, ['username', 'userlogin', 'password', 'statut']);
            if ($v->validate()) {
                App::getInstance()->getTable('user')->updateUser($user);
            }else {
                $errors[] = $v->errors();
                
            }
            //dd($errors);
        }
        
        $form = new Form($user, $errors);
        $this->render('admin.users.edit', compact('admin', 'form'));
    }

    public function add() {
        
        $user = new UserModele();
        $table = App::getInstance()->getTable('user');
        $errors = [];
        if (!empty($_POST)) {
            $p = new UserValidator($_POST, $table);
            Objection::objet($user, $_POST, ['username', 'userlogin', 'password', 'statut']);
            if ($p->validate()) {
                $table->createUser($user);
            }else {
                $errors[] = $p->errors();
                dd("Erreur d'enregistrement");
            }
        }

        $form = new Form($user, $errors);
        $this->render('admin.users.newUser', compact('form'));
    }
    public function delete() {

        $post = $this->loadModel('user');
        if (!empty($_POST)) {

            $ok = $post->delete((int)$_POST['id']);
            if ($ok) {
                 $this->users();
            }
         }
    }
}