<?php

session_start();
require_once("../config/DatabaseConfiguration.php");

if (isset($_GET['action'])) {
    $action = htmlspecialchars($_GET['action']);
    switch ($action) {
        case 'logout':
            logout();
            break;
    }
    die();
}

if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    login();
} else if (isset($_POST['code']) && isset($_GET['accountid'])) {
    confirmAccount();
} else
    header("Location: ../index.php?page=login&log_error=fieldserror");

function logout()
{
    if (isset($_SESSION['user'])) {
        session_destroy();
        header("Location: ../index.php");
    } else header("Location: ../index.php");
}

function login()
{
    $conn = connect();

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
        if (password_verify($password, $data['password'])) {
            if ($data['confirmed'] == 1) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['pseudo'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['points'] = $data['points'];
                $_SESSION['bet'] = array();
                header("Location: ../index.php");
            } else {
                header("Location: ../index.php?page=login&log_error=notconfirmed&accountid=" . $data['id']);
            }
        } else header("Location: ../index.php?page=login&log_error=passwordincorrect");
    } else header("Location: ../index.php?page=login&log_error=pseudonotfound");
}

function confirmAccount()
{
    $conn = connect();

    $code = htmlspecialchars($_POST['code']);
    $accountid = htmlspecialchars($_GET['accountid']);

    $checkcode = "SELECT id, confirmCode FROM accounts WHERE id=" . $accountid;
    $resultcode = $conn->query($checkcode);
    $datacode = $resultcode->fetch_array(MYSQLI_ASSOC);

    if ($resultcode->num_rows == 1) {
        if ($code === $datacode['confirmCode']) {
            $setconfirmed = 'UPDATE accounts SET confirmed=1 WHERE id=' . $accountid;
            if ($conn->query($setconfirmed)) {
                header('Location: ../index.php?page=login&log_error=confirmed');
            }
        }
    } else header('Location: ../index.php');
}
