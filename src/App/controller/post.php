<?php


use App\model\PostManager;

$id = (int)$params['id'];
$slug = $params['slug'];

$db = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
$q = new postManager($db);
$post =$q->get($id);




require('../views/frontend/post/index.php');