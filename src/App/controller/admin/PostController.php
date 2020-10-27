<?php


namespace App\Controller\Admin;


use App\Auth;
use App\model\CategoryManager;
use App\Model\Entity\post;
use App\model\PostManager;
use App\URL;
use Exception;
use App\Validator;
use App\controller\Controller;

Auth::check();

class PostController extends Controller
{


    public function listPost()
    {
        $q = new PostManager($this->pdo);

        $countPost = $q->count();
        $currentPage = URL::getPositiveInt('page', 1);
        $perPage = 12;
        $pages = ceil($countPost / $perPage);
        if ($currentPage > $pages)
        {
            throw new Exception('Cette page n\'existe pas');
        }
        $offset = $perPage * ($currentPage - 1);

        $posts = $q->getList($perPage, $offset);
        $router = $this->router;

        require('../views/backend/post/index.php');
    }

    public function editPost()
    {
        $id = $this->id;

        $q = new PostManager($this->pdo);
        $post = $q->get($id);
        $router = $this->router;


        if (!empty($_POST))
        {
            Validator::lang('fr');
            $v = new Validator($_POST);
            $v->rule('required', ['title', 'slug', 'short_content', 'content', 'main_image', 'small_image', 'status']);
            $v->rule('lengthBetween', ['title', 'short_content'], 3, 250);
            $v->rule('lengthBetween', 'slug', 3, 100);
            $v->rule('lengthBetween', 'content', 3, 1000);

            if($v->validate())
            {
                $post->setTitle($_POST['title']);
                $post->setSlug($_POST['slug']);
                $post->setShortContent($_POST['short_content']);
                $post->setContent($_POST['content']);
                $post->setMainImage($_POST['main_image']);
                $post->setSmallImage($_POST['small_image']);
                $post->setUserId($_SESSION['auth']);
                $post->setStatus($_POST['status']);

                $q->update($post, $_POST['categories']);
                $_SESSION['flash']['success_edit_post'] = "L'article a bien été modifié.";
                header('Location: ' . $router->generate('admin_list_post'));
            }else{
                $errors = $v->errors();
            }
        }

        $categories = new CategoryManager($this->pdo);
        $options = $categories->getListFormated();

        $categoriesPost = $q->getCategoryPost($post);
        $ids = [];
        foreach ($categoriesPost as $category)
        {
           $ids[] = $category->getId();
        }
        $idsCategoriesPost = $ids;

        require('../views/backend/post/edit.php');
    }

    public function newPost()
    {
        $q = new PostManager($this->pdo);
        $router = $this->router;
        $errors = [];

        if (!empty($_POST))
        {
            Validator::lang('fr');
            $v = new Validator($_POST);
            $v->rule('required', ['title', 'slug', 'short_content', 'content', 'main_image', 'small_image', 'status']);
            $v->rule('lengthBetween', ['title', 'short_content'], 3, 250);
            $v->rule('lengthBetween', 'slug', 3, 100);
            $v->rule('lengthBetween', 'content', 3, 10000);

            if($v->validate())
            {
                $post = [];
                $post['post_title'] = $_POST['title'];
                $post['post_slug'] = $_POST['slug'];
                $post['post_short_content'] = $_POST['short_content'];
                $post['post_content'] = $_POST['content'];
                $post['post_status'] = $_POST['status'];
                $post['post_main_image'] = $_POST['main_image'];
                $post['post_small_image'] = $_POST['small_image'];
                $post['user_id'] = $_SESSION['auth'];
                $newPost = new Post($post);

                $q->add($newPost, $_POST['categories']);
                $_SESSION['flash']['success_new_post'] = "L'article a bien été crée.";
                header('Location: ' . $router->generate('admin_list_post'));

            }else{
                $errors = $v->errors();
            }

        }

        $post = new Post([]);

        $categories = new CategoryManager($this->pdo);
        $options = $categories->getListFormated();

        $categoriesPost = $q->getCategoryPost($post);
        $ids = [];
        foreach ($categoriesPost as $category)
        {
            $ids[] = $category->getId();
        }
        $idsCategoriesPost = $ids;

        require('../views/backend/post/new.php');
    }

    public function deletePost()
    {
        $router = $this->router;
        $id = $this->id;

        $q = new PostManager($this->pdo);
        $post = $q->get($id);

        $q->delete($post);
        $_SESSION['flash']['deletePostOk'] = "L'article a bien été supprimé.";
        header('Location: ' . $router->generate('admin_list_post'));

    }

}