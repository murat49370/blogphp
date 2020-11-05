<?php


namespace App\Controller\Admin;



use App\Auth;
use App\Model\Entity\User;
use App\model\UserManager;
use Exception;
use App\controller\Controller;

Auth::check();

class UserController extends Controller
{

    public function listUser()
    {
        $q = new UserManager($this->pdo);

        $users = $q->getList();
        $router = $this->router;

        $title= 'Administration des utilisateures';
        return $this->view->render($title,'backend/user/index.php', [
            'users' => $users,
            'router' => $router
        ]);

    }

    public function editUser()
    {
        $id = $this->id;

        $q = new UserManager($this->pdo);
        $user = $q->get($id);
        $router = $this->router;


        $_SESSION['flash']['editUser'] = null;
        if (!empty($_POST))
        {
            $user->setEmail($_POST['email']);
            $user->setFirstName($_POST['first_name']);
            $user->setLastName($_POST['last_name']);
            $user->setPseudo($_POST['pseudo']);
            $user->setRole($_POST['role']);

            $q->update($user);
            $_SESSION['flash']['editUser'] = "L'utilisateur a bien été modifié";
            header('Location: ' . $router->generate('admin_list_user'));
        }

        $title= 'Edition d\'un utilisateur';
        return $this->view->render($title,'backend/user/edit.php', [
            'user' => $user,
            'router' => $router,
            'message' => $_SESSION['flash']['editUser']
        ]);
    }

    public function editUserPassword()
    {
        $id = $this->id;

        $q = new UserManager($this->pdo);
        $user = $q->get($id);
        $router = $this->router;
        $errors = [];

        $_SESSION['flash']['passmodif'] =null;

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

        $title= 'Edition du mot de passe';
        return $this->view->render($title,'backend/user/password_edit.php', [
            'user' => $user,
            'router' => $router,
            'message' => $_SESSION['flash']['passmodif'],
            'error' => $errors
        ]);

    }

    public function newUser()
    {
        $q = new UserManager($this->pdo);
        $router = $this->router;

        $success = false;
        $_SESSION['flash']['success_new_user'] = null;
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

            $_SESSION['flash']['success_new_user'] = "L'utilisateur a bien été crée";
            header('Location: ' . $router->generate('admin_list_user'));
        }

        $title= 'Nouvelle utilisateur';
        return $this->view->render($title,'backend/user/new.php', [
            'router' => $router,
            'message' => $_SESSION['flash']['success_new_user']
        ]);

    }

    public function deleteUser()
    {
        $router = $this->router;
        $id = $this->id;

        $q = new UserManager($this->pdo);
        $user = $q->get($id);

        $q->delete($user);
        $_SESSION['flash']['deleteUser'] = "L'utilisateur a bien été supprimé";
        header('Location: ' . $router->generate('admin_list_user'));
    }

}