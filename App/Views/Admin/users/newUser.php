<?php

use App\HTML\Form;
use App\Modele\UserModele;
use App\Objection\Objection;
use App\Validator\UserValidator;

const STATUT = [
    'admin',
    'super admin',
    'standard',
    'invité'
];

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
?>

<section class="container m-5">
    <form action="" method="post" class="w-50">
        <?= $form->input('username', "Nom de l'utilisateur") ?>
        <?= $form->input('userlogin', "L'adresse mail de l'utilisateur", 'email') ?>
        <?= $form->select('statut', "Statut de l'utilisateur", STATUT) ?>
        <?= $form->input('password', "Mot de passe de l'utilisateur", 'password') ?>
        <button type="submit" class="btn btn-primary w-100">Inscrire</button>
    </form>
</section>