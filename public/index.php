<?php

use App\model\Router;


require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__) . '/src/app/controller');
$router
    ->get('/', '/home.php', 'home')
    ->get('/blog', '/blog.php', 'blog')
    ->get('/post', '/post.php', 'post')
    ->get('/blog/category', '/frontend/category/show.php', 'category')
    ->run();


