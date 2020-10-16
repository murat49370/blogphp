<?php


namespace App\Controller\Admin;


use AltoRouter;
use App\Connection;
use App\model\CategoryManager;
use App\Model\Entity\Category;
use App\Model\Entity\Post;
use App\model\PostManager;

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

    public function listCategory()
    {
        $q = new CategoryManager($this->pdo);

        $categories = $q->getList();
        $router = $this->router;


        require('../views/backend/category/index.php');
    }

    public function editCategory()
    {
        $id = $this->id;

        $q = new CategoryManager($this->pdo);
        $category = $q->get($id);
        $router = $this->router;

        $success = false;
        if (!empty($_POST))
        {
            $category->setTitle($_POST['title']);
            $category->setSlug($_POST['slug']);


            $q->update($category);
            $success = true;

        }

        require('../views/backend/category/edit.php');
    }

    public function newCategory()
    {
        $q = new CategoryManager($this->pdo);
        $router = $this->router;

        $success = false;
        if (!empty($_POST))
        {
            $category = [];
            $category['category_title'] = $_POST['title'];
            $category['category_slug'] = $_POST['slug'];

            $newCategory = new Category($category);

            $q->add($newCategory);

            $success = true;

        }

        require('../views/backend/category/new.php');
    }

    public function deleteCategory()
    {
        $router = $this->router;
        $id = $this->id;

        $q = new CategoryManager($this->pdo);
        $category = $q->get($id);

        $q->delete($category);
        header('Location: ' . $router->generate('admin_list_category') . '?delete=1');

    }
}