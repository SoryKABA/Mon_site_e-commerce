<?php

use App\HTML\Form;
use App\Modele\PostModele;
use App\Objection\Objection;
use App\Validator\PostValidator;

$post = new PostModele();
$errors = [];
$table = App::getInstance()->getTable('post');

if (!empty($_POST)) {
    $p = new PostValidator($_POST, $table);
    Objection::objet($post, $_POST, ['nom', 'content', 'price', 'id_category', 'id_size']);
    if ($p->validate()) {
        App::getInstance()->getTable('post')->createPost($post);
    }else {
        $errors[] = $p->errors();
        
    }
    //dd($errors);
}

$categories = App::getInstance()->getTable('category')->all();
$sizes = App::getInstance()->getTable('size')->all();

$form = new Form($post, $errors);
?>

<div class="container w-50 my-3 bg-light rounded shadow">
    <form action="" method="post" enctype="multipart/form-data">
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
