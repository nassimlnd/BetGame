<title>Inscription - BetGame</title>

<div class="register-container">
    <div class="logo">
        <img src="images/logo.png" alt="Logo BetGame">
    </div>
    <div class="register-title">
        <h2>Inscrivez-vous</h2>
    </div>
    <div class="register-form">
        <form action="src/Controllers/RegisterController.php" method="post">
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