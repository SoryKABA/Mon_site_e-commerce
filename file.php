<?php
require_once 'vendor/autoload.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog_commerce;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (\Throwable $th) {
    die("Echec de connexion à la base de données".$th->getMessage());
}
$faker = Faker\Factory::create();

$posts = $pdo->query("SELECT * FROM post")->fetchAll(PDO::FETCH_OBJ);
?>
<?php foreach ($posts as $post): ?>
    <div>
        <p><?= $post->nom ?></p>
        <img src="<?= $post->picture?>" alt="Voir l'image">
    </div>
<?php endforeach ?>
