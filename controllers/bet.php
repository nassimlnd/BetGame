<?php

session_start();

if (isset($_GET['bet']) && isset($_GET['matchid']) && isset($_GET['sport']) && isset($_GET['league'])) {
    $matchid = htmlspecialchars($_GET['matchid']);
    $bet = htmlspecialchars($_GET['bet']);
    $sport = htmlspecialchars($_GET['sport']);
    $league = htmlspecialchars($_GET['league']);

    $array = array(
        'bet' => $bet,
        'matchid' => $matchid,
        'sport' => $sport,
        'league' => $league
    );

    if (empty($_SESSION['bet'])) {
        $_SESSION['bet'] = array(
            0 => array(
                "bet" => $bet,
                'matchid' => $matchid,
                'sport' => $sport,
                'league' => $league
            )
        );
        header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&bet=' . $bet . '&league=' . $league);
    } else {
        array_push($_SESSION['bet'], $array);
        header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&bet=' . $bet . '&league=' . $league);
    }
}
