<?php


namespace App\Controller\Admin;


use App\model\CategoryManager;

class CategoryController
{
    public function listCategory()
    {
        $q = new CategoryManager($this->pdo);

        $categories = $q->getList();
        $router = $this->router;


        require('../views/backend/category/index.php');
    }
}