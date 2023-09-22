<?php

use App\PaginatedQuery\PaginatedQuery;

$category = App::getInstance()->getTable('category')->find($_GET['id']);

$posts = App::getInstance()->getTable('post')->findPosts($_GET['id'])[0];
$paginatedQuery = App::getInstance()->getTable('post')->findPosts($_GET['id'])[1];


?>

<div class="container m-3">
    <h2 class="justify-content-center">Catégorie <?= $category->getName() ?></h2>
    <?php if(empty($posts)): ?>
        <div class="alert alert-danger">Aucun article pour cette catégorie</div>
    <?php endif ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= PaginatedQuery::tableHelper('id', '#ID', $_GET) ?></th>
                <th><?= PaginatedQuery::tableHelper('nom', 'NOM', $_GET) ?></th>
                <th><?= PaginatedQuery::tableHelper('price', 'PRIX', $_GET) ?></th>
                <th><?= PaginatedQuery::tableHelper('id_size', 'SIZE', $_GET) ?></th>
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
            <div class="d-flex justify-content-between m-2">
                <div><?= $paginatedQuery->nextPage('categoryposts', 'p')?></div>
                <div><?= $paginatedQuery->previousPage('categoryposts', 'p')?></div>
            </div>
        </tbody>
    </table>
</div>