<?php

require dirname(__DIR__) . '/App/App.php';
$app = App::getInstance();
$app->load();


$page = $_GET['page'] ?? 'posts.index';

$pages = explode('.', $page);
$current = $pages[0];
$action = $pages[1];
$controller = '\App\Controller\\' . ucfirst($current) . 'Controller';
(new $controller())->$action();
