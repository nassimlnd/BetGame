<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php?log_error=notconnected");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pari - BetGame</title>
    <link rel="stylesheet" href="../css/pari.css">
</head>

<body>

    <?php
    include("../includes/header.php");


    if (isset($_GET['sport']) && isset($_GET['matchid']) && isset($_GET['league'])) {

        $matchid = htmlspecialchars($_GET['matchid']);
        $league = htmlspecialchars($_GET['league']);

        $filename = '../json/' . $league . '.json';
        str_replace(" ", "", $filename);

        $matches = file_get_contents($filename);
        $matches = json_decode($matches, true);

        $nameteamaway = '';
        $nameteamhome = '';

        $logoteamaway = '';
        $logoteamhome = '';



        for ($i = 0; $i < count($matches['response']); $i++) {
            if ($matchid == $matches['response'][$i]['id']) {
                $nameteamhome = $matches['response'][$i]['teams']['home']['name'];
                $nameteamaway = $matches['response'][$i]['teams']['away']['name'];

                $logoteamhome = $matches['response'][$i]['teams']['home']['logo'];
                $logoteamaway = $matches['response'][$i]['teams']['away']['logo'];
                break;
            }
        }

    ?>
        <div class="container-principal">
            <h1>Pari :</h1>

            <div class="gauche">
                <figure>
                    <figcaption class="titreequipe"><?= $nameteamhome ?></figcaption>
                    <img src="<?= $logoteamhome ?>" alt="gauche" class="image">
                </figure>
                <p class="cote">Cote : 2.00</p>
                <button class="btnmise">Miser</button>
            </div>

            <div class="milieu">
                <p id="vs">-</p>
            </div>

            <div class="droit">
                <figure>
                    <figcaption class="titreequipe"><?= $nameteamaway ?></figcaption>
                    <img src="<?= $logoteamaway ?>" alt="droit" class="image">
                </figure>
                <p class="cote">Cote : 2.00</p>
                <button class="btnmise">Miser</button>
            </div>
        </div>
    <?php

    };
    if (!isset($_GET['sport']) || !isset($_GET['matchid']) || !isset($_GET['league'])) {
    ?>
        <div class="container-principal">
            <h1>Pari :</h1>

            <div class="gauche">
                <figure>
                    <figcaption class="titreequipe">Conor MCGREGOR</figcaption>
                    <img src="../images/conor.jpg" alt="gauche" class="image">
                </figure>
                <p class="cote">Cote : 2.00</p>
                <button class="btnmise">Miser</button>
            </div>

            <div class="milieu">
                <p id="vs">-</p>
            </div>

            <div class="droit">
                <figure>
                    <figcaption class="titreequipe">Khamzat CHIMAEV</figcaption>
                    <img src="../images/khamzat.jpg" alt="droit" class="image">
                </figure>
                <p class="cote">Cote : 2.00</p>
                <button class="btnmise">Miser</button>
            </div>
        </div>
    <?php

    };

    ?>

    <div class="container-details">
        <div class="line">
            <div class="left">
                <p class="stats">150 kg</p>
            </div>
            <div class="middle">
                <p class="detailsname">Poids</p>
            </div>
            <div class="right">
                <p class="stats">100 kg</p>
            </div>
        </div>
        <div class="line">
            <div class="left">
                <p class="stats">150 kg</p>
            </div>
            <div class="middle">
                <p class="detailsname">Taille</p>
            </div>
            <div class="right">
                <p class="stats">100 kg</p>
            </div>
        </div>
        <div class="line">
            <div class="left">
                <p class="stats">150 kg</p>
            </div>
            <div class="middle">
                <p class="detailsname">Nombre de victoires</p>
            </div>
            <div class="right">
                <p class="stats">100 kg</p>
            </div>
        </div>
        <div class="line">
            <div class="left">
                <p class="stats">150 kg</p>
            </div>
            <div class="middle">
                <p class="detailsname">Origine</p>
            </div>
            <div class="right">
                <p class="stats">100 kg</p>
            </div>
        </div>
    </div>


    <script type="module" src="js/index.js"></script>
</body>

</html>