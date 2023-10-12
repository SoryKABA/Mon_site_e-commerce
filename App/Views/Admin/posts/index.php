<div class="container m-3">
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Votre article a été supprimé avec succès</div>
    <?php endif ?>
    <?php if(isset($_GET['refus'])): ?>
        <div class="alert alert-danger">Désolé vous ne possedez pas de droit d'accéder à cette page</div>
    <?php endif ?>
    <?php if(isset($_GET['created'])): ?>
        <div class="alert alert-success">Votre article a été créé avec succès</div>
    <?php endif ?>
    <p><a href="admin.php?page=admin.posts.add" class="btn btn-primary">ADD</a></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= $paginated::tableHelper('id', '#ID', $_GET) ?></th>
                <th><?= $paginated::tableHelper('nom', 'NOM', $_GET) ?></th>
                <th><?= $paginated::tableHelper('price', 'PRIX', $_GET) ?></th>
                <th><?= $paginated::tableHelper('id_category', 'CATEGORIE', $_GET) ?></th>
                <th><?= $paginated::tableHelper('id_size', 'SIZE', $_GET) ?></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
                <tr>
                    <td><?= $post->post_id?></td>
                    <td><?= $post->getNom()?></td>
                    <td><?= $post->getPrice()?></td>
                    <td><a href="admin.php?page=admin.categories.categoryposts&id=<?= $post->getIdCategory() ?>"><?= $post->getNames()?></a></td>
                    <td><?= $post->getName()?></td>
                    <?php if(in_array($user->getStatut(), ['admin', 'super admin'])): ?>
                        <td>
                            <a class="btn btn-primary" title="Editer" href="admin.php?page=admin.posts.edit&id=<?= $post->post_id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="admin.php?page=admin.posts.delete&id=<?= $post->post_id?>" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet article ?')" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $post->post_id?>">
                                <button type="submit" href="admin.php?page=admin.posts.delete&id=<?= $post->post_id?>" class="btn btn-danger" title="Supprimer"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
            <div class="d-flex justify-content-between m-2">
                <div><?= $paginated->nextPage('admin.posts.index', 'p')?></div>
                <div><?= $paginated->previousPage('admin.posts.index', 'p')?></div>
            </div>
        </tbody>
    </table>
</div>