<?php


namespace App\model;


use App\Model\Entity\Category;
use App\Model\Entity\post;
use PDO;

class CategoryManager
{
    /**
     * @var PDO
     */
    private $_db;


    public function __construct($db)
    {
        $this->setDb($db);
    }


//    public function add(Post $post)
//    {
//        $q = $this->_db->prepare('INSERT INTO post(post_create, post_modified, post_title, post_slug, post_short_content, post_content, post_status, post_main_image, post_small_image, user_id)
//        VALUE (:post_create, :post_modified, :post_title, :post_slug, :post_short_content, :post_content, :post_status, :post_main_image, :post_small_image, :user_id)');
//
//        $q->bindValue(':post_create', $post->getCreateDate());
//        $q->bindValue(':post_modified', $post->getModifiedDate());
//        $q->bindValue(':post_title', $post->getTitle());
//        $q->bindValue(':post_slug', $post->getSlug());
//        $q->bindValue(':post_short_content', $post->getShortContent());
//        $q->bindValue(':post_content', $post->getContent());
//        $q->bindValue(':post_status', 'valide');
//        $q->bindValue(':post_main_image', $post->getMainImage());
//        $q->bindValue(':post_small_image', $post->getSmallImage());
//        $q->bindValue(':user_id', 1, PDO::PARAM_INT);
//
//        $q->execute();
//    }
//
//    public function delete(Post $post): void
//    {
//        $this->_db->exec('DELETE FROM post WHERE id = ' . $post->getId());
//    }
//
    public function get($id)
    {
        // Execute une requete de type SELECT avec un WHERE et retour un objet Post
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM category WHERE id =' . $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        if ($donnees === false)
        {
            throw new Exception('La category demander n\'exite pas pour cette ID');
        }

        return new Category($donnees);
    }

    public function getList()
    {
        $categories = [];
        $q = $this->_db->query("SELECT * FROM category ORDER BY id DESC");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $categories[] = new Category($donnes);
        }
        return $categories;
    }

    public function getCategoryPost(Category $category)
    {
        $query = $this->_db->prepare('
        SELECT * 
        FROM post_category pc 
        JOIN post p ON pc.post_id = p.id
        WHERE pc.category_id = :id');
        $query->execute(['id' => $category->getId()]);
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        /** @var Post[] */
        $posts = [];

        while ($donnees = $query->fetch(PDO::FETCH_ASSOC))
        {
            $posts[] = new Post($donnees);
        }

        return $posts;
    }

//    public function update(post $post): void
//    {
//        $q = $this->_db->prepare('UPDATE post SET post_create = :post_create, post_modified = :post_modified, post_title = :post_title, post_slug = :post_slug, post_short_content = :post_short_content, post_content = :post_content, post_status = :post_status, post_main_image = :post_main_image, post_small_image = :post_small_image, user_id = :user_id
//        WHERE id = :id LIMIT 1 ');
//
//        $q->bindValue(':id', $post->getId(), PDO::PARAM_INT);
//        $q->bindValue(':post_create', $post->getCreateDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
//        $q->bindValue(':post_modified', date("Y-m-d H:i:s"), PDO::PARAM_STR);
//        $q->bindValue(':post_title', $post->getTitle());
//        $q->bindValue(':post_slug', $post->getSlug());
//        $q->bindValue(':post_short_content', $post->getShortContent());
//        $q->bindValue(':post_content', $post->getContent());
//        $q->bindValue(':post_status', $post->getStatus());
//        $q->bindValue(':post_main_image', $post->getMainImage());
//        $q->bindValue(':post_small_image', $post->getSmallImage());
//        $q->bindValue(':user_id', 1, PDO::PARAM_INT);
//
//        $q->execute();
//
//    }
//


    public function setDb($db)
    {
        $this->_db = $db;
    }

}