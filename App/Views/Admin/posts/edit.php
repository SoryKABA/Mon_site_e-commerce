<?php

use App\HTML\Form;
use Valitron\Validator;
use App\Objection\Objection;
use App\Validator\PostValidator;
$errors = [];
$id = (int)$_GET['id'];
$post = App::getInstance()->getTable('post')->find($id);
$table = App::getInstance()->getTable('post');
if (!empty($_POST)) {
    $v = new Validator($_POST);
    Validator::lang('fr');
    $v->rule('required', ['nom', 'content', 'price', 'id_category', 'id_size']);
    $v->rule('numeric', 'price');
    $v->rule('lengthBetween', 'nom', 5, 100);
    $v->rule('lengthBetween', 'content', 5, 10000);
    Objection::objet($post, $_POST, ['nom', 'content', 'price', 'id_category', 'id_size']);
    if ($v->validate()) {
        App::getInstance()->getTable('post')->updatePost($post);
    }else {
        $errors[] = $v->errors();
        
    }
    //dd($errors);
}

$categories = App::getInstance()->getTable('category')->all();
$sizes = App::getInstance()->getTable('size')->all();

$form = new Form($post, $errors);
?>

<div class="container w-50 my-3 bg-light rounded shadow">
    <form action="" method="POST" enctype="multipart/form-data">
        <?= $form->input('nom', 'Nom du produit') ?>
        <?= $form->input('picture', 'L\'image du produit', 'file') ?>
        <?= $form->textarea('content', 'Le contenu du produit') ?>
        <?= $form->input('price', 'Prix du produit') ?>
        <?= $form->select('id_category', 'Les catégories', $categories) ?>
        <?= $form->select('id_size', 'Les tailles', $sizes) ?>
        <div class="group-form my-2">
            <button class="btn btn-primary w-100">Enregistrer</button>
        </div>    
    </form>
</div>
