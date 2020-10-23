<?php


namespace App\Controller\Admin;


use AltoRouter;
use App\Auth;
use App\Connection;
use App\model\CategoryManager;
use App\Model\CommentManager;
use App\Model\Entity\post;
use App\model\PostManager;
use App\URL;
use App\Validator;
use Exception;

Auth::check();

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

        if (!empty($_POST))
        {
            Validator::lang('fr');
            $v = new Validator($_POST);
            $v->rule('required', ['post_id', 'author_name', 'author_email', 'content']);
            $v->rule('lengthBetween', ['title', 'slug'], 3, 250);

            if($v->validate())
            {
                $comment->setAuthorName($_POST['author_name']);
                $comment->setAuthorEmail($_POST['author_email']);
                $comment->setContent($_POST['content']);
                $comment->setPostId($_POST['post_id']);
                $comment->setStatus($_POST['comment_status']);
                $q->update($comment);

                $_SESSION['flash']['success_edit_comment'] = "Le commentaire a bien été modifié.";
                header('Location: ' . $router->generate('admin_list_comment'));
            }else{
                $errors = $v->errors();
            }
        }


        require('../views/backend/comment/edit.php');
    }


    public function deleteComment()
    {
        $router = $this->router;
        $id = $this->id;

        $q = new CommentManager($this->pdo);
        $comment = $q->get($id);

        $q->delete($comment);

        $_SESSION['flash']['success_delete_comment'] = "Le commentaire a bien été supprimé.";
        header('Location: ' . $router->generate('admin_list_comment'));
    }

    public function updateStatus()
    {
        $router = $this->router;
        $id = $this->id;
        $status = $this->status;

        $q = new CommentManager($this->pdo);
        $comment = $q->get($id);

        $q->updateStatus($status, $id);
        $_SESSION['flash']['success_update_comment_status'] = "Le status du commentaire a bien changer.";
        header('Location: ' . $router->generate('admin_list_comment'));
    }

}