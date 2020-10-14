<?php

use App\Model\Entity\post;
use App\model\PostManager;

require 'src/app/model/PostManager.php';
require 'src/app/model/Entity/Post.php';
require 'vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$post = new Post([
    'post_create' => '2020-07-12 14:48:30',
    'post_modified' => '2020-07-12 14:48:30',
    'post_title' => 'Titre de mon article',
    'post_slug' => 'slug-content',
    'post_short_content' => 'contenue cours',
    'post_content' => 'un peu de contenue',
    'post_status' => 'valide',
    'post_main_image' => 'urlImage',
    'post_small_image' => 'urlImage',
    'user_id' => 1
]);

//dd($post);

$db = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

$manager = new PostManager($db);

$manager->add($post);

