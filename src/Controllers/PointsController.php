<?php

namespace App\Controllers;

use App\Database;

$conn = Database::databaseConnect();

if (isset($_SESSION['user'])) {
    $sql = 'SELECT points FROM accounts WHERE pseudo ="' . $_SESSION['user'] . '"';
    $resultquery = $conn->query($sql);
    $data = $resultquery->fetch_array(MYSQLI_ASSOC);
    $points = $data['points'];
    unset($_SESSION['points']);
    $_SESSION['points'] = $points;
}

class PointsController
{
    public static function refreshPointsBet(int $mise, $conn): void
    {
        $points = $_SESSION['points'];
        $points -= $mise;
        $sql = "UPDATE accounts SET points = '$points' WHERE id = '" . $_SESSION['id'] . "'";
        $conn->query($sql);
    }

    public static function setPoints(int $amount, $conn): void
    {
        $sql = "UPDATE accounts SET points = $amount WHERE id =" . $_SESSION['id'];
        $conn->query($sql);
    }
}


