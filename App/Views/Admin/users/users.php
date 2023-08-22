<?php
$utilisateur = App::getInstance()->getTable('user')->find($_SESSION['auth']);
$users = App::getInstance()->getTable('user')->all();

if (is_null($utilisateur->getStatut()) || !in_array($utilisateur->getStatut(), ['admin', 'super admin'])) {
    header("Location: ?page=index&refus=1");
    exit();
}
?>

<div class="container m-3">
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Votre article a été supprimé avec succès</div>
    <?php endif ?>
    <p><a href="admin.php?page=add" class="btn btn-primary">ADD</a></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>NOM</th>
                <th>LOGIN</th>
                <th>STATUT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->getId()?></td>
                    <td><?= $user->getUsername()?></td>
                    <td><?= $user->getUserlogin()?></td>
                    <td><?= $user->getStatut() ?></td>
                    <td>
                        <a class="btn btn-primary" href="admin.php?page=useredit&id=<?= $user->getId()?>">Edit</a>
                        <?php if($utilisateur->getStatut() === "super admin"): ?>
                            <form action="admin.php?page=userdelete" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet utilisateur ?')" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                <button type="submit" href="admin.php?page=userdelete&id=<?= $user->getId() ?>" class="btn btn-danger">SUPPRIMER</button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>