<?php


namespace App\Controller;


use AltoRouter;
use App\Connection;
use App\model\CategoryManager;


class CategoryController
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
        $q = new CategoryManager($this->pdo);

        $categories = $q->getList();
        $router = $this->router;

        require('../views/frontend/category/index.php');

    }

    public function show()
    {
        $id = $this->id;
        $slug = $this->slug;

        $q = new categoryManager($this->pdo);
        $category = $q->get($id);
        $router = $this->router;

        // Redirection si le slug dans l'url ne correspond pas a l'id
        if ($category->getSlug() !== $slug)
        {
            $url = $router->generate('category', ['slug' => $category->getSlug(), 'id' => $id]);
            http_response_code(301);
            header('Location: ' . $url);
        }

        $categories = $q->getCategoryPost($category);


        require('../views/frontend/category/show.php');
    }

}