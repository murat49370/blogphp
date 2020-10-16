<?php


namespace App\Controller\Admin;


use AltoRouter;
use App\Connection;
use App\model\CategoryManager;
use App\Model\CommentManager;
use App\Model\Entity\post;
use App\model\PostManager;
use App\URL;
use Exception;

class CommentController

{
    private $router;
    private $pdo;
    private $id;
    private $status;

    public function __construct(AltoRouter $router, ?array $params = [])
    {
        $this->router = $router;
        $this->pdo = Connection::get_pdo();

        if (isset($params['id']))
        {
            $this->id = (int)$params['id'];
        }
        if (isset($params['status']))
        {
            $this->status = $params['status'];
        }
    }

    public function listComment()
    {
        $q = new CommentManager($this->pdo);

        $countComment = $q->count();
        $currentPage = URL::getPositiveInt('page', 1);
        $perPage = 12;
        $pages = ceil($countComment / $perPage);
        if ($currentPage > $pages)
        {
            throw new Exception('Cette page n\'existe pas');
        }
        $offset = $perPage * ($currentPage - 1);

        $comments = $q->getList($perPage, $offset);
        $router = $this->router;

        require('../views/backend/comment/index.php');
    }

    public function editComment()
    {
        $id = $this->id;

        $q = new CommentManager($this->pdo);
        $comment = $q->get($id);
        $router = $this->router;



        $success = false;
        if (!empty($_POST))
        {

            $comment->setAuthorName($_POST['author_name']);
            $comment->setAuthorEmail($_POST['author_email']);
            $comment->setContent($_POST['content']);
            $comment->setPostId($_POST['post_id']);
            if(isset($_POST['publish'])) { $comment->setStatus($_POST['publish']);}
            if(isset($_POST['waiting'])) { $comment->setStatus($_POST['waiting']);}
            if(isset($_POST['refused'])) { $comment->setStatus($_POST['refused']);}



            $q->update($comment);
            $success = true;

        }

        require('../views/backend/comment/edit.php');
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

        require('../views/backend/comment/new.php');
    }

    public function deleteComment()
    {
        $router = $this->router;
        $id = $this->id;

        $q = new CommentManager($this->pdo);
        $comment = $q->get($id);

        $q->delete($comment);
        header('Location: ' . $router->generate('admin_list_comment') . '?delete=1');
    }

    public function updateStatus()
    {
        $router = $this->router;
        $id = $this->id;
        $status = $this->status;

        $q = new CommentManager($this->pdo);
        $comment = $q->get($id);

        $q->updateStatus($status, $id);
        header('Location: ' . $router->generate('admin_list_comment') . '?status=' . $status);
    }

}