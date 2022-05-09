<?php
require_once("../config/DatabaseConfiguration.php");
include_once("../controllers/mail.php");

if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])) {
    registerAccount();
}

function registerAccount()
{
    $conn = connect();

    if ($conn->connect_error) {
        die('Erreur : ' . $conn->connect_error);
    }

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $confirmCode = random_int(0, 9999);

    if (checkPseudo($pseudo) == false) {
        if (checkMail($email) == false) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen($password) >= 8) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO accounts(id, pseudo, email, password, points, confirmCode, confirmed) VALUES ('', '$pseudo', '$email', '$password', 10, '$confirmCode', 0)";
                    $conn->query($sql);

                    sendMailConfirmation($confirmCode, $pseudo, $email);

                    header('Location: ../index.php?page=register&reg_error=success');
                } else header('Location: ../index.php?page=register&reg_error=invalidpassword');
            } else header("Location: ../index.php?page=register&reg_error=emailnotvalid");
        } else header("Location: ../index.php?page=register&reg_error=alreadyemail");
    } else header("Location: ../index.php?page=register&reg_error=alreadypseudo");

    $conn->close();
}

function checkMail($email)
{
    $conn = connect();

    $queryCheckMail = "SELECT * FROM accounts WHERE email = '$email'";
    $resultCheckMail = $conn->query($queryCheckMail);
    $rowEmail = $resultCheckMail->num_rows;

    if ($rowEmail == 0) return false;
    else return true;
}

function checkPseudo($pseudo)
{
    $conn = connect();

    $queryCheckPseudo = "SELECT * FROM accounts WHERE pseudo = '$pseudo'";
    $resultCheckPseudo = $conn->query($queryCheckPseudo);
    $rowPseudo = $resultCheckPseudo->num_rows;

    if ($rowPseudo == 0) return false;
    else return true;
}
