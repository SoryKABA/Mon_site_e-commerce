<?php

use App\HTML\Form;
use App\Objection\Objection;
use PHPMailer\PHPMailer\SMTP;
use App\Modele\CustomerModele;
use PHPMailer\PHPMailer\PHPMailer;
use App\Validator\CustomerValidator;

$posts = App::getInstance()->getTable('post')->all();
$categories = App::getInstance()->getTable('category')->all();
App::getInstance()->getTable('view')->updateViews();
$customer = new CustomerModele();
$table = App::getInstance()->getTable('customer');
$errors = [];

$mail = new PHPMailer(true);

if (!empty($_POST)) {
    $p = new CustomerValidator($_POST, $table);
    Objection::objet($customer, $_POST, ['customername', 'customermail', 'customerpassword']);
    if ($p->validate()) {
        $table->createCustomer($customer);
        
    }else {
        $errors[] = $p->errors();
    }
}

$form = new Form($customer, $errors);

?>
<div class="container my-3">
    <div class="row">
        <div class="col-10">
            <div class="row">
            <?php foreach($posts as $post): ?>
                <div class="col-4">
                    <div class="card m-1" style="width: 18rem;">
                        <img src="<?= $post->getPicture() ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <small><?= $post->getPrice() ?></small>
                            <h5 class="card-title"><?= $post->getNom() ?></h5>
                            <p class="card-text"><?= $post->extract ?></p>
                            <a href="<?= $post->url ?>" class="btn btn-primary">Voir la suite</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            </div>
        </div>
        <div class="col-2">
            <ul>
                <?php foreach($categories as $category): ?>
                    <li><a href="<?= $category->url ?>"><?= $category->getName() ?></a></li>
                <?php endforeach ?>
            </ul>
            <div class="bg-light w-100">
                <form action="" method="POST">
                    <?= $form->input('customername', 'Votre nom') ?>
                    <?= $form->input('customermail', 'Votre email', 'email') ?>
                    <?= $form->input('customerpassword', 'Votre mot de passe', 'password') ?>
                    <div class="form-group m-2">
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>