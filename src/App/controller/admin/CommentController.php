<?php


namespace App\Controller\Admin;


use App\Auth;
use App\Model\CommentManager;
use App\PaginatedQuery;
use App\URL;
use App\Validator;
use App\controller\Controller;

Auth::check();

class CommentController extends Controller

{
    public function listComment()
    {
        $router = $this->router;
        $q = new CommentManager($this->pdo);

        $pagination = new PaginatedQuery($q);
        $donnees = $pagination->getPaginatedItems();
        $comments = $donnees['items'];
        $pages = $donnees['pages'];
        $currentPage = URL::getPositiveInt('page', 1);

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
        $q = new CommentManager($this->pdo);
        $comment = $q->get($this->id);

        $q->delete($comment);

        $_SESSION['flash']['success_delete_comment'] = "Le commentaire a bien été supprimé.";
        header('Location: ' . $this->router->generate('admin_list_comment'));
    }

    public function updateStatus()
    {

        $q = new CommentManager($this->pdo);
        $comment = $q->get($this->id);

        $q->updateStatus($this->status, $this->id);
        $_SESSION['flash']['success_update_comment_status'] = "Le status du commentaire a bien changer.";
        header('Location: ' . $this->router->generate('admin_list_comment'));
    }

}