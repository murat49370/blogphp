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


    public function add(Category $category)
    {
        $q = $this->_db->prepare('INSERT INTO category(category_title, category_slug)
        VALUE (:category_title, :category_slug)');

        $q->bindValue(':category_title', $category->getTitle());
        $q->bindValue(':category_slug', $category->getSlug());

        $q->execute();
    }

    public function delete(Category $category): void
    {
        $this->_db->exec('DELETE FROM category WHERE id = ' . $category->getId());
    }

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

    public function getListFormated()
    {
        $categories = $this->getList();
        $results = [];
        foreach ($categories as $category)
        {
            $results[$category->getId()] = $category->getTitle();
        }
        return $results;
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

    public function update(Category $category): void
    {
        $q = $this->_db->prepare('UPDATE category SET category_title = :category_title, category_slug = :category_slug 
        WHERE id = :id LIMIT 1 ');

        $q->bindValue(':id', $category->getId(), PDO::PARAM_INT);
        $q->bindValue(':category_title', $category->getTitle(), PDO::PARAM_STR);
        $q->bindValue(':category_slug', $category->getSlug(), PDO::PARAM_STR);


        $q->execute();

    }


    public function setDb($db)
    {
        $this->_db = $db;
    }

}