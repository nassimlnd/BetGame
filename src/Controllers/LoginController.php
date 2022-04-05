<?php

namespace App\Controllers;

use mysqli;

session_start();

$conn = new mysqli($host, $user, $password, $database);


if (isset($_POST['pseudo']) && isset($_POST['password'])) {

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

    $checkpseudo = "SELECT id, pseudo, password, email, points, confirmCode, confirmed FROM accounts WHERE pseudo = '$pseudo'";
    if ($conn->query($checkpseudo)) {
        $resultpseudo = $conn->query($checkpseudo);
    } else echo 'nononon';

    $data = $resultpseudo->fetch_array(MYSQLI_ASSOC);
    $rowpseudo = $resultpseudo->num_rows;

    // Check if a line exist with the pseudo
    if ($rowpseudo == 1) {
        $hashedpassword = hash("sha256", $password);

        //defines session parameters
        if ($hashedpassword === $data['password']) {
            if ($data['confirmed'] == 1) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['pseudo'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['points'] = $data['points'];
                $_SESSION['bet'] = array();
                header("Location: ../index.php");
            } else {
                header("Location: ../views/LoginController.php?log_error=notconfirmed&accountid=" . $data['id']);
            }
        } else header("Location: ../views/LoginController.php?log_error=passwordincorrect");
    } else header("Location: ../views/LoginController.php?log_error=pseudonotfound");
} else if (isset($_POST['code']) && isset($_GET['accountid'])) {
    $code = htmlspecialchars($_POST['code']);
    $accountid = htmlspecialchars($_GET['accountid']);

    $checkcode = "SELECT id, confirmCode FROM accounts WHERE id=" . $accountid;
    $resultcode = $conn->query($checkcode);
    $datacode = $resultcode->fetch_array(MYSQLI_ASSOC);

    if ($resultcode->num_rows == 1) {
        if ($code === $datacode['confirmCode']) {
            $setconfirmed = 'UPDATE accounts SET confirmed=1 WHERE id=' . $accountid;
            if ($conn->query($setconfirmed)) {
                header('Location: ../views/LoginController.php?log_error=confirmed');
            }
        }
    }
} else
    header("Location: ../views/LoginController.php?log_error=fieldserror");

function logout()
{
    if (!isset($_SESSION['user'])) {
        session_start();
    }

    if (isset($_SESSION['user'])) {
        session_destroy();
        header("Location: ../index.php");
    } else header("Location: ../index.php");
}
