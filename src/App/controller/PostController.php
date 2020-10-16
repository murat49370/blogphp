<?php


namespace App\Controller;


use AltoRouter;
use App\Connection;
use App\model\CategoryManager;
use App\Model\CommentManager;
use App\Model\Entity\Comment;
use App\Model\Entity\Post;
use App\model\PostManager;
use App\URL;
use Exception;
use PDO;


class postController
{
    private $router;
    private $pdo;
    private $id;
    private $slug;

    public function __construct(AltoRouter $router, ?array $params = [])
    {
        $this->router = $router;
        $this->pdo = Connection::get_pdo();

        if ($params)
        {
            $this->id = (int)$params['id'];
            $this->slug = $params['slug'];
        }

    }

    public function home()
    {
        $q = new PostManager($this->pdo);

        //pagination
        $countPost = $q->count();
        $currentPage = URL::getPositiveInt('page', 1);
       // dd($currentPage);
        $perPage = 12;
        $pages = ceil($countPost / $perPage);
        if ($currentPage > $pages)
        {
            throw new Exception('Cette page n\'existe pas');
        }
        $offset = $perPage * ($currentPage - 1);


        $posts = $q->getList($perPage, $offset);
        $router = $this->router;


        require('../views/frontend/blog/index.php');

    }

    public function post()
    {
        $id = $this->id;
        $slug = $this->slug;

        $q = new postManager($this->pdo);
        $post = $q->get($id);
        $router = $this->router;

        // Redirection si le slug dans l'url ne correspond pas a l'id
        if ($post->getSlug() !== $slug)
        {
            $url = $router->generate('post', ['slug' => $post->getSlug(), 'id' => $id]);
            http_response_code(301);
            header('Location: ' . $url);
        }

        // Je recupere les categorie lier a l'article, retourn un tableaux d'objet
        $categories = $q->getPostCategory($post);

        $c = new CategoryManager($this->pdo);
        $categoriesListing = $c->getList();

        //Recuper Commentaire
        $donnees = new CommentManager($this->pdo);
        $comments = $donnees->getValideListByPost($post->getId());

        $a = new CommentManager($this->pdo);

        $commetOk = false;
        if (!empty($_POST))
        {
            $comment = [];
            $comment['comment_author_email'] = $_POST['email'];
            $comment['comment_author_name'] = $_POST['author_name'];
            $comment['comment_content'] = $_POST['content'];
            $comment['post_id'] = $_POST['post_id'];

            $newComment = new Comment($comment);

            $a->add($newComment);

            $commetOk = true;

            header('Location: ' . $router->generate('post', ['id' => $id, 'slug' => $slug ]) . '?publish_comment=1');

        }


        require('../views/frontend/post/index.php');
    }

    public function newComment()
    {
        $id = $this->id;
        $slug = $this->slug;

        $q = new CommentManager($this->pdo);
        $router = $this->router;

        $commetOk = false;
        if (!empty($_POST))
        {
            $comment = [];
            $comment['comment_author_email'] = $_POST['email'];
            $comment['comment_author_name'] = $_POST['author_name'];
            $comment['comment_content'] = $_POST['content'];
            $comment['post_id'] = $_POST['post_id'];

            $newComment = new Comment($comment);

            $q->add($newComment);

            $commetOk = true;

            header('Location: ' . $router->generate('post', ['id' => $id, 'slug' => $slug ]) . '?publish_commet=1');

        }

        require('../views/backend/post/index.php');
    }
    

}