<?php
require_once("../config/database.php");
include_once("../controllers/MailController.php");

define('host', $host);
define('user', $user);
define('password', $password);
define('database', $database);

if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])) {

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die('Erreur : ' . $conn->connect_error);
    }

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $confirmCode = random_int(0, 9999);

    $checkemail = "SELECT * FROM accounts WHERE email = '$email'";
    $checkpseudo = "SELECT * FROM accounts WHERE pseudo = '$pseudo'";
    $resultemail = $conn->query($checkemail);
    $resultpseudo = $conn->query($checkpseudo);
    $rowemail = $resultemail->num_rows;
    $rowpseudo = $resultpseudo->num_rows;

    if ($rowpseudo == 0) {
        if ($rowemail == 0) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (strlen($password) >= 4) {
                    $password = hash('sha256', $password);
                    $sql = "INSERT INTO accounts(id, pseudo, email, password, points, confirmCode, confirmed) VALUES ('', '$pseudo', '$email', '$password', 10, '$confirmCode', 0)";
                    $conn->query($sql);

                    sendMailConfirmation($confirmCode, $pseudo, $email);

                    header('Location: ../views/RegisterController.php?reg_error=success');
                }
            } else header("Location: ../views/RegisterController.php?reg_error=emailnotvalid");
        } else header("Location: ../views/RegisterController.php?reg_error=alreadyemail");
    } else header("Location: ../views/RegisterController.php?reg_error=alreadypseudo");

    $conn->close();
}
