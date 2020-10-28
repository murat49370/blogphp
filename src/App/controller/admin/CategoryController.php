<?php


namespace App\Controller\Admin;


use App\Auth;
use App\controller\Controller;
use App\model\CategoryManager;
use App\Model\Entity\Category;

use App\Validator;

Auth::check();

class CategoryController extends Controller
{


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

        if (!empty($_POST))
        {
            Validator::lang('fr');
            $v = new Validator($_POST);
            $v->rule('required', ['title', 'slug']);
            $v->rule('lengthBetween', ['title', 'slug'], 3, 250);

            if($v->validate())
            {
                $category->setTitle($_POST['title']);
                $category->setSlug($_POST['slug']);

                $q->update($category);
                $_SESSION['flash']['success_edit_category'] = "La catégorie a bien été modifié.";
                header('Location: ' . $router->generate('admin_list_category'));
            }else{
                $errors = $v->errors();
            }
        }

        require('../views/backend/category/edit.php');
    }

    public function newCategory()
    {
        $q = new CategoryManager($this->pdo);
        $router = $this->router;

        if (!empty($_POST))
        {
            Validator::lang('fr');
            $v = new Validator($_POST);
            $v->rule('required', ['title', 'slug']);
            $v->rule('lengthBetween', ['title', 'slug'], 3, 250);

            if($v->validate())
            {
                $category = [];
                $category['category_title'] = $_POST['title'];
                $category['category_slug'] = $_POST['slug'];

                $newCategory = new Category($category);

                $q->add($newCategory);
                $_SESSION['flash']['success_new_category'] = "La catégorie a bien été crée.";
                header('Location: ' . $router->generate('admin_list_category'));
            }else{
                $errors = $v->errors();
            }
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
        $_SESSION['flash']['success_delete_category'] = "La catégorie a bien été supprimé.";
        header('Location: ' . $router->generate('admin_list_category'));

    }
}