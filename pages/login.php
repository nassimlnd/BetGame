<?php

if (isset($_GET['log_error']) && $_GET['log_error'] == 'notconfirmed') {
?>
    <div class="login-container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo BetGame">
        </div>
        <div class="login-title">
            <h2>Confirmez votre inscription</h2>
        </div>

        <div class="login-form">
            <form action="controllers/login.php?accountid=<?= $_GET['accountid'] ?>" method="POST">
                <input type="text" name="code" placeholder="Code" class="confirm-input" required>
                <div class="signin-button">
                    <button type="submit" class="flex login-button">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
<?php
} else {
?>
    <div class="login-container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo BetGame">
        </div>
        <div class="login-title">
            <h2>Connectez-vous</h2>
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


        <div class="login-form">
            <form action="controllers/login.php" method="POST">
                <input type="text" class="login-input" placeholder="Pseudo" name="pseudo" required>
                <input type="password" class="password-input" placeholder="Mot de passe" name="password" required>
                <div class="flex login-items">
                    <div class="flex login-remember">
                        <input type="checkbox" name="remember-me" class="checkbox-remember">
                        <label for="remember-me"> Se souvenir de moi</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Mot de passe oublié ?</a>
                    </div>
                </div>
                <div class="signin-button">
                    <button type="submit" class="flex login-button">
                        <span class="login-button-span">
                            <svg x-description="Heroicon name: solid/lock-closed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php
}
