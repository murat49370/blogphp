<?php


namespace App\Model\Entity;


class User
{
    private $_id;
    private $_email;
    private $_password;
    private $_lastName;
    private $_firstName;
    private $_pseudo;
    private $_registredDate;
    private $_role;


    Public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        if (isset($donnees['id'])){ $this->setId($donnees['id']); }
        if (isset($donnees['user_email'])){ $this->setEmail($donnees['user_email']); }
        if (isset($donnees['user_password'])){ $this->setPassword($donnees['user_password']); }
        if (isset($donnees['user_first_name'])){ $this->setFirstName($donnees['user_first_name']); }
        if (isset($donnees['user_last_name'])){ $this->setLastName($donnees['user_last_name']); }
        if (isset($donnees['user_pseudo'])){ $this->setPseudo($donnees['user_pseudo']); }
        if (isset($donnees['user_registered '])){ $this->setRegistredDate($donnees['user_registered']); }
        if (isset($donnees['user_role '])){ $this->setRole($donnees['user_role']); }

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param mixed $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param mixed $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->_pseudo;
    }

    /**
     * @param mixed $pseudo
     * @return User
     */
    public function setPseudo($pseudo)
    {
        $this->_pseudo = $pseudo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegistredDate()
    {
        return $this->_registredDate;
    }

    /**
     * @param mixed $registredDate
     * @return User
     */
    public function setRegistredDate($registredDate)
    {
        $this->_registredDate = $registredDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * @param mixed $role
     * @return User
     */
    public function setRole($role)
    {
        $this->_role = $role;
        return $this;
    }






}