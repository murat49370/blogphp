<?php


namespace App\model;


use App\Model\Entity\Post;
use App\Model\Entity\User;
use PDO;

class PostManager
{
    /**
     * @var PDO
     */
    private $_db;


    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getAuthorName(Post $post)
    {
        $id = (int) $post->getId();

        $authorName = $this->_db->query('SELECT user_pseudo FROM user WHERE id =' . $id);

        return $authorName;
    }

    public function add(Post $post)
    {
        $q = $this->_db->prepare('INSERT INTO post(post_create, post_modified, post_title, post_slug, post_short_content, post_content, post_status, post_main_image, post_small_image, user_id)
        VALUE (:post_create, :post_modified, :post_title, :post_slug, :post_short_content, :post_content, :post_status, :post_main_image, :post_small_image, :user_id)');

        $q->bindValue(':post_create', $post->getCreateDate());
        $q->bindValue(':post_modified', $post->getModifiedDate());
        $q->bindValue(':post_title', $post->getTitle());
        $q->bindValue(':post_slug', $post->getSlug());
        $q->bindValue(':post_short_content', $post->getShortContent());
        $q->bindValue(':post_content', $post->getContent());
        $q->bindValue(':post_status', 'valide');
        $q->bindValue(':post_main_image', $post->getMainImage());
        $q->bindValue(':post_small_image', $post->getSmallImage());
        $q->bindValue(':user_id', 1, PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Post $post)
    {
        // Execute requete de type delete
        $this->_db->exec('DELECT FROM post WHERE id = ' . $post->getId());
    }

    public function get($id)
    {
       // Execute une requete de type SELECT avec un WHERE et retour un objet Post
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM post WHERE id =' . $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Post($donnees);
    }

    public function getList()
    {
        // Retourne la liste de tpous les postes
        $posts = [];

        $q = $this->_db->query('SELECT * FROM post ORDER BY post_create DESC');

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $posts[] = new Post($donnes);
        }

        return $posts;
    }

    public function update(post $post)
    {
        // Prépare une requete de type UPDATE
        // Assignation des valeurs de la requête
        // Execution de la requete
        $q = $this->_db->prepare('UPDATE post SET post_create = :post_create, post_modified = :post_modified, post_title = :post_title, post_slug = :post_slug, post_short_content = :post_short_content, post_content = :post_content, post_status = :post_status, post_main_image = :post_main_image, post_small_image = :post_small_image, user_id = :user_id');

        $q->bindValue(':post_create', $post->getCreateDate());
        $q->bindValue(':post_modified', $post->getModifiedDate());
        $q->bindValue(':post_title', $post->getTitle());
        $q->bindValue(':post_short_content', $post->getShortContent());
        $q->bindValue(':post_content', $post->getContent());
        $q->bindValue(':post_status', $post->getStatus());
        $q->bindValue(':post_main_image', $post->getMainImage());
        $q->bindValue(':post_small_image', $post->getSmallImage());
        $q->bindValue(':user_id', 1, PDO::PARAM_INT);

        $q->execute();

    }


    public function setDb($db)
    {
        $this->_db = $db;
    }



}