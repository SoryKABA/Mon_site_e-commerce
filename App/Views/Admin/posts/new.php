<div class="container w-50 my-3 bg-light rounded shadow">
    <form action="" method="post" enctype="multipart/form-data">
        <?= $form->input('nom', 'Nom du produit') ?>
        <?= $form->input('picture', 'L\'image du produit', 'file') ?>
        <?= $form->textarea('content', 'Le contenu du produit') ?>
        <?= $form->input('price', 'Prix du produit') ?>
        <?= $form->select('id_category', 'Les catégories', $categories) ?>
        <?= $form->select('id_size', 'Les tailles', $sizes) ?>
        <div class="group-form my-2">
            <button class="btn btn-primary w-100">Enregistrer</button>
        </div>    
    </form>
</div>
