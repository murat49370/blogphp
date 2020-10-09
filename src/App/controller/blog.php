<?php


require('../src/app/model/postManager.php');

$posts = new \App\model\PostManager();
//$req = $posts->readAll();

require('../views/frontend/blog/index.php');