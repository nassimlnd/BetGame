<title>S'inscrire - BetGame</title>
<?php

if (!isset($_SESSION['user'])) {

    if (isset($_GET['reg_error']) && $_GET['reg_error'] == 'success') {
?>
        <div class="notif-success">
            <p class="success-text">✅ Un mail vient d'être envoyé pour confirmer votre inscription.</p>
        </div>
    <?php
    }
    ?>

    <div class="register-container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo BetGame">
        </div>
        <div class="register-title">
            <h2>Inscrivez-vous</h2>
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
        <div class="register-form">
            <form action="controllers/register.php" method="post">
                <input type="text" class="register-input" placeholder="Pseudo" name="pseudo" required>
                <input type="password" class="register-input" placeholder="Mot de passe" name="password" required>
                <input type="text" class="register-input" placeholder="E-mail" name="email" required>
                <div class="flex register-cgu">
                    <div class="cgu-checkbox flex">
                        <input type="checkbox" name="cgu-checkbox" id="cgu-checkbox" required>
                        <label for="cgu-checkbox">En cochant cette case vous acceptez les CGU.</label>
                    </div>
                </div>
                <button type="submit" class="register-button">S'inscrire</button>
            </form>
        </div>
    </div>
<?php
} else header('Location: ../index.php');
?>

</body>

</html>