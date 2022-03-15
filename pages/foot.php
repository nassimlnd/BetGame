<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/sportOverview.css" />
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
    <title>Football - BetGame</title>
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
    include("../includes/header.php");
    ?>


    <div class="sidebar">
        <aside>
            <h4 class="sidebar-title">Ligues</h4>
            <ul>
                <li><a href="foot.php?league=ligue1">Ligue 1</a></li>
                <li><a href="foot.php?league=liga">Liga</a></li>
                <li><a href="foot.php?league=pl">Premier League</a></li>
                <li><a href="foot.php?league=seriea">Serie A</a></li>
            </ul>
        </aside>
    </div>


    <main class="main">
        <div class="container">

            <?php

            if (isset($_GET['league'])) {
                $league = htmlspecialchars($_GET['league']);
                $sport = 'foot';

                $filename = '../json/' . $sport . '/' . $league . '.json';
                $someArray = file_get_contents($filename);

                $someArray = json_decode($someArray, true);

                for ($i = 0; $i < count($someArray['response']); $i++) {
                    if ($someArray['response'][$i]['fixture']['status']['long'] == "Not Started") {
                        $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                        $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                        $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                        $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                        //echo '<div class="container">';
                        echo '<div class="container-match">';
                        echo '<h1 class="titre-match">Match du jour</h1>';
                        echo '<div class="left">';
                        echo '<figure class="team">';
                        echo '<img src="' . $logoteamhome . '" alt="teamhome">';
                        echo '<figcaption class="">' . $nameteamhome . '</figcaption>';
                        echo '</figure>';
                        echo '</div>';
                        echo '<div class="middle">';
                        echo '<div class="text">';
                        echo '<p>Date :</p>';
                        echo '<p>-</p>';
                        echo '<p>Heure :</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="right">';
                        echo '<figure class="team">';
                        echo '<img src="' . $logoteamaway . '" alt="teamhome">';
                        echo '<figcaption class="">' . $nameteamaway . '</figcaption>';
                        echo '</figure>';
                        echo '</div>';
                        echo '<a class="lien" href="../pages/pari.php?matchid=' . $someArray['response'][$i]['fixture']['id'] . '&sport=' . $sport . '&league=' . $league . '"><button id="pari">Parier</button></a>';
                        echo '</div>';
                    }
                }
            } else {
                header("Location: foot.php?league=ligue1");
            }
            ?>
        </div>

</body>

</html>