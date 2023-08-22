<?php

$category = App::getInstance()->getTable('category')->find($_GET['id']);

$posts = App::getInstance()->getTable('post')->findPosts($_GET['id']);


?>

<div class="container m-3">
    <h2 class="justify-content-center">Catégorie <?= $category->getName() ?></h2>
    <?php if(empty($posts)): ?>
        <div class="alert alert-danger">Aucun article pour cette catégorie</div>
    <?php endif ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>NOM</th>
                <th>PRIX</th>
                <th>SIZE</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
                <tr>
                    <td><?= $post->post_id?></td>
                    <td><?= $post->getNom()?></td>
                    <td><?= $post->getPrice()?></td>
                    <td><?= $post->getName()?></td>
                    <td>
                        <a class="btn btn-primary" href="admin.php?page=edit&id=<?= $post->post_id?>">Edit</a>
                        <form action="admin.php?page=delete&id=<?= $post->post_id?>" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet article ?')" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $post->post_id ?>">
                            <button type="submit" href="admin.php?page=delete&id=<?= $post->post_id ?>" class="btn btn-danger">SUPPRIMER</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>