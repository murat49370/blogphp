<?php

namespace App\model;

use App\Model\Entity\Category;
use App\Model\Entity\Post;
use Exception;
use PDO;

/**
 * Class PostManager
 * @package App\model
 */
class PostManager
{
    /**
     * @var PDO
     */
    private $_db;


    /**
     * PostManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->setDb($db);
    }

    /**
     * @param Post $post
     * @return false|\PDOStatement
     */
    public function getAuthorName(Post $post)
    {
        $id = (int) $post->getId();

        $authorName = $this->_db->query('SELECT user_pseudo FROM user WHERE id =' . $id);

        return $authorName;
    }

    /**
     * @param Post $post
     * @param array $categories
     */
    public function add(Post $post, array $categories)
    {
        $q = $this->_db->prepare('INSERT INTO post(post_create, post_modified, post_title, post_slug, post_short_content, post_content, post_status, post_main_image, post_small_image, user_id)
        VALUE (:post_create, :post_modified, :post_title, :post_slug, :post_short_content, :post_content, :post_status, :post_main_image, :post_small_image, :user_id)');

        $q->bindValue(':post_create', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $q->bindValue(':post_modified', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $q->bindValue(':post_title', $post->getTitle());
        $q->bindValue(':post_slug', $post->getSlug());
        $q->bindValue(':post_short_content', $post->getShortContent());
        $q->bindValue(':post_content', $post->getContent());
        $q->bindValue(':post_status', $post->getStatus());
        $q->bindValue(':post_main_image', $post->getMainImage());
        $q->bindValue(':post_small_image', $post->getSmallImage());
        $q->bindValue(':user_id', $post->getUserId(), PDO::PARAM_INT);
        $q->execute();
        $postId = $this->_db->lastInsertId();

        $query = $this->_db->prepare('INSERT INTO post_category SET post_id = ?, category_id = ?');
        foreach ($categories as $category)
        {
            $query->execute([$postId, $category]);
        }

    }

    /**
     * @param Post $post
     */
    public function delete(Post $post): void
    {
        $this->_db->exec('DELETE FROM post WHERE id = ' . $post->getId());
    }

    /**
     * @param $id
     * @return Post
     * @throws Exception
     */
    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM post WHERE id =' . $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        if ($donnees === false)
        {
            throw new Exception('L\'article demander n\'exite pas pour cette ID');
        }

        return new Post($donnees);
    }

    /**
     * @param int|null $perPage
     * @param int|null $offset
     * @return array
     */
    public function getList(?int $perPage, ?int $offset)
    {
        // Return all posts
        $posts = [];

        $q = $this->_db->query("SELECT * FROM post ORDER BY post_create DESC LIMIT $perPage OFFSET $offset");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $posts[] = new Post($donnes);
        }

        return $posts;
    }

    /**
     * @param Post $post
     * @param array $categories
     */
    public function update(post $post, array $categories): void
    {
        $this->_db->beginTransaction();
        $q = $this->_db->prepare('UPDATE post SET post_create = :post_create, post_modified = :post_modified, post_title = :post_title, post_slug = :post_slug, post_short_content = :post_short_content, post_content = :post_content, post_status = :post_status, post_main_image = :post_main_image, post_small_image = :post_small_image, user_id = :user_id
        WHERE id = :id LIMIT 1 ');
        $q->bindValue(':id', $post->getId(), PDO::PARAM_INT);
        $q->bindValue(':post_create', $post->getCreateDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $q->bindValue(':post_modified', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $q->bindValue(':post_title', $post->getTitle());
        $q->bindValue(':post_slug', $post->getSlug());
        $q->bindValue(':post_short_content', $post->getShortContent());
        $q->bindValue(':post_content', $post->getContent());
        $q->bindValue(':post_status', $post->getStatus());
        $q->bindValue(':post_main_image', $post->getMainImage());
        $q->bindValue(':post_small_image', $post->getSmallImage());
        $q->bindValue(':user_id', 1, PDO::PARAM_INT);
        $q->execute();

        //UPDATE POST_CATEGORY
        $this->_db->exec("DELETE FROM post_category WHERE post_id = " . $post->getId());

        $query = $this->_db->prepare('INSERT INTO post_category SET post_id = ?, category_id = ?');
        foreach ($categories as $category)
        {
            $query->execute([$post->getId(), $category]);
        }

        $this->_db->commit();

    }

    /**
     * @return int
     */
    public function count(): int
    {
        return (int)$this->_db->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];
    }

    /**
     * @param Post $post
     * @return array
     */
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
    }

    /**
     * @param Post $post
     * @return array
     */
    public function getCategoryPost(Post $post)
    {
        $query = $this->_db->prepare('
        SELECT * 
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
    }


    /**
     * @param $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }



}