<?php


namespace App\Controller;

use App\Model\Entity\User;
use App\model\UserManager;
use Exception;

class AuthController extends Controller
{

    public function login()
    {
        $router = $this->router;
        $u = [];
        $user = new User($u);
        $_SESSION['flash']['email_passe_incorrect'] = null;

        if (!empty($_POST))
        {
            $user->setEmail(htmlspecialchars($_POST['email']));
            if (empty($_POST['email']) || empty($_POST['password']))
            {
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
                        $_SESSION['flash']['email_passe_incorrect'] = 'Email ou mots de passe incorrect.';
                    }
            } catch (Exception $e) {
                $_SESSION['flash']['email_passe_incorrect'] = "Email ou mots de passe incorrect.";
            }
        }

        $title= 'Connexion au site';
        return $this->view->render($title,'frontend/login.php', [
            'router' => $router,
            'messageEmail' => $_SESSION['flash']['email_passe_incorrect']
        ]);
    }

    public function logout()
    {
        $router = $this->router;
        session_start();
        session_destroy();
        $_SESSION['flash']['success_logout'] = "Vous avez bien été déconnecté.";

        $title= 'Déconnexion';
        return $this->view->render($title,'frontend/login.php', [
            'router' => $router,
            'message' => $_SESSION['flash']['success_logout']
        ]);

    }

}













