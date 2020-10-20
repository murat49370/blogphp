<?php


namespace App\Controller\Admin;

use AltoRouter;
use App\Auth;
use App\Connection;
use App\model\CategoryManager;
use App\Model\Entity\Category;
use App\Model\Entity\post;
use App\Model\Entity\User;
use App\model\PostManager;
use App\model\UserManager;
use App\URL;
use Exception;
use PDO;

Auth::check();


class HomeController
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

    function home()

    {
        $router = $this->router;
        $user = new User([]);


        if (!empty($_SESSION['auth']))
        {
            $id = (int)$_SESSION['auth'];
            $u = new UserManager($this->pdo);
            $user = $u->get($id);
        }






        require('../views/backend/index.php');
    }





    public function listComment()
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

    public function editComment()
    {
        $id = $this->id;

        $q = new PostManager($this->pdo);
        $post = $q->get($id);
        $router = $this->router;

        $success = false;
        if (!empty($_POST))
        {
            $post->setTitle($_POST['title']);
            $post->setSlug($_POST['slug']);
            $post->setShortContent($_POST['short_content']);
            $post->setContent($_POST['content']);
            $post->setMainImage($_POST['main_image']);
            $post->setSmallImage($_POST['small_image']);
            $post->setUserId($_POST['user_id']);
            $post->setStatus($_POST['status']);

            $q->update($post);
            $success = true;

        }

        require('../views/backend/post/edit.php');
    }

    public function newComment()
    {
        $q = new PostManager($this->pdo);
        $router = $this->router;

        $success = false;
        if (!empty($_POST))
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

            $q->add($newPost);

            $success = true;

        }

        require('../views/backend/post/new.php');
    }

    public function deleteComment()
    {
        $router = $this->router;
        $id = $this->id;

        $q = new PostManager($this->pdo);
        $post = $q->get($id);

        $q->delete($post);
        header('Location: ' . $router->generate('admin_list_post') . '?delete=1');
    }




}