<?php


namespace App\Model;


use App\Model\Entity\Comment;
use Exception;
use PDO;

/**
 * Class CommentManager
 * @package App\Model
 */
class CommentManager
{

    /**
     * @var PDO
     */
    private $_db;


    /**
     * CommentManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->setDb($db);
    }

    /**
     * @param Comment $comment
     */
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

    /**
     * @param Comment $comment
     */
    public function delete(Comment $comment): void
    {
        $this->_db->exec('DELETE FROM comment WHERE id = ' . $comment->getId());
    }

    /**
     * @param $id
     * @return Comment
     * @throws Exception
     */
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

    /**
     * @param int|null $perPage
     * @param int|null $offset
     * @return array
     */
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

    /**
     * @param int|null $perPage
     * @param int|null $offset
     * @return array
     */
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

    /**
     * @param int $postId
     * @return array
     */
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

    /**
     * @param int $postId
     * @return array
     */
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

    /**
     * @param Comment $comment
     */
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

    /**
     * @param string $status
     * @param $id
     */
    public function updateStatus(string $status, $id)
    {
        $q = $this->_db->prepare("UPDATE comment SET comment_status = :status WHERE id = :id LIMIT 1 ");

        $q->bindValue(':status', $status);
        $q->bindValue(':id', $id);

        $q->execute();

    }

    /**
     * @return int
     */
    public function count(): int
    {
        return (int)$this->_db->query('SELECT COUNT(id) FROM comment')->fetch(PDO::FETCH_NUM)[0];
    }

    /**
     * @param $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }


}