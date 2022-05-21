<?php

@session_start();

if (isset($_POST['email']) && isset($_POST['emailretype'])) {
    editEmail();
} elseif (isset($_POST['password']) && isset($_POST['passwordretype']) && isset($_POST['oldpassword'])) {
    editPassword();
}


function editPassword()
{
    require('../config/DatabaseConfiguration.php');

    $conn = connect();

    $queryoldpassword = 'SELECT password FROM accounts WHERE pseudo ="' . $_SESSION['user'] . '"';
    $resultquery = $conn->query($queryoldpassword);
    $resultoldpassword = $resultquery->fetch_array(MYSQLI_ASSOC);

    $newpassword = htmlspecialchars($_POST['password']);
    $passwordretype = htmlspecialchars($_POST['passwordretype']);
    $password = htmlspecialchars($_POST['oldpassword']);

    var_dump($resultoldpassword);

    if (password_verify($password, $password)) {
        if ($newpassword === $passwordretype) {
            $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = 'UPDATE accounts SET password ="' . $newpassword . '" WHERE pseudo = "' . $_SESSION['user'] . '" AND password = "' . $resultoldpassword['password'] . '"';
            if ($conn->query($sql)) {
                header("Location: ../index.php?page=profil&modify=password&error=success");
            }
        } else header("Location: ../index.php?page=profil&modify=password&error=passnotsame");
    } else header("Location: ../index.php?page=profil&modify=password&error=oldpasserror");
}

function editEmail()
{
    require('../config/DatabaseConfiguration.php');

    $conn = connect();

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
                header("Location: ../index.php?page=profil&modify=email&error=success");
            } else echo 'nnoon';
        } else header("Location: ../index.php?page=profil&modify=email&error=emailnotvalid");
    } else header("Location: ../index.php?page=profil&modify=email&error=emailnotsame");
}
