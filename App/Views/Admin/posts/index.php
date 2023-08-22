<?php
$user = App::getInstance()->getTable('user')->find($_SESSION['auth']);
$posts = $app->getTable('post')->allWithCategoriAndSIze();

?>

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
    <p><a href="admin.php?page=new" class="btn btn-primary">ADD</a></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>NOM</th>
                <th>PRIX</th>
                <th>CATEGORIE</th>
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
                    <td><a href="admin.php?page=categoryposts&id=<?= $post->getIdCategory() ?>"><?= $post->getNames()?></a></td>
                    <td><?= $post->getName()?></td>
                    <?php if(in_array($user->getStatut(), ['admin', 'super admin'])): ?>
                        <td>
                            <a class="btn btn-primary" href="admin.php?page=edit&id=<?= $post->post_id?>">Edit</a>
                            <form action="admin.php?page=delete&id=<?= $post->post_id?>" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet article ?')" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $post->post_id?>">
                                <button type="submit" href="admin.php?page=delete&id=<?= $post->post_id?>" class="btn btn-danger">SUPPRIMER</button>
                            </form>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>