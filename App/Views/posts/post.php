<?php

$post = App::getInstance()->getTable('post')->findPostWithCategoryAndSize($_GET['id']);
$category = App::getInstance()->getTable('category')->find($post->getIdCategory());

?>

<div class="container bg-light">
    <h2><?= $post->getNom() ?></h2>
    <div>
        <p><?= $post->getContent() ?></p>
        <small><i><?= $post->getCreateAt()->format('Y-m-d H:i:s') ?></i></small>
        <small><?= $post->getName() ?></small>
        <small><a href="<?= $category->url ?>"><?= $category->getName() ?></a></small>
    </div>
</div>