<?php


namespace App\model;


use App\Entity\Post;
use App\Entity\User;
use PDO;

class PostManager
{
    private $pdo;
    private $pdoStatement;

    function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname:blog', 'root', '');
    }

    public function create(Post $post, User $user)
    {
        $user = 2;
        $this->pdoStatement = $this->pdo->prepare('INSERT INTO post VALUES (NULL, :createDate, :modifiedDate, :title, :slug, :shortContent, :content, :status, :mainImage, :smallImage, :userId)');
        $this->pdoStatement->bindValue(':createDate', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':modifiedDate', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':title', $post->getTitle(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':slug', $post->getSlug(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':shortContent', $post->getShortContent(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':content', $post->getContent(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':status', $post->getStatus(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':mainImage', $post->getMainImage(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':userId', $user, PDO::PARAM_INT);


        $executeIsOk = $this->pdoStatement->execute();

        if (!$executeIsOk){
            return false;
        }else{
            $id = $this->pdo->lastInsertId();
            $post = $this->read($id);

            return true;
        }
    }

    public function read($id)
    {
        $this->pdoStatement = $this->pdo->prepare('SELECT * FROM post WHERE id = :id');
        $this->pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

        $executeIsOk = $this->pdoStatement->execute();
        if($executeIsOk){
            $post = $this->pdoStatement->fetchObject('App\Entity\User');

            if($post === false){
                return null;
            }else{
                return $post;
            }
        }else{
            return false;
        }

    }

    public function readAll()
    {
        // retourne un tableau d'objet
        $this->pdoStatement = $this->pdo->query('SELECT * FROM post ORDER BY post_create');
        $posts = [];

        while ($post = $this->pdoStatement->fetchObject('App\Entity\Post')){
            $posts[] = $post;
        }
        return $posts;

    }

    public function update(Post $post)
    {

    }

    public function delete(Post $post)
    {

    }
}