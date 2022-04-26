<?php

use App\User;
use App\Database;

require '../../vendor/autoload.php';

include_once("MailController.php");

if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])) {
    register();
}

function register()
{
    $conn = Database::databaseConnect();

    if ($conn->connect_error) {
        die('Erreur : ' . $conn->connect_error);
    }

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $confirmCode = random_int(0, 9999);

    if (User::checkPseudo($pseudo)) {
        if (User::checkEmail($email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen($password) >= 8) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO accounts(id, pseudo, email, password, points, confirmCode, confirmed) VALUES ('', '$pseudo', '$email', '$password', 10, '$confirmCode', 0)";
                    $conn->query($sql);
                    sendMailConfirmation($confirmCode, $pseudo, $email);

                    header('Location: ../../index.php?page=register&reg_error=success');
                    exit();
                }
            } else header("Location: ../../index.php?page=register&reg_error=emailnotvalid");
        } else header("Location: ../../index.php?page=register&reg_error=alreadyemail");
    } else header("Location: ../../index.php?page=register&reg_error=alreadypseudo");

    $conn->close();
}
