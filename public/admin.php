<?php
define('ROOT', '../App' . DIRECTORY_SEPARATOR . 'views/');
define('ROOTADMIN', '../App' . DIRECTORY_SEPARATOR . 'views/Admin/');
require dirname(__DIR__) . '/App/App.php';
$app = App::getInstance();
$app->load();
//session_destroy();
if (!$app->getDbAuth()->logged()) {
    die('Accès refusé');
    exit();
}

$page = $_GET['page'] ?? 'index';



ob_start();
switch ($page) {
    case 'index':
        require ROOTADMIN . 'posts/index.php';
        break;
    case 'new':
        require ROOTADMIN . 'posts/new.php';
        break;
    case 'edit':
        require ROOTADMIN . 'posts/edit.php';
        break;
    case 'logout':
        require ROOTADMIN . 'users/logout.php';
        break;
    case 'profil':
        require ROOTADMIN . 'users/profil.php';
        break;
    case 'users':
        require ROOTADMIN . 'users/users.php';
        break;
    case 'add':
        require ROOTADMIN . 'users/newUser.php';
        break;
    case 'useredit':
        require ROOTADMIN . 'users/edit.php';
        break;
    case 'userdelete':
        require ROOTADMIN . 'users/delete.php';
        break;
    case 'delete':
        require ROOTADMIN . 'posts/delete.php';
        break;
    case 'clients':
        require ROOTADMIN . 'clients/clients.php';
        break;
    case 'categoryposts':
        require ROOTADMIN . 'categories/categoryposts.php';
        break;
    case 'category':
        require ROOTADMIN . 'categories/index.php';
        break;
    case 'categoryEdit':
        require ROOTADMIN . 'categories/edit.php';
        break;
    case 'categoryDelete':
        require ROOTADMIN . 'categories/delete.php';
        break;
    case 'categoryNew':
        require ROOTADMIN . 'categories/new.php';
        break;
    
    default:
        # code...
        break;
}

$content = ob_get_clean();
require ROOT . 'template/admindefault.php';