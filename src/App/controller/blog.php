<?php

use App\model\PostManager;


$db = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
$q = new PostManager($db);
$posts = $q->getList();
require('../views/frontend/blog/index.php');





