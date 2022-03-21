<?php
require_once("../config/database.php");

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
                    $sql = "INSERT INTO accounts(id, pseudo, email, password, points) VALUES ('', '$pseudo', '$email', '$password', 10)";
                    $conn->query($sql);

                    header('Location: ../pages/register.php?reg_error=success');
                }
            } else header("Location: ../pages/register.php?reg_error=emailnotvalid");
        } else header("Location: ../pages/register.php?reg_error=alreadyemail");
    } else header("Location: ../pages/register.php?reg_error=alreadypseudo");

    $conn->close();
}
