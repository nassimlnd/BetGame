<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sportOverview.css">
    <title>Test</title>
</head>

<body>

    <?php
    include("../includes/header.php");
    ?>

    <div class="container">
<<<<<<< Updated upstream
        <?php $curl = curl_init();
=======
        <?php
        /*$curl = curl_init();
>>>>>>> Stashed changes
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
        //print_r($someArray);

<<<<<<< Updated upstream
        /*for ($i = 0; $i < 20; $i++) {
            echo $someArray["response"][$i]['team']['name'] . ' / ';
        }*/

        $pathlogo = $someArray["response"][0]["teams"]['home']["logo"];

        ?> <img src="<?= $pathlogo ?>" alt="logo">

        <?php




        ?>
=======
        for ($i = 0; $i < 20; $i++) {
            echo $someArray["response"][$i]['team']['name'] . ' / ';
        }

        $pathlogo = $someArray["response"][0]["teams"]['home']["logo"];

        ?> <img src="<?= $pathlogo ?>" alt="logo">*/

        ?>


        <div class="container-match">
            <h1 class="titre-match">Match du jour</h1>
            <div class="left">
                <figure class="team">
                    <img src="../images/pdpqui.png" alt="teamhome">
                    <figcaption class="">Nom team home</figcaption>
                </figure>
            </div>
            <div class="middle">
                <div class="text">
                    <p>Date :</p>
                    <p>-</p>
                    <p>Heure :</p>
                </div>
            </div>
            <div class="right">
                <figure class="team">
                    <img src="../images/pdpqui.png" alt="teamhome">
                    <figcaption class="">Nom team home</figcaption>
                </figure>
            </div>
            <a id="pari" href="../pages/pari.php?matchid=' . $someArray['response'][$i]['id'] . '&sport=basket&league=' . $ligue . '">Parier</a>
        </div>
>>>>>>> Stashed changes
    </div>

</body>

</html>