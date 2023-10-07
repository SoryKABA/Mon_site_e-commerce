<section class="container m-5">
    <?php if($userExist): ?>
        <div class="alert alert-danger m-1">Ce compte n'existe pas</div>
    <?php endif?>
    <form action="" method="post" class="w-50">
        <h1>Mot de passe oublié</h1>
        <div class="form-group">
            <label for="" class="forl-label">Email :</label>
            <input type="email" name="customermail" class="form-control" placeholder="Votre login">
        </div>
        <div class="form-group m-1">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</section>