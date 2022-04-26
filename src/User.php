<?php

namespace App;

use mysqli;

class User
{
    public static function checkEmail(string $email)
    {
        $conn = Database::databaseConnect();

        $queryCheckEmail = "SELECT * FROM accounts WHERE email = '$email'";

        $result = $conn->query($queryCheckEmail);

        if ($result->num_rows > 0) {
            return false;
        } else return true;
    }

    public static function checkPseudo(string $pseudo)
    {
        $conn = Database::databaseConnect();

        $queryCheckPseudo = "SELECT * FROM accounts WHERE pseudo = '$pseudo'";

        $result = $conn->query($queryCheckPseudo);

        if ($result->num_rows > 0) {
            return false;
        } else return true;
    }

    public static function getUser($pseudo) : array {
        $conn = Database::databaseConnect();

        $queryGetUser = "SELECT id, pseudo, password, email, points, confirmed FROM accounts WHERE pseudo = '$pseudo'";

        $result = $conn->query($queryGetUser);
        return $result->fetch_assoc();
    }
}
