<?php

use App\Database;
use App\User;

require('../../vendor/autoload.php');

session_start();

if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    login();
} else if (isset($_POST['code']) && isset($_GET['accountid'])) {
    confirmAccount();
} else if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        logout();
    }
} else
    header("Location: ../pages/login.php?log_error=fieldserror");


function login()
{
    $conn = Database::databaseConnect();

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

    if (User::checkPseudo($pseudo)) {
        echo 'non';
    }


    // Check if a line exist with the pseudo
    if (!User::checkPseudo($pseudo)) {
        //$hashedpassword = hash("sha256", $password);

        $data = User::getUser($pseudo);
        var_dump($data);

        //defines session parameters
        if (password_verify($password, $data['password'])) {
            if ($data['confirmed'] == 1) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['pseudo'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['points'] = $data['points'];
                $_SESSION['bet'] = array();
                header("Location: ../../index.php");
            } else {
                header("Location: ../../index.php?page=login&log_error=notconfirmed&accountid=" . $data['id']);
            }
        } else header("Location: ../../index.php?page=login&log_error=passwordincorrect");
    } else header("Location: ../../index.php?page=login&log_error=pseudonotfound");
}

function confirmAccount()
{
    $conn = dbConnect();

    $code = htmlspecialchars($_POST['code']);
    $accountid = htmlspecialchars($_GET['accountid']);

    $checkcode = "SELECT id, confirmCode FROM accounts WHERE id=" . $accountid;
    $resultcode = $conn->query($checkcode);
    $datacode = $resultcode->fetch_array(MYSQLI_ASSOC);

    if ($resultcode->num_rows == 1) {
        if ($code === $datacode['confirmCode']) {
            $setconfirmed = 'UPDATE accounts SET confirmed=1 WHERE id=' . $accountid;
            if ($conn->query($setconfirmed)) {
                header('Location: ../pages/login.php?log_error=confirmed');
            }
        }
    }
}

function logout()
{
    @session_start();

    session_destroy();
    header("Location: ../../index.php");
}
