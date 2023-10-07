<div class="container my-3">
    <div class="row">
        <h2><?= $category->getName() ?></h2>
        <?php foreach($posts as $post): ?>
            <div class="col-4">
                <div class="card m-1" style="width: 18rem;">
                    <img src="<?= $post->getPicture() ?>" class="card-img-top" alt="...">
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