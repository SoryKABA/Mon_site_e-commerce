<?php
$utilisateur = App::getInstance()->getTable('user')->find($_SESSION['auth']);
$customers = App::getInstance()->getTable('customer')->all();


?>

<div class="container m-3">
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
                            <form action="admin.php?page=customerdelete" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet utilisateur ?')" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $customer->getId() ?>">
                                <button type="submit" href="admin.php?page=customerdelete&id=<?= $customer->getId() ?>" class="btn btn-danger">SUPPRIMER</button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>