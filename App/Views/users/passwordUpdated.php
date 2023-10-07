<section class="container m-5">

    <?php if(!$confirm): ?>
        <div class="alert alert-danger">Les deux mots de passe ne correspondent pas</div>
    <?php endif ?>
    <form action="" method="post" class="w-50">
        <div class="form-group">
            <label for="" class="forl-label">Nouveau mot de passe :</label>
            <input type="password" name="customerpassword" class="form-control" placeholder="Votre nouveau mot de passe">
        </div><br>
        <div class="form-group">
            <label for="" class="form-label">Confirmation de nouveau mot de passe : </label>
            <input type="password" name="password" class="form-control" placeholder="Mot de passe de confirmation">
        </div>
        <div class="form-group m-1">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</section>