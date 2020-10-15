<?php


require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if(isset($_GET['page']) && $_GET['page'] === '1')
{
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query))
    {
        $uri =$uri . '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

$router = new AltoRouter();
$router->setBasePath('');
$router->map('GET', '/', 'App\Controller\HomeController#home', 'home');
$router->map('GET', '/blog', 'App\Controller\postController#home', 'blog_home');
$router->map('GET', '/post/[*:slug]-[i:id]', 'App\Controller\postController#post', 'post');
$router->map('GET', '/admin', 'App\Controller\AdminController#home', 'admin_home');
$router->map('GET', '/admin/post', 'App\Controller\AdminController#listPost', 'admin_list_post');
$router->map('GET', '/admin/post/edit/[i:id]', 'App\Controller\AdminController#editPost', 'admin_edit_post');
$router->map('POST', '/admin/post/edit/[i:id]', 'App\Controller\AdminController#editPost', 'admin_edit_post_get');
$router->map('GET', '/admin/post/new', 'App\Controller\AdminController#newPost', 'admin_new_post');
$router->map('GET', '/blog/category/[*:slug]-[i:id]', 'App\Controller\CategoryController#show', 'category');
$router->map('GET', '/blog/category', 'App\Controller\CategoryController#home', 'category_home');



//$router->map('GET', '/admin/post/new', 'App\Controller\AdminController#newPost', 'admin_list_post');
$router->map('POST', '/admin/post/delete/[i:id]', 'App\Controller\AdminController#deletePost', 'admin_delete_post');


$match = $router->match();
$params[] = $match['params'];


if ($match === false) {
    echo "// here you can handle 404 \n";
} else {
    list($controller, $action) = explode('#', $match['target']);
    $controller = new $controller($router, $match['params']);
    if (is_callable(array($controller, $action))) {
        call_user_func_array(array($controller, $action), array($match['params']));
    } else {
        echo 'Error: can not call ' . get_class($controller) . '#' . $action;
    }
}