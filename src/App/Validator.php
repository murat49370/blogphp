<?php


namespace App;



class Validator extends \Valitron\Validator
{
    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field}', '', $message);
    }


}