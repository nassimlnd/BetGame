<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/app.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="header">
        <div class="bottom-border">
            <a href="index.php"><img src="images/logo.png" alt="Logo" id="logo"></a>
            <nav class="header-nav">
                <a href="index.php" class="links">Accueil</a>
                <div class="menu-sport">
                    <button type="button" class="links" onclick="showMenu()">Choisir un sport</button>
                    <div class="dropdown-menu">
                        <div class="dropdown-links-container">
                            <a href="index.php?page=sports&sport=basket" class="dropdown-links">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12.941 21.956a9.96 9.96 0 0 0 6.13-2.885c3.905-3.905 3.905-10.237 0-14.142c-3.905-3.905-10.237-3.905-14.142 0c-3.905 3.905-3.905 10.237 0 14.142a9.976 9.976 0 0 0 7.687 2.91a.745.745 0 0 0 .325-.025ZM3.577 10.854a8.457 8.457 0 0 1 1.905-4.31L10.94 12l-1.088 1.088c-1.052-.85-2.224-1.308-3.341-1.608c-.65-.174-1.296-.3-1.887-.413l-.016-.004c-.367-.07-.71-.137-1.03-.209Zm-.069 1.52c.266.056.535.108.8.16l.014.002c.603.117 1.202.233 1.799.393c.953.256 1.861.616 2.662 1.228l-3.3 3.3a8.468 8.468 0 0 1-1.975-5.083Zm6.339 2.84c.675.862 1.04 1.806 1.297 2.773c.125.47.221.928.318 1.392l.084.395c.05.24.105.481.165.721a8.469 8.469 0 0 1-5.168-1.977l3.304-3.304Zm3.393 5.196a15.59 15.59 0 0 1-.228-.95l-.077-.367c-.098-.469-.205-.98-.341-1.492c-.301-1.128-.762-2.337-1.68-3.454L12 13.061l5.457 5.457a8.455 8.455 0 0 1-4.217 1.892ZM13.06 12l1.212-1.211c1.114.942 2.28 1.46 3.365 1.826c.447.152.897.282 1.311.403c.159.046.313.09.46.134c.35.106.671.208.964.321a8.453 8.453 0 0 1-1.854 3.984L13.06 12Zm6.777-.285l-.502-.147a28.798 28.798 0 0 1-1.217-.374c-.944-.32-1.888-.74-2.781-1.47l3.18-3.181a8.472 8.472 0 0 1 1.983 5.382c-.22-.075-.443-.144-.663-.21Zm-2.38-6.233l-3.181 3.181c-.73-.893-1.151-1.837-1.47-2.781a27.45 27.45 0 0 1-.374-1.218v-.001c-.05-.166-.097-.332-.148-.5c-.066-.22-.134-.443-.209-.663a8.472 8.472 0 0 1 5.382 1.982Zm-6.073.88c.367 1.085.884 2.252 1.827 3.366L12 10.94L6.543 5.482a8.453 8.453 0 0 1 3.984-1.854c.113.293.215.613.32.964l.135.46c.12.414.25.863.402 1.31Z" />
                                </svg>
                                Basket-ball</a>
                            <a href="index.php?page=sports&sport=foot" class="dropdown-links">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19.071 4.929a9.936 9.936 0 0 0-7.07-2.938a9.943 9.943 0 0 0-7.072 2.938c-3.899 3.898-3.899 10.243 0 14.142a9.94 9.94 0 0 0 7.073 2.938a9.936 9.936 0 0 0 7.07-2.937c3.899-3.898 3.899-10.243-.001-14.143zM12.181 4h-.359c.061-.001.119-.009.18-.009s.118.008.179.009zm6.062 13H16l-1.258 2.516a7.956 7.956 0 0 1-2.741.493a7.96 7.96 0 0 1-2.746-.494L8 17.01H5.765a7.96 7.96 0 0 1-1.623-3.532L6 11L4.784 8.567a7.936 7.936 0 0 1 1.559-2.224a7.994 7.994 0 0 1 3.22-1.969L12 6l2.438-1.625a8.01 8.01 0 0 1 3.22 1.968a7.94 7.94 0 0 1 1.558 2.221L18 11l1.858 2.478A7.952 7.952 0 0 1 18.243 17z" />
                                    <path fill="currentColor" d="m8.5 11l1.5 4h4l1.5-4L12 8.5z" />
                                </svg>
                                Football</a>
                        </div>
                    </div>
                </div>
                <a href="index.php?page=classement" class="links">Classement</a>
                <a href="index.php?page=aboutus" class="links">Qui sommes-nous ?</a>
            </nav>
            <?php
            // Affiche les onglets relatif au profil si une session est active
            if (isset($_SESSION['user'])) {
            ?>
                <div class="profil">
                    <button type="button" class="links" onclick="showProfilMenu()"><?= $_SESSION['user'] ?>, <?= $_SESSION['points'] ?> BetCoin(s)</button>
                    <div class="profil-menu">
                        <div class="profil-links-container">
                            <a href="index.php?page=profil&section=informations" class="profil-links">Informations</a>
                            <a href="index.php?page=profil&section=historique" class="profil-links">Historique des paris</a>
                            <a href="index.php?page=boutique" class="profil-links">Boutique</a>
                            <div class="profil-menu-buttons">
                                <a href="controllers/login.php?action=logout" class="profil-logout-button">Se déconnecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else { ?>
                <div class="buttons">
                    <a href="index.php?page=login" class="signin">
                        <button>Se connecter</button>
                    </a>
                    <a href="index.php?page=register" class="signup">
                        <button>S'inscrire</button>
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="mobile-menu">
                <button type="button" class="mobile-menu-button" onclick="showMenuMobile()">
                    <svg class="h-6 w-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="mobile-menu-dropdown">
                    <div class="flex-box">
                        <a href="Index.php"><img src="images/logo.png" alt="Logo" id="logo"></a>
                        <button type="button" class="close-button" onclick="closeMenuMobile()">
                            <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <a href="index.php?page=sports&sport=basket" class="mobile-menu-dropdown-links flex">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12.941 21.956a9.96 9.96 0 0 0 6.13-2.885c3.905-3.905 3.905-10.237 0-14.142c-3.905-3.905-10.237-3.905-14.142 0c-3.905 3.905-3.905 10.237 0 14.142a9.976 9.976 0 0 0 7.687 2.91a.745.745 0 0 0 .325-.025ZM3.577 10.854a8.457 8.457 0 0 1 1.905-4.31L10.94 12l-1.088 1.088c-1.052-.85-2.224-1.308-3.341-1.608c-.65-.174-1.296-.3-1.887-.413l-.016-.004c-.367-.07-.71-.137-1.03-.209Zm-.069 1.52c.266.056.535.108.8.16l.014.002c.603.117 1.202.233 1.799.393c.953.256 1.861.616 2.662 1.228l-3.3 3.3a8.468 8.468 0 0 1-1.975-5.083Zm6.339 2.84c.675.862 1.04 1.806 1.297 2.773c.125.47.221.928.318 1.392l.084.395c.05.24.105.481.165.721a8.469 8.469 0 0 1-5.168-1.977l3.304-3.304Zm3.393 5.196a15.59 15.59 0 0 1-.228-.95l-.077-.367c-.098-.469-.205-.98-.341-1.492c-.301-1.128-.762-2.337-1.68-3.454L12 13.061l5.457 5.457a8.455 8.455 0 0 1-4.217 1.892ZM13.06 12l1.212-1.211c1.114.942 2.28 1.46 3.365 1.826c.447.152.897.282 1.311.403c.159.046.313.09.46.134c.35.106.671.208.964.321a8.453 8.453 0 0 1-1.854 3.984L13.06 12Zm6.777-.285l-.502-.147a28.798 28.798 0 0 1-1.217-.374c-.944-.32-1.888-.74-2.781-1.47l3.18-3.181a8.472 8.472 0 0 1 1.983 5.382c-.22-.075-.443-.144-.663-.21Zm-2.38-6.233l-3.181 3.181c-.73-.893-1.151-1.837-1.47-2.781a27.45 27.45 0 0 1-.374-1.218v-.001c-.05-.166-.097-.332-.148-.5c-.066-.22-.134-.443-.209-.663a8.472 8.472 0 0 1 5.382 1.982Zm-6.073.88c.367 1.085.884 2.252 1.827 3.366L12 10.94L6.543 5.482a8.453 8.453 0 0 1 3.984-1.854c.113.293.215.613.32.964l.135.46c.12.414.25.863.402 1.31Z" />
                        </svg>
                        Basket-ball</a>
                    <a href="index.php?page=sports&sport=foot" class="mobile-menu-dropdown-links flex">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19.071 4.929a9.936 9.936 0 0 0-7.07-2.938a9.943 9.943 0 0 0-7.072 2.938c-3.899 3.898-3.899 10.243 0 14.142a9.94 9.94 0 0 0 7.073 2.938a9.936 9.936 0 0 0 7.07-2.937c3.899-3.898 3.899-10.243-.001-14.143zM12.181 4h-.359c.061-.001.119-.009.18-.009s.118.008.179.009zm6.062 13H16l-1.258 2.516a7.956 7.956 0 0 1-2.741.493a7.96 7.96 0 0 1-2.746-.494L8 17.01H5.765a7.96 7.96 0 0 1-1.623-3.532L6 11L4.784 8.567a7.936 7.936 0 0 1 1.559-2.224a7.994 7.994 0 0 1 3.22-1.969L12 6l2.438-1.625a8.01 8.01 0 0 1 3.22 1.968a7.94 7.94 0 0 1 1.558 2.221L18 11l1.858 2.478A7.952 7.952 0 0 1 18.243 17z" />
                            <path fill="currentColor" d="m8.5 11l1.5 4h4l1.5-4L12 8.5z" />
                        </svg>
                        Football</a>
                    <div class="mobile-menu-buttons">
                        <?php
                        // Affiche les onglets relatif au profil si une session est active
                        if (isset($_SESSION['user'])) {
                        ?>
                            <a href="index.php?page=profil&section=informations"><?= $_SESSION['user'] ?></a>
                        <?php
                        } else { ?>
                            <div class="buttons">
                                <a href="index.php?page=login" class="signin">
                                    <button>Se connecter</button>
                                </a>
                                <a href="index.php?page=register" class="signup">
                                    <button>S'inscrire</button>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>