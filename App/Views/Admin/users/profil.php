<div class="container w-75 m-2">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $user->getUsername() ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= $user->getStatut() ?></h6>
            <a href="?page=admin.users.edit&id=<?= $_SESSION['auth']?>" class="card-link">Modifier</a>
        </div>
    </div>
</div>