<?php


require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/*$router = new AltoRouter();

$router->map('GET', '/blog', __DIR__ . 'views/frontend/blog/index.php');

$match = $router->match();
$match['target'];*/

$router = new AltoRouter();
$router->setBasePath('');
$router->map('GET', '/', 'App\Controller\HomeController#home', 'home');
$router->map('GET', '/blog', 'App\Controller\postController#home', 'blog_home');
$router->map('GET', '/post/[*:slug]-[i:id]', 'App\Controller\postController#post', 'post');
$router->map('GET', '/admin', 'App\Controller\AdminController#home', 'admin_home');
$router->map('GET', '/admin/post', 'App\Controller\AdminController#listPost', 'admin_list_post');
$router->map('GET', '/admin/post/edit/[i:id]', 'App\Controller\AdminController#editPost', 'admin_edit_post');
$router->map('POST', '/admin/post/edit/[i:id]', 'App\Controller\AdminController#editPost', 'admin_edit_post_get');

//$router->map('GET', '/admin/post/new', 'App\Controller\AdminController#newPost', 'admin_list_post');
$router->map('POST', '/admin/post/delete/[i:id]', 'App\Controller\AdminController#deletePost', 'admin_delete_post');


$match = $router->match();
$params[] = $match['params'];
//dd($match);
//dd($router);

if ($match === false) {
    echo "// here you can handle 404 \n";
} else {
    list($controller, $action) = explode('#', $match['target']);
    $controller = new $controller($router, $match['params']);
    if (is_callable(array($controller, $action))) {
        call_user_func_array(array($controller, $action), array($match['params']));
    } else {
        echo 'Error: can not call ' . get_class($controller) . '#' . $action;
        // here your routes are wrong.
        // Throw an exception in debug, send a 500 error in production
    }
}
//if( is_array($match) && is_callable( $match['target'] ) ) {
//    call_user_func_array( $match['target'], $match['params'] );
//} else {
//    // no route was matched
//    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
//}




//$router = new Router(dirname(__DIR__) . '/src/app/controller');
//$router
//    ->get('/', '/home.php', 'home')
//    ->get('/blog', 'App\Controller\postController#home', 'blog')
//    ->get('/post/[*:slug]-[i:id]', '/post.php', 'post')
//    ->get('/blog/category', '/frontend/category/show.php', 'category')
//
//    ->get('/admin', '/admin/home.php', 'admin_home')
//    ->get('/admin/post', '/admin/posts.php', 'admin_posts')
//
// //   ->get('/blog/category', '/frontend/category/show.php', 'category')
//
//    ->run();


