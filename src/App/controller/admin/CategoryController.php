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

        $title = 'Administration des categories';
        return $this->view->render($title,'backend/category/index.php', [
            'router' => $router,
            'categories' => $categories
        ]);

    }

    public function editCategory()
    {
        $id = $this->id;

        $q = new CategoryManager($this->pdo);
        $category = $q->get($id);
        $router = $this->router;

        $_SESSION['flash']['success_edit_category'] = null;

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

        $title = 'Edition d\'une categorie';
        return $this->view->render($title,'backend/category/edit.php', [
            'router' => $router,
            'category' => $category,
            'message' => $_SESSION['flash']['success_edit_category']
        ]);

    }

    public function newCategory()
    {
        $q = new CategoryManager($this->pdo);
        $router = $this->router;

        $_SESSION['flash']['success_new_category'] = null;

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

        $title= 'Nouvelle categorie';
        return $this->view->render($title,'backend/post/new.php', [
            'router' => $router,
            'message' => $_SESSION['flash']['success_new_category']
        ]);

    }

    public function deleteCategory()
    {
        $q = new CategoryManager($this->pdo);
        $category = $q->get($this->id);

        $q->delete($category);
        $_SESSION['flash']['success_delete_category'] = "La catégorie a bien été supprimé.";
        header('Location: ' . $this->router->generate('admin_list_category'));
    }
}