<?php

use App\Database;

require ('vendor/autoload.php');

$conn = Database::databaseConnect();

if (isset($_SESSION['user'])) {
    $sql = 'SELECT points FROM accounts WHERE pseudo ="' . $_SESSION['user'] . '"';

    $resultquery = $conn->query($sql);
    $data = $resultquery->fetch_array(MYSQLI_ASSOC);

    $points = $data['points'];

    unset($_SESSION['points']);
    $_SESSION['points'] = $points;
}

function refreshPointsBet(int $mise, mysqli $conn): void
{
    $points = $_SESSION['points'];
    $points -= $mise;

    $sql = "UPDATE accounts SET points = '$points' WHERE id = '" . $_SESSION['id'] . "'";

    if ($conn->query($sql)) {
    }
}

function setPoints(int $amount, mysqli $conn): void
{
    $sql = "UPDATE accounts SET points = $amount WHERE id =" . $_SESSION['id'];

    if ($conn->query($sql)) {
        echo 'ok';
    }
}
