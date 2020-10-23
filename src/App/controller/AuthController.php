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
            $user->setEmail(htmlspecialchars($_POST['email']));
            if (empty($_POST['email']) || empty($_POST['password']))
            {
                //$errors['passwords'] = 'Email ou mots de passe incorrect';
                throw new Exception('Email ou mots de passe incorrect');
            }
            $table = new UserManager($this->pdo);

            try {
                $u = $table->findByEmail(htmlspecialchars($_POST['email']));
                $u->getPassword();
                if (password_verify(htmlspecialchars($_POST['password']), $u->getPassword()) === true)
                {
                    session_start();
                    $_SESSION['auth'] = $u->getId();
                    header('Location: ' . $router->generate('admin_home'));
                    exit();
                    }else{
                        //throw new Exception('Email ou mots de passe incorrect');
                        $_SESSION['flash']['email_passe_incorrect'] = 'Email ou mots de passe incorrect.';
//
//                        header('Location: ' . $router->generate('login'));
                    }
            } catch (Exception $e) {
                $_SESSION['flash']['email_passe_incorrect'] = "Email ou mots de passe incorrect.";

              //  throw new Exception('Email ou mots de passe incorrect');
            }
        }

        require('../views/frontend/login.php');
    }

    public function logout()
    {
        $router = $this->router;
        session_start();
        session_destroy();

        $_SESSION['flash']['success_logout'] = "Vous avez bien été déconnecté.";


        require('../views/frontend/login.php');
    }

}













