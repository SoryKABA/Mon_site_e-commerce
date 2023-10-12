<?php
// Création d'une fonction qui me permettra de me connecter à la base de données partout dans mon application
function connectionBdd($db_name, $db_host = 'localhost', $db_user = 'root', $db_pass = '')
{
    $instance_base_de_donnees = null;

    if ($instance_base_de_donnees === null) {
        // Je vérifie si la variable $instance_base_de_donnees est toujours, je me connecte alors à la base de données puis lui assigner l'objet PDO
        try {
            $pdo = new PDO("Mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Cette ligne permet d'afficher les erreurs s'il y en a
            $instance_base_de_donnees = $pdo;
        } catch (\Throwable $th) {
            die("Echec de connexion à la base de données".$th->getMessage());
        }
    }
    return $instance_base_de_donnees; // Je retourne l'instance de PDO
}

// J'appelle la fonction connectionBdd
$bdd = connectionBdd("ma_base_de_donnees");

if (!empty($_POST)) { // Je m'assure que le tableau $_POST n'est pas vide
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    if (empty($userEmail) || empty($userPassword)) { // Je vérifie que tous les champs sont remplis
        echo "Tous les champs sont requis !";
    }
    $query = $bdd->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$userEmail]);
    if ($query->rowCount() > 0) {
        $userFetch = $query->fetch(PDO::FETCH_OBJ);
        if (password_verify($userPassword, $userFetch->password)) {
            $_SESSION['auth'] = $userFetch->id;
            header("Location: index.php");
            exit();
        }
    }
}



































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
