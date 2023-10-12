<img src="1.jpeg" alt="Images">
<div class="container my-3">
    <?php if($userExist): ?>
        <div class="alert alert-danger m-1">Ce compte existe déjà</div>
    <?php endif?>
    
    <div class="row">
        <div class="col-10">
            <div class="row">
            <?php foreach($posts as $post): ?>
                <div class="col-4">
                    <div class="card m-1" style="width: 18rem;">
                        <img src="<?= str_replace('C:\laragon\bin\apache\httpd-2.4.47-win64-VS16\htdocs\KabaShop1\\', '', $post->getPicture()) ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <small><?= $post->getPrice() ?></small>
                            <h5 class="card-title"><?= $post->getNom() ?></h5>
                            <p class="card-text"><?= $post->extract ?></p>
                            <a href="<?= $post->url ?>" class="btn btn-primary">Voir la suite</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            </div>
        </div>
        <div class="col-2">
            <ul>
                <?php foreach($categories as $category): ?>
                    <li><a href="<?= $category->url ?>"><?= $category->getName() ?></a></li>
                <?php endforeach ?>
            </ul>
            <div class="bg-light w-100">
                <form action="" method="POST">
                    <?= $form->input('customername', 'Votre nom') ?>
                    <?= $form->input('customermail', 'Votre email', 'email') ?>
                    <?= $form->input('customerpassword', 'Votre mot de passe', 'password') ?>
                    <div class="form-group m-2">
                        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>