<div class="container m-3">
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Le client a été supprimé avec succès</div>
    <?php endif ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>NOM</th>
                <th>EMAIL</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $customer): ?>
                <tr>
                    <td><?= $customer->getId()?></td>
                    <td><?= $customer->getCustomername()?></td>
                    <td><?= $customer->getCustomermail()?></td>
                    <td>
                        <?php if(in_array($utilisateur->getStatut(), ['admin', 'super admin'])): ?>
                            <form action="admin.php?page=admin.clients.delete" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet utilisateur ?')" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $customer->getId() ?>">
                                <button type="submit" href="admin.php?page=customerdelete&id=<?= $customer->getId() ?>" class="btn btn-danger" title="Supprimer"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <a href="?page=admin.clients.sender&id=<?= $customer->getId() ?>" title="Envoyez lui un message" class="btn btn-success"><i class="fa-regular fa-paper-plane"></i></a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>