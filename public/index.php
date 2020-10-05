<?php

use App\Router;

require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$router = new Router(dirname(__DIR__) . '/views');
$router
    ->get('/', '/frontend/index.php', 'home')
    ->get('/blog', '/frontend/post/index.php', 'blog')
    ->get('/blog/category', '/frontend/category/show.php', 'category')
    ->run();


