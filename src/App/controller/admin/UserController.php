<?php


namespace App\Controller\Admin;


use AltoRouter;
use App\Auth;
use App\Connection;
use App\model\CategoryManager;
use App\Model\Entity\post;
use App\Model\Entity\User;
use App\model\PostManager;
use App\model\UserManager;
use App\URL;
use Exception;

Auth::check();

class UserController
{

    private $router;
    private $pdo;
    private $id;
    private $slug;

    public function __construct(AltoRouter $router, ?array $params = [])
    {
        $this->router = $router;
        $this->pdo = Connection::get_pdo();

        if (isset($params['id']))
        {
            $this->id = (int)$params['id'];
        }


    }

    public function listUser()
    {
        $q = new UserManager($this->pdo);


        $users = $q->getList();
        $router = $this->router;

        require('../views/backend/user/index.php');
    }

    public function editUser()
    {
        $id = $this->id;

        $q = new UserManager($this->pdo);
        $user = $q->get($id);
        $router = $this->router;

        $success = false;
        //$categories = 0;
        if (!empty($_POST))
        {
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setFirstName($_POST['first_name']);
            $user->setLastName($_POST['last_name']);
            $user->setPseudo($_POST['pseudo']);
            $user->setRole($_POST['role']);

            $q->update($user);
            $success = true;

        }

        require('../views/backend/user/edit.php');
    }

    public function newUser()
    {
        $q = new UserManager($this->pdo);
        $router = $this->router;

        $success = false;
        if (!empty($_POST))
        {
            $user = [];
            $user['user_email'] = $_POST['email'];
            $user['user_password'] = $_POST['password'];
            $user['user_first_name'] = $_POST['first_name'];
            $user['user_last_name'] = $_POST['last_name'];
            $user['user_pseudo'] = $_POST['pseudo'];
            $user['user_role'] = $_POST['role'];

            $newUser = new User($user);

            $q->add($newUser);

            $success = true;
        }


        require('../views/backend/user/new.php');
    }

    public function deleteUser()
    {
        $router = $this->router;
        $id = $this->id;

        $q = new UserManager($this->pdo);
        $user = $q->get($id);

        $q->delete($user);
        header('Location: ' . $router->generate('admin_list_user') . '?delete=1');

    }



}