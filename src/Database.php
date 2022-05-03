<?php

namespace App;

use mysqli;

class Database
{
    public static function databaseConnect(): mysqli
    {
        include(@dirname(__DIR__) . './configuration/Configuration.php');
        return new mysqli($database['HOST'], $database['USER'], $database['PASSWORD'], $database['DB']);
    }
}
