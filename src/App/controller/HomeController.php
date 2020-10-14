<?php


namespace App\Controller;


use AltoRouter;
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

        require('../views/frontend/index.php');
    }
}