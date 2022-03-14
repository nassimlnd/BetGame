<?php

session_start();

require_once('../config/database.php');

if (!isset($host) || !isset($database) || !isset($user) || !isset($password)) {
    define('host', $host);
    define('database', $database);
    define('user', $user);
    define('password', $password);
}

if (isset($_POST['email']) && isset($_POST['emailretype'])) {

    $conn = new mysqli($host, $user, $password, $database);

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
} elseif (isset($_POST['password']) && isset($_POST['passwordretype']) && isset($_POST['oldpassword'])) {

    $conn = new mysqli($host, $user, $password, $database);

    $queryoldpassword = 'SELECT password FROM accounts WHERE pseudo ="' . $_SESSION['user'] . '"';
    $resultquery = $conn->query($queryoldpassword);
    $resultoldpassword = $resultquery->fetch_array(MYSQLI_ASSOC);

    $newpassword = htmlspecialchars($_POST['password']);
    $passwordretype = htmlspecialchars($_POST['passwordretype']);
    $password = htmlspecialchars($_POST['oldpassword']);

    $password = hash("sha256", $password);

    if ($password === $resultoldpassword['password']) {
        if ($newpassword === $passwordretype) {
            $newpassword = hash("sha256", $newpassword);
            $sql = 'UPDATE accounts SET password ="' . $newpassword . '" WHERE pseudo = "' . $_SESSION['user'] . '" AND password = "' . $resultoldpassword['password'] . '"';
            if ($conn->query($sql)) {
                header("Location: ../pages/profil.php?modify=password&error=success");
            }
        } else header("Location: ../pages/profil.php?modify=password&error=passnotsame");
    } else header("Location: ../pages/profil.php?modify=password&error=oldpasserror");
}
