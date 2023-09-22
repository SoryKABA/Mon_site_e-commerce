<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title></title>
</head>
<body>
    <?php
        $vues = App::getInstance()->getTable('view')->all();
    ?>
    <nav class="navbar navbar-dark bg-dark"> 
        <div class="container">
            <a class="navbar-brand" href="index.php">Home</a>
            <a class="navbar-brand" href="admin.php">Articles</a>
            <a class="navbar-brand" href="admin.php?page=category">Catégories</a>
            <a class="navbar-brand" href="admin.php?page=category" title="Vues"><i class="fa-solid fa-eye"></i>
                <?php foreach($vues as $vue):  ?>
                    <?= $vue->getNombreVues() ?>
                <?php endforeach ?>
            </a>
            <div>
                <ul class="nav justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Utilisateurs
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="admin.php?page=profil">Mon profil</a></li>
                            <li><a class="dropdown-item" href="admin.php?page=users">Users</a></li>
                            <li><a class="dropdown-item" href="admin.php?page=clients">Clients</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="admin.php?page=logout">Se déconnecter</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <form class="d-flex" method="GET">
                <input class="form-control me-2" type="search" name="q" placeholder="Search" value="<?= htmlentities($_GET['q'] ?? '') ?>" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <section class="container-fluid">
        <div class="container">
            <?= $content ?>
        </div>
    </section>
</body>
</html>