<?php


namespace App\Controller;


use AltoRouter;
use App\Connection;
use App\model\PostManager;
use App\URL;
use Exception;
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
        $this->pdo = Connection::get_pdo();

        if ($params)
        {
            $this->id = (int)$params['id'];
            $this->slug = $params['slug'];
        }

    }

    public function home()
    {
        $q = new PostManager($this->pdo);

        //pagination
        $countPost = $q->count();
        $currentPage = URL::getPositiveInt('page', 1);
       // dd($currentPage);
        $perPage = 12;
        $pages = ceil($countPost / $perPage);
        if ($currentPage > $pages)
        {
            throw new Exception('Cette page n\'existe pas');
        }
        $offset = $perPage * ($currentPage - 1);


        $posts = $q->getList($perPage, $offset);
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