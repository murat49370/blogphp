<?php


namespace App;


use PDO;

class Connection
{

    public static function get_pdo(): PDO
    {

        return new PDO('mysql:host=localhost;dbname=blog', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

}