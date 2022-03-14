<?php

session_start();
// counting bet in session data 
// principal array = session bet 
if (isset($_GET['bet']) && isset($_GET['matchid']) && isset($_GET['sport']) && isset($_GET['league'])) {
    $matchid = htmlspecialchars($_GET['matchid']);
    $bet = htmlspecialchars($_GET['bet']);
    $sport = htmlspecialchars($_GET['sport']);
    $league = htmlspecialchars($_GET['league']);

    $error = "non";

    if(count($_SESSION['bet']) == 5){
        header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&bet=' . $bet . '&league=' . $league . '&error=toomanybet');
    } else {
        for($i = 0; $i< count($_SESSION['bet']); $i++){
            if($matchid == $_SESSION['bet'][$i]['matchid']){
                $error = "alreadybet";
            } 
        }
        
        if($error == "non"){
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
        } elseif($error == "alreadybet") {
            header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&bet=' . $bet . '&league=' . $league . '&error=alreadybet');
        }
    }
    
    
    
}


