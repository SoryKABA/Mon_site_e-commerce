<div class="container w-50 my-3 bg-light rounded shadow">
    <form action="" method="POST" enctype="multipart/form-data">
        <?= $form->input('username', "Nom de l'utilisateur") ?>
        <?= $form->input('userlogin', "L'adresse mail de l'utilisateur", 'email') ?>
        <?php if($admin->getStatut() === "super admin"): ?>
        <?= $form->select('statut', "Statut de l'utilisateur", STATUT) ?>
        <?php endif ?>
        <?= $form->input('password', "Mot de passe de l'utilisateur", 'password') ?>
        <button type="submit" class="btn btn-primary w-100">Modifier</button>
    </form>
</div>
