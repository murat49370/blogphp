<?php


namespace App\Controller;

use AltoRouter;
use App\Connection;
use App\Model\Entity\post;
use App\model\PostManager;
use App\URL;
use Exception;
use PDO;




class AdminController
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
        require('../views/backend/index.php');
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

    public function newPost()
    {
        $q = new PostManager($this->pdo);
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
        }
            $q->add($post);
            $success = true;

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