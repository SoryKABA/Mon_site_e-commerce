<?php

use App\HTML\Form;
use Valitron\Validator;
use App\Objection\Objection;
const STATUT = [
    'admin',
    'super admin',
    'standard',
    'invité'
];
$errors = [];
$id = (int)$_GET['id'];
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
?>

<div class="container w-50 my-3 bg-light rounded shadow">
    <form action="" method="POST" enctype="multipart/form-data">
        <?= $form->input('username', "Nom de l'utilisateur") ?>
        <?= $form->input('userlogin', "L'adresse mail de l'utilisateur", 'email') ?>
        <?= $form->select('statut', "Statut de l'utilisateur", STATUT) ?>
        <?= $form->input('password', "Mot de passe de l'utilisateur", 'password') ?>
        <button type="submit" class="btn btn-primary w-100">Modifier</button>
    </form>
</div>
