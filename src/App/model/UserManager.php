<?php

namespace App\model;


use App\Model\Entity\User;
use Exception;
use PDO;

/**
 * Class UserManager
 * @package App\model
 */
class UserManager
{
    /**
     * @var PDO
     */
    private $_db;


    /**
     * UserManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->setDb($db);
    }

    /**
     * @param string $email
     * @return User
     * @throws Exception
     */
    public function findByEmail(string $email)
    {
        $query = $this->_db->prepare('SELECT * FROM user WHERE user_email = :email');
        $query->execute(['email' => $email]);
        $result = $query->fetch();

        if ($result === false)
        {
            throw new Exception('L\'email est introuvable !');
        }
        $user = new User($result);

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAuthorPseudo($id)
    {
        $q = $this->_db->query('SELECT user_pseudo FROM user WHERE id =' . $id);
        $donnee = $q->fetch();
        $user = new User($donnee);
        $authorName = $user->getPseudo();

        return $authorName;
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $q = $this->_db->prepare('INSERT INTO user(user_email, user_password, user_first_name, user_last_name, user_pseudo, user_registered, user_role)
        VALUE (:user_email, :user_password, :user_first_name, :user_last_name, :user_pseudo, :user_registered, :user_role)');

        $q->bindValue(':user_email', $user->getEmail());
        $q->bindValue(':user_password', password_hash('{$user->getPassword()}', PASSWORD_BCRYPT));
        $q->bindValue(':user_first_name', $user->getFirstName());
        $q->bindValue(':user_last_name', $user->getLastName());
        $q->bindValue(':user_pseudo', $user->getPseudo());
        $q->bindValue(':user_registered', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $q->bindValue(':user_role', $user->getRole());
        $q->execute();
    }

    /**
     * @param User $user
     */
    public function delete(User $user): void
    {
        $this->_db->exec('DELETE FROM user WHERE id = ' . $user->getId());
    }

    /**
     * @param $id
     * @return User
     * @throws Exception
     */
    public function get($id): user
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM user WHERE id =' . $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        if ($donnees === false)
        {
            throw new Exception('L\'utilisateur demander n\'exite pas pour cette ID');
        }

        return new User($donnees);
    }

    /**
     * @return array
     */
    public function getList()
    {
        // Return all posts
        $users = [];

        $q = $this->_db->query("SELECT * FROM user ORDER BY user_registered DESC");

        while ($donnes = $q->fetch(PDO::FETCH_ASSOC))
        {
            $users[] = new User($donnes);
        }

        return $users;
    }

    /**
     * @param User $user
     */
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


    /**
     * @param $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }



}