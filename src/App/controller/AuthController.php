<?php


namespace App\Controller;


use AltoRouter;
use App\Connection;
use App\Model\Entity\User;
use App\model\UserManager;
use Exception;

class AuthController
{
    private $pdo;
    private $router;

    public function __construct(AltoRouter $router)
    {
        $this->pdo = Connection::get_pdo();
        $this->router = $router;

    }

    public function login()
    {
        $router = $this->router;
        $u = [];
        $user = new User($u);
        $errors =[];

        if (!empty($_POST))
        {
            $user->setEmail($_POST['email']);
            if (empty($_POST['email']) || empty($_POST['password']))
            {
                //$errors['passwords'] = 'Email ou mots de passe incorrect';
                throw new Exception('Email ou mots de passe incorrect');
            }
            $table = new UserManager($this->pdo);

            try {
                $u = $table->findByEmail($_POST['email']);
                $u->getPassword();
                if (password_verify($_POST['password'], $u->getPassword()) === true)
                {
                    session_start();
                    $_SESSION['auth'] = $u->getId();
                    header('Location: ' . $router->generate('admin_home'));
                    exit();
                    }else{
                        throw new Exception('Email ou mots de passe incorrect');
                    }
            } catch (Exception $e) {
                //$errors['passwords'] = 'Email ou mots de passe incorrect';
                throw new Exception('Email ou mots de passe incorrect');

            }
        }

        require('../views/frontend/login.php');
    }

    public function logout()
    {
        $router = $this->router;
        session_start();
        session_destroy();
        header('Location: ' . $router->generate('login') . '?logout=1');

    }

}



//                if (password_verify($_POST['password'], $u->getPassword()) === true)
//                {
//                header('Location: ' . $router->generate('admin_home'));
//                }else{
//                    throw new Exception('Email ou mots de passe incorrect');
//                }












