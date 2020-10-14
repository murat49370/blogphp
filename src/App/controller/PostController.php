<?php


namespace App\Controller;


use AltoRouter;
use App\model\PostManager;
use PDO;


class postController
{
    private $router;
    private $pdo;
    private $id;
    private $slug;

    public function __construct(AltoRouter $router, ?array $params = [])
    {
        $this->router = $router;
        $this->pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

        if ($params)
        {
            $this->id = (int)$params['id'];
            $this->slug = $params['slug'];
        }

    }

    public function home()
    {
        $q = new PostManager($this->pdo);
        $posts = $q->getList();
        $router = $this->router;
        require('../views/frontend/blog/index.php');

    }

    public function post()
    {
        $id = $this->id;
        $slug = $this->slug;

        $q = new postManager($this->pdo);
        $post =$q->get($id);
        $router = $this->router;
        require('../views/frontend/post/index.php');
    }
    

}