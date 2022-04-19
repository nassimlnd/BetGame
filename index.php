<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Canonical -->
    <link rel="canonical" href="https://www.example.com">
    <!-- Robots -->
    <meta name="robots" content="noindex, nofollow">
    <!-- Device -->
    <!-- <meta name="viwport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5">
    <meta name="format-detection" content="telephone=no">
    <!-- Title -->
    <title>BetGame</title>
    <!-- Description -->
    <meta name="description" content="Site de paris sportif gratuit">
    <!-- Social -->
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="BetGame">
    <meta name="twitter:description" content="Site de paris sportif gratuit">
    <meta name="twitter:image" content="#">
    <!-- Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.example.com">
    <meta property="og:title" content="BetGame">
    <meta property="og:description" content="Site de paris sportif gratuit">
    <meta property="og:image" content="#">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <!-- Favicon -->
    <meta name="theme-color" content="#fff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fanwood+Text:ital@0;1&family=Tenor+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <?php

    include('includes/header.php');
    ?>

    <section class="banner">
        <div class="imgBx">
            <img src="images/img1.jpg" class="active">
            <img src="images/img2.jpg">
            <img src="images/img3.jpg">
            <img src="images/img4.jpg">
        </div>
        <ul class="controls">
            <li onclick="previousSlide();"></li>
            <li onclick="nextSlide();"></li>
        </ul>

        <div class="contentBx">
            <div class="active">
                <h2>Bientôt disponible</h2>
                <p>Télécharger notre application BetGame, bientôt disponible sur toutes les plateformes : IOS, Android ! Regarder les matchs et vos paris directement sur votre smartphone !</p>
                <a href="#">Bientôt !</a>
            </div>
            <div>
                <h2>En savoir plus sur les matchs</h2>
                <p>Vous pouvez suivre tous les matchs sur notre site web et très bientot sur notre application !</p>
                <a href="#">En savoir plus</a>
            </div>
            <div>
                <h2>Les prix</h2>
                <p>Les prix change tous les mois, seul les 5 premiers du classement seront éligible à un prix, bonne chance a tous !</p>
                <a href="pages\scoreboard.php">Details</a>
            </div>
            <div>
                <h2>Notre systeme<br>de rank !</h2>
                <p>Voici notre systeme Rank <br>
                    essayer de vous issez en haut du classement <br>
                    pour gagner des Betcoins ! </p>
                <a href="pages\scoreboard.php">Details</a>
            </div>
        </div>
    </section>



    <script type="text/javascript" src="js/index.js"></script>
</body>

</html>