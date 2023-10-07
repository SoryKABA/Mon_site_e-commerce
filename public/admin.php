<?php

require dirname(__DIR__) . '/App/App.php';

$app = App::getInstance();
$app->load();

$page = $_GET['page'] ?? 'admin.posts.index';

$pages = explode('.', $page);
$p = $pages[1];
$action = $pages[2];
$controller = '\App\Controller\Admin\\' .ucfirst($p) . 'Controller'; 
(new $controller())->$action();
