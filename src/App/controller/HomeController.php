<?php


namespace App\Controller;


use AltoRouter;
use App\Model\Entity\User;
use PDO;


class HomeController
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

    function home()
    {
        $router = $this->router;


        require('../views/frontend/index.php');
    }

    function notFound()
    {
        require('../views/404.php');
    }
}