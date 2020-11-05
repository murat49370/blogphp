<?php


namespace App\Controller\Admin;

use App\Auth;
use App\Model\Entity\User;
use App\model\UserManager;
use App\controller\Controller;

Auth::check();


/**
 * Class HomeController
 * @package App\Controller\Admin
 */
class HomeController extends Controller
{
    /**
     * @throws \Exception
     */
    function home()

    {
        $router = $this->router;
        $user = new User([]);


        if (!empty($_SESSION['auth']))
        {
            $id = (int)$_SESSION['auth'];
            $u = new UserManager($this->pdo);
            $user = $u->get($id);
        }

        $title = 'Administration du site';
        return $this->view->render($title,'backend/index.php', [
            'router' => $router,
            'user' => $user
        ]);

    }


}