<?php
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
if ($curPageName == "index.php") {
    include('config/database.php');
} else {
    include('../config/database.php');
}

if (!isset($_SESSION['user'])) {
    session_start();
}

if (!isset($host) || !isset($database) || !isset($user) || !isset($password)) {
    define('host', $host);
    define('database', $database);
    define('user', $user);
    define('password', $password);
}

$conn = new mysqli($host, $user, $password, $database);

$sql = 'SELECT points FROM accounts WHERE pseudo ="' . $_SESSION['user'] . '"';

$resultquery = $conn->query($sql);
$data = $resultquery->fetch_array(MYSQLI_ASSOC);

$points = $data['points'];

unset($_SESSION['points']);
$_SESSION['points'] = $points;


function refreshPointsBet(int $mise, mysqli $conn): void
{
    $points = $_SESSION['points'];
    $points -= $mise;

    $sql = "UPDATE accounts SET points = '$points' WHERE id = '" . $_SESSION['id'] . "'";

    if ($conn->query($sql)) {
        echo 'ok';
    }
}
