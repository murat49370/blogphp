<?php


namespace App\Controller\Admin;


use AltoRouter;
use App\Auth;
use App\Connection;
use App\model\CategoryManager;
use App\Model\Entity\post;
use App\model\PostManager;
use App\URL;
use Exception;
use App\Validator;

Auth::check();

class PostController
{

    private $router;
    private $pdo;
    private $id;
    private $slug;

    public function __construct(AltoRouter $router, ?array $params = [])
    {
        $this->router = $router;
        $this->pdo = Connection::get_pdo();

        if (isset($params['id']))
        {
            $this->id = (int)$params['id'];
        }

    }

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

        $success = false;
        //$categories = 0;
        if (!empty($_POST))
        {
            Validator::lang('fr');
            $v = new Validator($_POST);
            $v->rule('required', ['title', 'slug', 'short_content', 'content', 'main_image', 'small_image', 'user_id', 'status']);
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
                $post->setUserId($_POST['user_id']);
                $post->setStatus($_POST['status']);

                $q->update($post, $_POST['categories']);
                $success = true;
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

        $success = false;
        if (!empty($_POST))
        {
            if(empty($_POST['title']))
            {
                $errors['title'][] = 'Le champs titre ne dois pas être vide';
            }
            if(mb_strlen($_POST['title']) <= 3)
            {
                $errors['title'][] = 'Le champs titre dois comtenir plus de 3 caractères';
            }

            if(empty($errors))
            {
                $post = [];
                $post['post_title'] = $_POST['title'];
                $post['post_slug'] = $_POST['slug'];
                $post['post_short_content'] = $_POST['short_content'];
                $post['post_content'] = $_POST['content'];
                $post['post_status'] = $_POST['status'];
                $post['post_main_image'] = $_POST['main_image'];
                $post['post_small_image'] = $_POST['small_image'];
                $post['user_id'] = $_POST['user_id'];
                $newPost = new Post($post);

                $q->add($newPost, $_POST['categories']);
                $success = true;
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
        header('Location: ' . $router->generate('admin_list_post') . '?delete=1');

    }



}