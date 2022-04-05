<?php

namespace App;

use mysqli;

class DatabaseConnection
{
    public static function getMysqli(): mysqli
    {
        require_once('/config/DatabaseConfiguration.php');
        return new mysqli($host, $user, $password, $database);
    }
}
