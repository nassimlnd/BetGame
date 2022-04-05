<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/app.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<script type="text/javascript" src="js/index.js"></script>-->
    <title><?= $title ?? '' ?>BetGame</title>
</head>

<body>

    <div class="header">
        <div class="bottom-border">
            <a href="/"><img src="img/logo.png" alt="Logo" id="logo"></a>
            <nav class="header-nav">
                <a href="/" class="links">Accueil</a>
                <div class="menu-sport">
                    <button type="button" class="links" onclick="showMenu()">Choisir un sport</button>
                    <div class="dropdown-menu">
                        <div class="dropdown-links-container">
                            <a href="basket" class="dropdown-links">Basket-ball</a>
                            <a href="football" class="dropdown-links">Football</a>
                            <a href="hockey" class="dropdown-links">Hockey</a>
                        </div>
                    </div>
                </div>
                <a href="scoreboard.php" class="links">Classement</a>
                <a href="quisommesnous.php" class="links">Qui sommes-nous ?</a>
            </nav>
            <div class="buttons">
                <a href="login" class="signin">
                    <button>Se connecter</button>
                </a>
                <a href="register" class="signup">
                    <button>S'inscrire</button>
                </a>
            </div>
            <div class="mobile-menu">
                <button type="button" class="mobile-menu-button" onclick="showMenuMobile()">
                    <svg class="h-6 w-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="mobile-menu-dropdown">
                    <div class="flex-box">
                        <a href="/"><img src="img/logo.png" alt="Logo" id="logo"></a>
                        <button type="button" class="close-button" onclick="closeMenuMobile()">
                            <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <a href="#" class="mobile-menu-dropdown-links">Lien 1</a>
                    <a href="#" class="mobile-menu-dropdown-links">Lien 2</a>
                </div>
            </div>

        </div>
    </div>

    <?= $content ?>

    <script type="text/javascript" src="js/index.js"></script>
</body>

</html>