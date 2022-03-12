<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire - BetGame</title>
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>

    <?php

    include("../includes/header.php");
    ?>

    <div class="container">
        <div class="title-container">
            <h1 class="login-title">Inscrivez-vous !</h1>
        </div>

        <?php

        if (isset($_GET['reg_error'])) {

            $err = htmlspecialchars($_GET['reg_error']);

            switch ($err) {
                case 'emailnotvalid':
        ?>
                    <div class="errorbox">
                        <p class="error"><strong>Erreur : </strong>L'e-mail n'est pas valide</p>
                    </div>
                <?php
                    break;

                case 'alreadypseudo':
                ?>
                    <div class="errorbox">
                        <p class="error"><strong>Erreur : </strong>Un compte avec ce pseudo existe déjà.</p>
                    </div>
                <?php
                    break;

                case 'alreadyemail':
                ?>
                    <div class="errorbox">
                        <p class="error"><strong>Erreur : </strong>Un compte avec cette e-mail existe déjà.</p>
                    </div>
        <?php
                    break;
            }
        };

        ?>

        <form action="../controllers/register.php" method="post">
            <label class="subtitle">Pseudo</label>
            <input type="text" name="pseudo" class="input-register" placeholder="Pseudo" required>
            <label class="subtitle">Password</label>
            <input type="password" name="password" class="input-register" placeholder="Mot de passe" required>
            <label class="subtitle">E-mail</label>
            <input type="email" name="email" class="input-register" placeholder="E-mail" required>
            <p class="cgu">En cliquant sur ce bouton, vous confirmez avoir lu, compris et accepter les <a href="#" class="linkcgu">Conditions d'utilisation</a> et la <a href="#" class="linkcgu">Politique de confidentialité</a>. </p>
            <button type="submit" id="button-register">S'inscrire</button>
        </form>
    </div>

</body>

</html>