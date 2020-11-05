<?php


require '../vendor/autoload.php';
require '../config.php';

//define('DEBUG_TIME', microtime(true));

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
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

$router = new AltoRouter();
$router->setBasePath('');
// Frontend
$router->map('POST|GET', '/', 'App\Controller\HomeController#home', 'home');
$router->map('POST|GET', '/mail', 'App\Controller\HomeController#mail', 'mail');
$router->map('GET', '/blog', 'App\Controller\postController#home', 'blog_home');
$router->map('GET|POST', '/post/[*:slug]-[i:id]', 'App\Controller\postController#post', 'post');
$router->map('GET|POST', '/login', 'App\Controller\authController#login', 'login');
$router->map('POST', '/logout', 'App\Controller\authController#logout', 'logout');
$router->map('GET|POST', '/registration', 'App\Controller\UserController#userRegistred', 'registration');


$router->map('GET', '/blog/category/[*:slug]-[i:id]', 'App\Controller\CategoryController#show', 'category');
$router->map('GET', '/blog/category', 'App\Controller\CategoryController#home', 'category_home');

// Admin Home
$router->map('GET', '/admin', 'App\Controller\Admin\HomeController#home', 'admin_home');

// User Admin
$router->map('GET', '/admin/user', 'App\Controller\Admin\UserController#listUser', 'admin_list_user');
$router->map('GET|POST', '/admin/user/edit/[i:id]', 'App\Controller\Admin\UserController#editUser', 'admin_edit_user');
$router->map('GET|POST', '/admin/user/edit/password/[i:id]', 'App\Controller\Admin\UserController#editUserPassword', 'admin_edit_user_password');
$router->map('GET|POST', '/admin/user/new', 'App\Controller\Admin\UserController#newUser', 'admin_new_user');
$router->map('POST', '/admin/user/delete/[i:id]', 'App\Controller\Admin\UserController#deleteUser', 'admin_delete_user');


// Post Admin
$router->map('GET', '/admin/post', 'App\Controller\Admin\PostController#listPost', 'admin_list_post');
$router->map('GET|POST', '/admin/post/edit/[i:id]', 'App\Controller\Admin\PostController#editPost', 'admin_edit_post');
$router->map('GET|POST', '/admin/post/new', 'App\Controller\Admin\PostController#newPost', 'admin_new_post');
$router->map('POST', '/admin/post/delete/[i:id]', 'App\Controller\Admin\PostController#deletePost', 'admin_delete_post');

// Categories Admin
$router->map('GET', '/admin/category', 'App\Controller\Admin\CategoryController#listCategory', 'admin_list_category');
$router->map('GET|POST', '/admin/category/edit/[*:slug]-[i:id]', 'App\Controller\Admin\CategoryController#editCategory', 'admin_edit_category');
$router->map('GET|POST', '/admin/category/new', 'App\Controller\Admin\CategoryController#newCategory', 'admin_new_category');
//$router->map('POST', '/admin/category/new', 'App\Controller\AdminController#newCategory', 'admin_new_category_save');
$router->map('POST', '/admin/category/delete/[*:slug]-[i:id]', 'App\Controller\Admin\CategoryController#deleteCategory', 'admin_delete_category');

// Comment Admin
$router->map('GET', '/admin/comment', 'App\Controller\Admin\CommentController#listComment', 'admin_list_comment');
$router->map('GET|POST', '/admin/comment/edit/[i:id]', 'App\Controller\Admin\CommentController#editComment', 'admin_edit_comment');
$router->map('GET|POST', '/admin/comment/new', 'App\Controller\Admin\CommentController#newComment', 'admin_new_comment');
$router->map('POST', '/admin/comment/delete/[i:id]', 'App\Controller\Admin\CommentController#deleteComment', 'admin_delete_comment');
$router->map('POST', '/admin/comment/update_status/[i:id]-[*:status]', 'App\Controller\Admin\CommentController#updateStatus', 'admin_update_status_comment');


$match = $router->match();

if (!empty($match['params']))
{
    $params[] = $match['params'];
}

if ($match === false) {
    require '../views/404.php';
} else {
    list($controller, $action) = explode('#', $match['target']);
    $controller = new $controller($router, $match['params']);
    if (is_callable(array($controller, $action))) {
        call_user_func_array(array($controller, $action), array($match['params']));
    } else {
        echo 'Error: can not call ' . get_class($controller) . '#' . $action;
    }
}