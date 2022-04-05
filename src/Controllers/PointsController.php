<?php

namespace App\Controllers;

use mysqli;

class PointsController
{

    public function init()
    {
        require_once('/config/DatabaseConfiguration.php');

        $conn = new mysqli($host, $user, $password, $database);

        if (isset($_SESSION['user'])) {
            $sql = 'SELECT points FROM accounts WHERE pseudo ="' . $_SESSION['user'] . '"';

            $resultquery = $conn->query($sql);
            $data = $resultquery->fetch_array(MYSQLI_ASSOC);

            $points = $data['points'];

            unset($_SESSION['points']);
            $_SESSION['points'] = $points;
        }
    }



    public static function refreshPointsBet(int $mise, mysqli $conn): void
    {
        $points = $_SESSION['points'];
        $points -= $mise;

        $sql = "UPDATE accounts SET points = '$points' WHERE id = '" . $_SESSION['id'] . "'";

        if ($conn->query($sql)) {
        }
    }

    public static function setPoints(int $amount, mysqli $conn): void
    {
        $sql = "UPDATE accounts SET points = $amount WHERE id =" . $_SESSION['id'];

        if ($conn->query($sql)) {
            echo 'ok';
        }
    }
}
