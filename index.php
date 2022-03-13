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
    <meta name="description" content="Home description.">
    <!-- Social -->
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Quick Parcel Project — Home">
    <meta name="twitter:description" content="Home description.">
    <meta name="twitter:image" content="#">
    <!-- Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.example.com">
    <meta property="og:title" content="Quick Parcel Project — Home">
    <meta property="og:description" content="Home description.">
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
                <h2>Bientot Disponible</h2>
                <p>Télécharger notre Application BetGame, bientot disponible sur toutes les platfforme : ios , android , windows store ! Regarder les match et vos paris directement sur votre smartphone !</p>
                <a href="#">Bientot !</a>
            </div>
            <div>
                <h2>En savoir plus sur les match</h2>
                <p>Vous pouvez suivres tout les match sur notre site web et très bientot sur notre apllication ! </p>
                <a href="#">En savoir plus</a>
            </div>
            <div>
                <h2>Les prix</h2>
                <p>Les prix change tout les mois, seul les 5 premiers du classement seront éligible à un prix, bonne chance a tout n'aux parieur !</p>
                <a href="#">Details</a>
            </div>
            <div>
                <h2>Slide 4</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, accusantium non. Enim ducimus commodi repellendus maxime consequatur doloribus quasi aliquam.</p>
                <a href="#">Details</a>
            </div>
        </div>
    </section>

    <div class="body-content">

    </div>



    <script type="text/javascript" src="js/index.js"></script>
</body>

</html>