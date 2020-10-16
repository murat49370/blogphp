<?php


namespace App\Model;


use App\Model\Entity\Comment;
use App\Model\Entity\Category;
use App\Model\Entity\post;
use Exception;
use PDO;

class CommentManager
{

    /**
     * @var PDO
     */
    private $_db;


    public function __construct($db)
    {
        $this->setDb($db);
    }

//    public function getAuthorName(Comment $comment)
//    {
//        $id = (int) $comment->getId();
//
//        $authorName = $this->_db->query('SELECT user_pseudo FROM user WHERE id =' . $id);
//
//        return $authorName;
//    }

    public function add(Comment $comment)
    {
        $q = $this->_db->prepare('INSERT INTO comment(comment_author_name, comment_author_email, comment_content, comment_create, comment_status, post_id)
        VALUE (:comment_author_name, :comment_author_email, :comment_content, :comment_create, :comment_status, :post_id)');

        $q->bindValue(':comment_author_name', $comment->getAuthorName());
        $q->bindValue(':comment_author_email', $comment->getAuthorEmail());
        $q->bindValue(':comment_content', $comment->getContent());
        $q->bindValue(':comment_create', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $q->bindValue(':comment_status', 'waiting');
        $q->bindValue(':post_id', $comment->getPostId(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Comment $comment): void
    {
        $this->_db->exec('DELETE FROM comment WHERE id = ' . $comment->getId());
    }

    public function get($id)
    {

        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM comment WHERE id =' . $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        if ($donnees === false)
        {
            throw new Exception('Le commentaire n\'exite pas pour cette ID');
        }

        return new Comment($donnees);
    }

    public function getList(?int $perPage, ?int $offset)
    {
        $comments = [];

        $q = $this->_db->query("SELECT * FROM comment ORDER BY comment_create DESC LIMIT $perPage OFFSET $offset");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($donnes);
        }
        return $comments;
    }

    public function getListValide(?int $perPage, ?int $offset)
    {
        $comments = [];

        $q = $this->_db->query("SELECT * FROM comment WHERE comment_status = 'publish' ORDER BY comment_create DESC LIMIT $perPage OFFSET $offset");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($donnes);
        }
        return $comments;
    }

    public function getListByPost(int $postId)
    {
        $comments = [];


        $q = $this->_db->query("SELECT * FROM comment WHERE post_id = $postId ORDER BY comment_create DESC");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($donnes);
        }
        return $comments;
    }

    public function getValideListByPost(int $postId)
    {
        $comments = [];

        $q = $this->_db->query("SELECT * FROM comment WHERE post_id = $postId AND comment_status = 'publish' ORDER BY comment_create DESC");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($donnes);
        }
        return $comments;
    }

    public function update(Comment $comment): void
    {

        $q = $this->_db->prepare('
        UPDATE comment 
        SET comment_create = :comment_create, comment_author_name = :comment_author_name, comment_author_email = :comment_author_email, comment_content = :comment_content, comment_status = :comment_status, post_id = :post_id
        WHERE id = :id LIMIT 1 ');

        $q->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
        $q->bindValue(':comment_create', $comment->getCreateDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $q->bindValue(':comment_author_name', $comment->getAuthorName());
        $q->bindValue(':comment_author_email', $comment->getAuthorEmail());
        $q->bindValue(':comment_content', $comment->getContent());
        $q->bindValue(':comment_status', $comment->getStatus());
        $q->bindValue(':post_id', $comment->getPostId());


        $q->execute();

    }

    public function updateStatus(string $status, $id)
    {
        $q = $this->_db->prepare("UPDATE comment SET comment_status = :status WHERE id = :id LIMIT 1 ");

        $q->bindValue(':status', $status);
        $q->bindValue(':id', $id);

        $q->execute();

    }

    public function count(): int
    {
        return (int)$this->_db->query('SELECT COUNT(id) FROM comment')->fetch(PDO::FETCH_NUM)[0];
    }

    public function getPostCategory(Post $post)
    {
        $query = $this->_db->prepare('
        SELECT c.id, c.category_slug, c.category_title 
        FROM post_category pc 
        JOIN category c ON pc.category_id = c.id
        WHERE pc.post_id = :id');
        $query->execute(['id' => $post->getId()]);
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        /** @var Category[] */
        $categories = [];

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC))
        {
            $categories[] = new Category($donnees);
        }

        return $categories;
        //dd($categories);

    }


    public function setDb($db)
    {
        $this->_db = $db;
    }



}