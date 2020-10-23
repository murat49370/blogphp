<?php


namespace App\Controller;


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

    public function userRegistred()
    {
        $q = new UserManager($this->pdo);
        $router = $this->router;

        if (!empty($_POST))
        {
            $user = [];
            $user['user_email'] = $_POST['email'];
            $user['user_password'] = $_POST['password'];
            $user['user_first_name'] = $_POST['first_name'];
            $user['user_last_name'] = $_POST['last_name'];
            $user['user_pseudo'] = $_POST['pseudo'];
            $user['user_role'] = 'waiting';

            $newUser = new User($user);
            $q->add($newUser);
            $_SESSION['flash']['success_new_user'] = "Votre inscription a été pris en compte. Votre inscription est en attente de validation par un administrateur.";

        }
        require('../views/frontend/user/new.php');
    }




}