<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Test</title>
</head>

<body>

    <?php
    include("../includes/header.php");
    ?>

    <div class="container">
        <?php $curl = curl_init();
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

        /*for ($i = 0; $i < 20; $i++) {
            echo $someArray["response"][$i]['team']['name'] . ' / ';
        }*/

        $pathlogo = $someArray["response"][0]["teams"]['home']["logo"];

        ?> <img src="<?= $pathlogo ?>" alt="logo">

        <?php




        ?>
    </div>

</body>

</html>