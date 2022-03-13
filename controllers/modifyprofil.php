<?php

session_start();

require_once('../config/database.php');

define('host', $host);
define('database', $database);
define('user', $user);
define('password', $password);

if (isset($_POST['email']) && isset($_POST['emailretype'])) {

    $conn = new mysqli($host, $user, $password, $database);

    echo 'ok';

    if ($conn->connect_error) {
        die('Erreur : ' . $conn->connect_error);
    }

    $email = htmlspecialchars($_POST['email']);
    $emailretype = htmlspecialchars($_POST['emailretype']);

    if ($email === $emailretype) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = 'UPDATE accounts SET email="' . $email . '" WHERE email="' . $_SESSION['email'] . '"';
            if ($conn->query($sql)) {
                unset($_SESSION['email']);
                $_SESSION['email'] = $email;
                header("Location: ../pages/profil.php?modify=email&error=success");
            } else echo 'nnoon';
        } else header("Location: ../pages/profil.php?modify=email&error=emailnotvalid");
    } else header("Location: ../pages/profil.php?modify=email&error=emailnotsame");
} elseif (isset($_POST['password']) && isset($_POST['passwordretype'])) {
}
