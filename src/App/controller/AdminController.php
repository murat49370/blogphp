<?php


namespace App\Controller;

use AltoRouter;
use App\Model\Entity\post;
use App\model\PostManager;
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
        $this->pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

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
        $posts = $q->getList();
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
//            $date = $post->getCreateDate();
//            dd($date);
            $q->update($post);
            $success = true;

        }

        require('../views/backend/post/edit.php');
    }

    public function newPost()
    {
        $q = new PostManager($this->pdo);
        $posts = $q->getList();
        $router = $this->router;

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