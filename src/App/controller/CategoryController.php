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

        //require('../views/frontend/category/index.php');

        $title= 'Liste des catégories';

        return $this->view->render($title,'frontend/category/index.php', [
            'categories' =>  $categories,
            'router' => $router
        ]);
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

        $title= 'Liste des catégories';

        return $this->view->render($title,'frontend/category/show.php', [
            'categories' =>  $categories,
            'category' =>  $category,
            'router' => $router
        ]);


        //require('../views/frontend/category/show.php');
    }

}