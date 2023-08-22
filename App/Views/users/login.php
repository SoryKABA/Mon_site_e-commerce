<?php
$errors = false;
if (!empty($_POST)) {
   if ($app->getDbAuth()->login($_POST['adressemail'], $_POST['password'])) {
        header("Location: admin.php");
   }else {
        $errors = true;
   }
}



?>

<section class="container m-5">
    <?php if($errors): ?>
        <div class="alert alert-danger">Identifiants incorrects</div>
    <?php endif ?>
    <form action="" method="post" class="w-50">
        <div class="form-group">
            <label for="" class="forl-label">Login :</label>
            <input type="email" name="adressemail" class="form-control" placeholder="Votre login">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Mot de passe : </label>
            <input type="password" name="password" class="form-control" placeholder="Votre mot de passe">
        </div>
        <div class="form-group m-1">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</section>