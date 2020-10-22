<?php

namespace App\model;

use App\Model\Entity\Category;
use App\Model\Entity\Post;
use App\Model\Entity\User;
use Exception;
use PDO;

class UserManager
{
    /**
     * @var PDO
     */
    private $_db;


    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function findByEmail(string $email)
    {
        $query = $this->_db->prepare('SELECT * FROM user WHERE user_email = :email');
        $query->execute(['email' => $email]);
        //dd($query);
        //$query->fetchObject(User::class);
        $result = $query->fetch();
        //dd(($result));

        if ($result === false)
        {
            throw new Exception('L\'email est introuvable !');
        }
        $user = new User($result);


        return $user;
    }

    public function getAuthorPseudo($id)
    {
        $q = $this->_db->query('SELECT user_pseudo FROM user WHERE id =' . $id);
        $donnee = $q->fetch();
        $user = new User($donnee);
        $authorName = $user->getPseudo();

        return $authorName;
    }

    public function add(User $user)
    {
        $q = $this->_db->prepare('INSERT INTO user(user_email, user_password, user_first_name, user_last_name, user_pseudo, user_registered, user_role)
        VALUE (:user_email, :user_password, :user_first_name, :user_last_name, :user_pseudo, :user_registered, :user_role)');

        //$q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $q->bindValue(':user_email', $user->getEmail());
        $q->bindValue(':user_password', password_hash('{$user->getPassword()}', PASSWORD_BCRYPT));
        $q->bindValue(':user_first_name', $user->getFirstName());
        $q->bindValue(':user_last_name', $user->getLastName());
        $q->bindValue(':user_pseudo', $user->getPseudo());
        $q->bindValue(':user_registered', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $q->bindValue(':user_role', $user->getRole());
        $q->execute();

    }

    public function delete(User $user): void
    {
        $this->_db->exec('DELETE FROM user WHERE id = ' . $user->getId());
    }

    public function get($id)
    {
       // Execute une requete de type SELECT avec un WHERE et retour un objet User
        $id = (int) $id;

        $q = $this->_db->query('SELECT * FROM user WHERE id =' . $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        if ($donnees === false)
        {
            throw new Exception('L\'utilisateur demander n\'exite pas pour cette ID');
        }

        return new User($donnees);
    }

    public function getList()
    {
        // Retourne la liste de tpous les postes
        $users = [];

        $q = $this->_db->query("SELECT * FROM user ORDER BY user_registered DESC");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $users[] = new User($donnes);
        }

        return $users;
    }

    public function update(user $user): void
    {

        $this->_db->beginTransaction();
        $q = $this->_db->prepare('UPDATE user SET user_email = :user_email, user_password = :user_password, user_first_name = :user_first_name, user_last_name = :user_last_name, user_pseudo = :user_pseudo, user_registered = :user_registered, user_role = :user_role 
        WHERE id = :id LIMIT 1 ');

        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $q->bindValue(':user_email', $user->getEmail());
        $q->bindValue(':user_password', $password);
        $q->bindValue(':user_first_name', $user->getFirstName());
        $q->bindValue(':user_last_name', $user->getLastName());
        $q->bindValue(':user_pseudo', $user->getPseudo());
        $q->bindValue(':user_registered', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $q->bindValue(':user_role', $user->getRole());
        $q->execute();


        $this->_db->commit();


    }


    public function setDb($db)
    {
        $this->_db = $db;
    }



}