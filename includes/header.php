<?php
if (!isset($_SESSION['user'])) {
    session_start();
}

$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

if ($curPageName == "index.php") {
?>
    <header>
        <a href="index.php"><img src="images/logo.png" alt="Logo" id="logo"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="index.php">Accueil</a></li>
                <li id="sp"><a href="#">Choisir un sport</a>
                    <div class="NavToolTip">
                        <?php if (isset($_SESSION['user'])) {
                            echo '<div class="test_Tooltip_nav">';
                        } else {
                            echo '<div class="test_Tooltip_nav" style = "left: 36.5%;">';
                        }
                        ?>
                        <ul>
                            <li id="tooltip"> <a href="pages/basket.php">Basket-ball</a></li>
                            <li id="tooltip"> <a href="pages/foot.php">Foot-ball</a></li>
                            <li id="tooltip"> <a href="pages/hockey.php">Hockey</a></li>
                            <li id="tooltip"> <a href="pages/UFC.php">UFC</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="pages/scoreboard.php">Classement</a></li>
                <li><a href="pages/quisommesnous.php">Qui sommes nous ?</a></li>
            </ul>
        </nav>
        <div class="buttons">
            <?php

            if (isset($_SESSION['user'])) {
                require_once('controllers/points.php');
            ?>
                <p class="username">Bonjour <a href="pages/profil.php"><strong><?= $_SESSION['user'] ?></strong></a> | <?= $_SESSION['points'] ?> BetCoin(s)</p>
                <a href="controllers/logout.php" class="logout"><button class="signin">Déconnexion</button></a>
            <?php
            } else {
            ?>
                <a href="pages/login.php" class="signin"><button>Se connecter</button></a>
                <a href="pages/register.php" class="signup"><button>S'inscrire</button></a>
            <?php
            };
            ?>
        </div>
    </header>
<?php
} else {
?>
    <header>
        <a href="../index.php"><img src="../images/logo.png" alt="Logo" id="logo"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="../index.php">Accueil</a></li>
                <li id="sp"><a href="#">Choisir un sport</a>
                    <div class="NavToolTip">
                        <?php if (isset($_SESSION['user'])) {
                            echo '<div class="test_Tooltip_nav">';
                        } else {
                            echo '<div class="test_Tooltip_nav" style = "left: 36.5%;">';
                        }
                        ?>
                        <ul>
                            <li id="tooltip"> <a href="basket.php">Basket-ball</a></li>
                            <li id="tooltip"> <a href="foot.php">Foot-ball</a></li>
                            <li id="tooltip"> <a href="hockey.php">Hockey</a></li>
                            <li id="tooltip"> <a href="UFC.php">UFC</a></li>
                        </ul>
                    </div>
                    </div>
                </li>
                <li><a href="scoreboard.php">Classement</a></li>
                <li><a href="quisommesnous.php">Qui sommes nous ?</a></li>
            </ul>
        </nav>
        <div class="buttons">
            <?php

            if (isset($_SESSION['user'])) {
                include('../controllers/points.php');
            ?>
                <p class="username">Bonjour <a href="../pages/profil.php"><strong><?= $_SESSION['user'] ?></strong></a> | <?= $_SESSION['points'] ?> BetCoin(s)</p>
                <a href="../controllers/logout.php" class="logout"><button class="signin">Déconnexion</button></a>
            <?php
            } else {
            ?>
                <a href="login.php" class="signin"><button>Se connecter</button></a>
                <a href="register.php" class="signup"><button>S'inscrire</button></a>
            <?php
            };
            ?>
        </div>
    </header>
<?php
};
?>