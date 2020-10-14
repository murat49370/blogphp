<?php
use App\model\PostManager;


$db = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
//$posts = [];
$q = new PostManager($db);
$posts = $q->getList();

require('../views/backend/post/index.php');
