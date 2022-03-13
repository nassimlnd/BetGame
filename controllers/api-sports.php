<?php

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://v1.basketball.api-sports.io/games?league=120&season=2021',
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

file_put_contents("euroleague.json", $response);
