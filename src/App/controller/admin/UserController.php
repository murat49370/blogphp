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


        if (!empty($_POST))
        {
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setFirstName($_POST['first_name']);
            $user->setLastName($_POST['last_name']);
            $user->setPseudo($_POST['pseudo']);
            $user->setRole($_POST['role']);

            $q->update($user);
            $_SESSION['flash']['editeUser'] = "L'utilisateur a bien été modifié";
            header('Location: ' . $router->generate('admin_list_user'));

        }

        require('../views/backend/user/edit.php');
    }

    public function editUserPassword()
    {
        $id = $this->id;

        $q = new UserManager($this->pdo);
        $user = $q->get($id);
        $router = $this->router;
        $errors = [];


        if (!empty($_POST))
        {
            if(empty($_POST['new_password']))
            {
                $errors['new_password'][] = 'Le champs ne dois pas être vide';
            }
            if(mb_strlen($_POST['new_password']) <= 3)
            {
                $errors['new_password'][] = 'Le champs dois comtenir plus de 3 caractères';
            }
            if (empty($errors))
            {
                if (password_verify($_POST['old_password'], $user->getPassword()) === true)
                {
                    if ($_POST['new_password'] === $_POST['new_password_rep'])
                    {
                        $user->setPassword($_POST['new_password']);
                        $q->update($user);
                        $_SESSION['flash']['passmodif'] = "Le mot de passe a été modifié.";
                        header('Location: ' . $router->generate('admin_list_user'));
                    }else{
                        throw new Exception('Le nouveau mots de passe ne correspond pas');
                    }

                }else{
                    throw new Exception('L\'ancien mot de passe n\'est pas correct');
                }
            }
        }




        require('../views/backend/user/password_edit.php');
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

            $_SESSION['flash']['newUser'] = "L'utilisateur a bien été crée";
            header('Location: ' . $router->generate('admin_list_user'));
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
        $_SESSION['flash']['deleteUser'] = "L'utilisateur a bien été crée";
        header('Location: ' . $router->generate('admin_list_user'));

    }



}