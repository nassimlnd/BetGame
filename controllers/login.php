<?php

session_start();
require_once("../config/database.php");

define('database', $database);
define('host', $host);
define('user', $user);
define('password', $password);

$conn = new mysqli($host, $user, $password, $database);


if (isset($_POST['pseudo']) && isset($_POST['password'])) {

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

    $checkpseudo = "SELECT pseudo, password, email, points FROM accounts WHERE pseudo = '$pseudo'";
    $resultpseudo = $conn->query($checkpseudo);
    $data = $resultpseudo->fetch_array(MYSQLI_ASSOC);
    $rowpseudo = $resultpseudo->num_rows;

    if ($rowpseudo == 1) {
        $hashedpassword = hash("sha256", $password);

        if ($hashedpassword === $data['password']) {
            $_SESSION['user'] = $data['pseudo'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['points'] = $data['points'];
            $_SESSION['bet'] = array();
            header("Location: ../index.php");
        } else header("Location: ../pages/login.php?log_error=passwordincorrect");
    } else header("Location: ../pages/login.php?log_error=pseudonotfound");
} else header("Location: ../pages/login.php?log_error=fieldserror");
