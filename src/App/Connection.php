<?php


namespace App;


use PDO;

class Connection
{

    public static function get_pdo(): PDO
    {
        return new PDO(DB_DSN, DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }


}