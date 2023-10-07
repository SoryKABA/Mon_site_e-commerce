<div class="container m-3">
    <?php if(isset($_GET['created'])): ?>
        <div class="alert alert-success">Votre catégorie a bien été créée</div>
    <?php endif ?>
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Votre catégorie a bien été supprimée</div>
    <?php endif ?>
    <p><a href="admin.php?page=admin.categories.add" class="btn btn-primary">ADD</a></p>
    <table class="table table-striped w-75">
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
                    <td><a href="admin.php?page=admin.categories.categoryposts&id=<?= $category->getId() ?>"><?= $category->getName()?></a></td>
                    <?php if(in_array($user->getStatut(), ['super admin', 'admin'])): ?>
                    <td>
                        <a class="btn btn-primary" href="admin.php?page=admin.categories.edit&id=<?= $category->getId()?>" title="Editer"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="admin.php?page=admin.categories.delete" onsubmit="return confirm('Attention ! la suppression de cette catégorie risquerait de supprimer tous les produits qui lui sont associés :( Êtes-vous sûr de vouloir faire cette action ?')" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $category->getId() ?>">
                            <button type="submit" href="admin.php?page=admin.categories.delete&id=<?= $category->getId() ?>" title="Supprimer" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                    <?php endif ?> 
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>