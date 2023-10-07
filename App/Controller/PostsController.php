<?php

namespace App\Controller;

use App;
use App\HTML\Form;
use App\Objection\Objection;
use App\Modele\CustomerModele;
use App\Core\SendMail\SendMail;
use App\Controller\AppController;
use App\Validator\CustomerValidator;

class PostsController extends AppController {

    public function index() 
    {
        $posts = $this->loadModel('post')->all();
        $categories = $this->loadModel('category')->all();
        $this->loadModel('view')->updateViews();

        $customer = new CustomerModele();
        $table = App::getInstance()->getTable('customer');
        $errors = [];

        $mail = new SendMail(true);
        $userExist = false;

        if (!empty($_POST)) {
            $p = new CustomerValidator($_POST, $table);
            Objection::objet($customer, $_POST, ['customername', 'customermail', 'customerpassword']);
            if ($p->validate()) {
                if ($table->showNewCustomer($_POST['customermail']) == null) {
                    
                    $table->createCustomer($customer);
                    $customer = $table->showNewCustomer($_POST['customermail']);
                    $message = "Un message de confirmation vous a été envoyé sur cette adresse, merci de cliquer sur ce <a href='http://localhost:85/index.php?page=users.confirm&id=".$customer->getId()."&confirm=".$customer->getConfirm()." class='alert alert-success m-1'>lien</a> pour confirmer votre inscription";
                    $mail->sendMail($_POST['customermail'], $message);
                }else {
                    $userExist = true;
                }
            }else {
                $errors[] = $p->errors();
            }
        }
        $form = new Form($customer, $errors);
        $this->render('posts.index', compact('posts', 'categories', 'form', 'userExist'));
    }

    public function newposts() {

        $posts = $this->loadModel('post')->newposts();
        $this->render('posts.newposts', compact('posts'));
    }

    public function post() {
        $post = App::getInstance()->getTable('post')->findPostWithCategoryAndSize($_GET['id']);
        $category = App::getInstance()->getTable('category')->find($post->getIdCategory());
        $this->render('posts.post', compact('post', 'category'));
    }
}