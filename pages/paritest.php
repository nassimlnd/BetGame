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

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v3.football.api-sports.io/fixtures?league=39&season=2021&status=ns&team=47',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'x-rapidapi-key: 21c977b6cc86dbabbc7661ea2e437cdf'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    $someArray = json_decode($response, true);


    $logohome = $someArray['response'][0]['teams']['home']['logo'];
    $logoaway = $someArray['response'][0]['teams']['away']['logo'];

    $nameteamhome = $someArray['response'][0]['teams']['home']['name'];
    $nameteamaway = $someArray['response'][0]['teams']['away']['name'];

    ?>


    <div class="container-principal">
        <h1>Pari :</h1>

        <div class="gauche">
            <figure>
                <figcaption class="titreequipe"><?= $nameteamhome ?></figcaption>
                <img src="<?= $logohome ?>" alt="gauche" class="image">
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
                <img src="<?= $logoaway ?>" alt="droit" class="image">
            </figure>
            <p class="cote">Cote : 2.00</p>
            <button class="btnmise">Miser</button>
        </div>
    </div>

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