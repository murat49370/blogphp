<?php


namespace App;


use Exception;

class Auth
{

    public static function check ()
    {
        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }

        if (!isset($_SESSION['auth']))
        {
            //$_SESSION['flash']['success_logout'] = "Vous devez être connecté pour accéder à cette page";

            header('Location: /login?forbidden=1');
            //throw new Exception('erreur auth');

        }
    }
}