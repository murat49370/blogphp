<?php


namespace App\Controller;


use AltoRouter;
use App\Connection;
use App\model\CategoryManager;


class CategoryController extends Controller
{

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