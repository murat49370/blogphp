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
            header('Location: /login?forbidden=1');

        }
    }
}