<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetGame</title>
    <link rel="stylesheet" href="css/app.css">
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