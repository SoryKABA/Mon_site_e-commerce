<div class="container m-3">
    <h2 class="justify-content-center">Catégorie <?= $category->getName() ?></h2>
    <?php if(empty($posts)): ?>
        <div class="alert alert-danger">Aucun article pour cette catégorie</div>
    <?php endif ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= $paginatedQuery::tableHelper('id', '#ID', $_GET) ?></th>
                <th><?= $paginatedQuery::tableHelper('nom', 'NOM', $_GET) ?></th>
                <th><?= $paginatedQuery::tableHelper('price', 'PRIX', $_GET) ?></th>
                <th><?= $paginatedQuery::tableHelper('id_size', 'SIZE', $_GET) ?></th>
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
                        <a class="btn btn-primary" href="admin.php?page=admin.posts.edit&id=<?= $post->post_id?>" title="Editer"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="admin.php?page=admin.posts.delete&id=<?= $post->post_id?>" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet article ?')" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $post->post_id ?>">
                            <button type="submit" href="admin.php?page=delete&id=<?= $post->post_id ?>" class="btn btn-danger" title="Supprimer"><i class="fa-solid fa-trash"></i></button>
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