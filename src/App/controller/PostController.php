<?php


namespace App\Controller;


use App\model\CategoryManager;
use App\Model\CommentManager;
use App\Model\Entity\Comment;
use App\model\PostManager;
use App\PaginatedQuery;
use App\URL;
use App\Validator;



class postController extends Controller
{

    public function home()
    {
        $router = $this->router;
        $q = new PostManager($this->pdo);
        $pagination = new PaginatedQuery($q);
        $donnees = $pagination->getPaginatedItems();
        $posts = $donnees['items'];
        $pages = $donnees['pages'];
        $currentPage = URL::getPositiveInt('page', 1);

        $title= 'Le Blog - Murat CAN';

        return $this->view->render($title,'frontend/blog/index.php', [
            'posts' =>  $posts,
            'pages' => $pages,
            'currentPage' => $currentPage,
            'router' => $router
        ]);

    }


    public function post()
    {
        $id = $this->id;
        $slug = $this->slug;
        $router = $this->router;


        $q = new postManager($this->pdo);
        $post = $q->get($id);

        // Redirection if the slug in the url does not match the id
        if ($post->getSlug() !== $slug)
        {
            $url = $router->generate('post', ['slug' => $post->getSlug(), 'id' => $id]);
            http_response_code(301);
            header('Location: ' . $url);
        }

        //retrieve the category related to the article, returned an object array
        $categories = $q->getPostCategory($post);

        $c = new CategoryManager($this->pdo);
        $categoriesListing = $c->getList();

        $donnees = new CommentManager($this->pdo);
        $comments = $donnees->getValideListByPost($post->getId());

        $a = new CommentManager($this->pdo);

        $_SESSION['flash']['commentOk'] = null;

        if (!empty($_POST))
        {
            Validator::lang('fr');
            $v = new Validator($_POST);
            $v->rule('required', ['email', 'author_name', 'content']);
            $v->rule('lengthBetween', ['email', 'author_name', 'content'], 3, 250);

            if($v->validate())
            {
                $comment = [];
                $comment['comment_author_email'] = htmlspecialchars($_POST['email']);
                $comment['comment_author_name'] = htmlspecialchars($_POST['author_name']);
                $comment['comment_content'] = htmlspecialchars($_POST['content']);
                $comment['post_id'] = $_POST['post_id'];
                $newComment = new Comment($comment);
                $a->add($newComment);
                $_SESSION['flash']['commentOk'] = "Le commentaire a bien été enregistré, il sera publié aprés sa validation";
            }else{
                $errors = $v->errors();
            }
        }

        $title = $post->getTitle();

        return $this->view->render($title,'frontend/post/index.php', [
            'post' => $post,
            'comments' => $comments,
            'categories' => $categories,
            'categoriesListing' => $categoriesListing,
            'router' => $router,
            'message' => $_SESSION['flash']['commentOk']
        ]);


    }

}