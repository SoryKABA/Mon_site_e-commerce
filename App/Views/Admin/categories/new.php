<?php

use App\HTML\Form;
use Valitron\Validator;
use App\Objection\Objection;
use App\Modele\CategoryModele;
$category = new CategoryModele();
$errors = [];

if (!empty($_POST)) {
    $v = new Validator($_POST);
    Validator::lang('fr');
    $v->rule('required', ['name']);
    $v->rule('lengthBetween', 'name', 5, 100);
    Objection::objet($category, $_POST, 'name');
    if ($v->validate()) {
        App::getInstance()->getTable('category')->createCategory($category);
    }else {
        $errors[] = $v->errors();
        
    }
    //dd($errors);
}

$form = new Form($category, $errors);
?>

<div class="container w-50 my-3 bg-light rounded shadow">
    <form action="" method="post" enctype="multipart/form-data">
        <?= $form->input('name', 'Nom de la catégorie') ?>
        <div class="group-form my-2">
            <button class="btn btn-primary w-100">Enregistrer</button>
        </div>    
    </form>
</div>
