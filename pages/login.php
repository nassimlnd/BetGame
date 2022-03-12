<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - BetGame</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <?php
    include("../includes/header.php");
    ?>

    <div class="container">
        <div class="title-container">
            <h1 class="login-title">Connectez-vous !</h1>
        </div>

        <?php

        if (isset($_GET['log_error'])) {
            $error = htmlspecialchars($_GET['log_error']);

            switch ($error) {
                case 'notconnected':
        ?>
                    <div class="errorbox">
                        <p class="error"><strong>Erreur : </strong>Vous ne pouvez pas accéder à cette page si vous n'êtes pas connecté.</p>
                    </div>
                <?php
                    break;

                case 'pseudonotfound':
                ?>
                    <div class="errorbox">
                        <p class="error"><strong>Erreur : </strong>Aucun compte n'existe avec ce pseudo.</p>
                    </div>
                <?php
                    break;

                case 'passwordincorrect':
                ?>
                    <div class="errorbox">
                        <p class="error"><strong>Erreur : </strong>Mot de passe incorrect.</p>
                    </div>
        <?php
                    break;
            }
        };

        ?>


        <form action="../controllers/login.php" method="post">
            <label class="subtitle">Pseudo</label>
            <input type="text" name="pseudo" class="input-login" placeholder="Pseudo" required>
            <label class="subtitle">Mot de passe</label>
            <input type="password" name="password" class="input-login" placeholder="Mot de passe" required>
            <button type="submit" id="button-login">Se connecter</button>
        </form>
    </div>

</body>

<footer>
    <div class="left">
        <ul>
            <li>Lien1</li>
            <li>Lien1</li>
            <li>Lien1</li>
            <li>Lien1</li>
        </ul>
    </div>

    <div class="middle">
        <p class="copyright">Copyright</p>
    </div>

    <div class="right">

    </div>
</footer>

</html>