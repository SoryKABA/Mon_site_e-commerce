<?php
$categories = App::getInstance()->getTable('category')->all();

?>

<div class="container m-3">
    <?php if(isset($_GET['created'])): ?>
        <div class="alert alert-success">Votre catégorie a bien été créée</div>
    <?php endif ?>
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Votre catégorie a bien été supprimée</div>
    <?php endif ?>
    <p><a href="admin.php?page=categoryNew" class="btn btn-primary">ADD</a></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Titre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $category): ?>
                <tr>
                    <td><?= $category->getId()?></td>
                    <td><a href="admin.php?page=categoryposts&id=<?= $category->getId() ?>"><?= $category->getName()?></a></td>
                    <td>
                        <a class="btn btn-primary" href="admin.php?page=categoryEdit&id=<?= $category->getId()?>">Edit</a>
                        <form action="admin.php?page=categoryDelete" onsubmit="return confirm('Êtes-vous sûr de bien vouloir supprimer cet article ?')" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $category->getId() ?>">
                            <button type="submit" href="admin.php?page=categoryDelete&id=<?= $category->getId() ?>" class="btn btn-danger">SUPPRIMER</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>