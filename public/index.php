<?php

define('ROOT', '../App' . DIRECTORY_SEPARATOR . 'views/');
require dirname(__DIR__) . '/App/App.php';
$app = App::getInstance();
$app->load();
function url($page)
{
    if (isset($page)) {
        
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $url = str_replace('page=', '\\', end($uri));
        if(str_contains($url, '&')){
            $page = str_replace('&id=', '\\', $url);
            return $page;
        }
        return $url;
    }
}


$page = $_GET['page'] ?? 'index';
url($page);


ob_start();
switch ($page) {
    case 'index':
        require ROOT . 'posts/index.php';
        break;
    case 'post':
        require ROOT . 'posts/post.php';
        break;
    case 'login':
        require ROOT . 'users/login.php';
        break;
    case 'logout':
        require ROOT . 'users/logout.php';
        break;
    case 'category':
        require ROOT . 'categorie/index.php';
        break;
    
    default:
        # code...
        break;
}

$content = ob_get_clean();
require ROOT . 'template/default.php';