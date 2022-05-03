<?php

function refreshBasket(): void
{
    $league = array(
        0 => 12,
        1 => 20,
        2 => 120,
        3 => 2
    );

    for ($i = 0; $i < count($league); $i++) {
        $curl = curl_init();
        if ($league[$i] == 12 || $league[$i] == 20 || $league[$i] == 2) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://v1.basketball.api-sports.io/games?league=' . $league[$i] . '&season=2021-2022',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'x-rapidapi-key: 04ffc7b14445e02a0ef461ee4b74e6ea'
                ),
            ));
        } elseif ($league[$i] == 120) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://v1.basketball.api-sports.io/games?league=' . $league[$i] . '&season=2021',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'x-rapidapi-key: 04ffc7b14445e02a0ef461ee4b74e6ea'
                ),
            ));
        }

        $response = curl_exec($curl);
        curl_close($curl);

        $leaguename = '';

        switch ($league[$i]) {
            case 12:
                $leaguename = 'nba';
                break;
            case 20:
                $leaguename = 'gleague';
                break;
            case 120:
                $leaguename = 'euroleague';
                break;
            case 2:
                $leaguename = 'proa';
                break;
        };

        file_put_contents("json/basket/" . $leaguename . ".json", $response);
    }
}

function refreshFoot(): void
{
    $league = array(
        0 => 39,
        1 => 61,
        2 => 135,
        3 => 140
    );

    for ($i = 0; $i < count($league); $i++) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://v3.football.api-sports.io/fixtures?league=' . $league[$i] . '&season=2021',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-rapidapi-key: 04ffc7b14445e02a0ef461ee4b74e6ea'
            ),
        ));


        $response = curl_exec($curl);
        curl_close($curl);

        $leaguename = '';

        switch ($league[$i]) {
            case 39:
                $leaguename = 'pl';
                break;
            case 61:
                $leaguename = 'ligue1';
                break;
            case 135:
                $leaguename = 'seriea';
                break;
            case 140:
                $leaguename = 'liga';
                break;
        };

        file_put_contents("json/foot/" . $leaguename . ".json", $response);
    }
}

function refreshAll(): void
{
    $oldtime = (int)file_get_contents("data/maj.txt");
    $newtime = time();

    if ($newtime - $oldtime > 3600) {
        unlink('data/maj.txt');
        file_put_contents('data/maj.txt', $newtime);
        refreshFoot();
        refreshBasket();
    }
}
