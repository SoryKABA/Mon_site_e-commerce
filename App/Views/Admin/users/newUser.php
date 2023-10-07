<section class="container m-5">
    <form action="" method="post" class="w-50">
        <?= $form->input('username', "Nom de l'utilisateur") ?>
        <?= $form->input('userlogin', "L'adresse mail de l'utilisateur", 'email') ?>
        <?= $form->select('statut', "Statut de l'utilisateur", STATUT) ?>
        <?= $form->input('password', "Mot de passe de l'utilisateur", 'password') ?>
        <button type="submit" class="btn btn-primary w-100">Inscrire</button>
    </form>
</section>