<div class="container m-3">
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">L'utilisateur a été supprimé avec succès</div>
    <?php endif ?>
    <p><a href="admin.php?page=admin.users.add" class="btn btn-primary">ADD</a></p>
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
                        <a class="btn btn-primary" href="admin.php?page=admin.users.edit&id=<?= $user->getId()?>" title="Editer"><i class="fa-solid fa-pen-to-square"></i></a>
                        <?php if($utilisateur->getStatut() === "super admin"): ?>
                            <form action="admin.php?page=admin.users.delete" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet utilisateur ?')" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                <button type="submit" href="admin.php?page=userdelete&id=<?= $user->getId() ?>" title="Supprimer" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>