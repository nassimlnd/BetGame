<?php

session_start();

// Includes

include("points.php");

// Database connection variables
require_once('../config/database.php');

define('user', $user);
define('password', $password);
define('host', $host);
define('database', $database);


// counting bet in session data 
// principal array = session bet 
if (isset($_GET['bet']) && isset($_GET['matchid']) && isset($_GET['sport']) && isset($_GET['league'])) {
    $matchid = htmlspecialchars($_GET['matchid']);
    $bet = htmlspecialchars($_GET['bet']);
    $sport = htmlspecialchars($_GET['sport']);
    $league = htmlspecialchars($_GET['league']);
    $error = "non";

    if (isset($_SESSION['bet']) && count($_SESSION['bet']) == 5) {
        header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&bet=' . $bet . '&league=' . $league . '&error=toomanybet');
    } else {
        if (!isset($_SESSION['bet'])) {
            $_SESSION['bet'] = array();
        }

        for ($i = 0; $i < count($_SESSION['bet']); $i++) {
            if ($matchid == $_SESSION['bet'][$i]['matchid']) {
                $error = "alreadybet";
            }
        }

        if ($error == "non") {
            $array = array(
                'bet' => $bet,
                'matchid' => $matchid,
                'sport' => $sport,
                'league' => $league,
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

                header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&league=' . $league);
            } else {
                array_push($_SESSION['bet'], $array);
                header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&league=' . $league);
            }
        } elseif ($error == "alreadybet") {
            header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&league=' . $league . '&error=alreadybet');
        }
    }
}

if (isset($_GET['delete']) && isset($_GET['matchid']) && isset($_GET['sport']) && isset($_GET['league'])) {
    $matchid = htmlspecialchars($_GET['matchid']);
    $bet = htmlspecialchars($_GET['bet']);
    $sport = htmlspecialchars($_GET['sport']);
    $league = htmlspecialchars($_GET['league']);
    $nb = htmlspecialchars($_GET['delete']);
    array_splice($_SESSION['bet'], $nb, 1);
    header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&league=' . $league);
}

if (isset($_POST['mise'])) {
    $cotetotal = 2;
    $mise = htmlspecialchars($_POST['mise']);
    $error = 'no';

    // Check if the player has enough points to bet
    if ($mise > $_SESSION['points'] || $_SESSION['points'] == 0) {
        $error = 'notenoughpoints';
    }

    // Check if the game has started or not : if the game has started we cant bet, else we can.
    if ($error == 'no') {
        for ($i = 0; $i < count($_SESSION['bet']); $i++) {
            $league = $_SESSION['bet'][$i]['league'];
            $filename = '../json/' . $league . '.json';
            str_replace(" ", "", $filename);

            $matches = file_get_contents($filename);
            $matches = json_decode($matches, true);
            $matchidsession = $_SESSION['bet'][$i]['matchid'];
            if ($error = 'no') {
                for ($j = 0; $j < count($matches['response']); $j++) {
                    if ($matchidsession == $matches['response'][$j]['id']) {
                        $status = $matches['response'][$j]['status']['long'];

                        if ($status != "Not Started") {
                            $error = 'gamestarted';
                            break;
                        }
                    }
                }
            } else break;
        }
    }

    // Adding the bet to the database
    if ($error == 'no') {
        $conn = new mysqli($host, $user, $password, $database);

        $date = date("Y-m-d H:i:s");
        $addbet = "INSERT INTO bets(id, accountid, cote, mise, date) VALUES ('', '" . $_SESSION['id'] . "', '$cotetotal', '$mise', '$date')";
        if ($conn->query($addbet)) {
            echo 'ok query bets';
        }

        $querybetid = "SELECT id FROM bets WHERE accountid = '" . $_SESSION['id'] . "' AND cote='$cotetotal' AND mise='$mise'";
        $resultbetid = $conn->query($querybetid);
        $arraybetid = $resultbetid->fetch_array(MYSQLI_ASSOC);
        $betid = $arraybetid['id'];

        for ($i = 0; $i < count($_SESSION['bet']); $i++) {
            $matchidbet = $_SESSION['bet'][$i]['matchid'];
            $betbet = $_SESSION['bet'][$i]['bet'];
            $sportbet = $_SESSION['bet'][$i]['sport'];
            $leaguebet = $_SESSION['bet'][$i]['league'];

            $querybetdetails = "INSERT INTO bets_details(id, betid, accountid, matchid, bet, sport, league) VALUES ('', '$betid', '" . $_SESSION['id'] . "', '$matchidbet', '$betbet', '$sportbet', '$leaguebet')";

            $conn->query($querybetdetails);
        }

        unset($_SESSION['bet']);

        refreshPointsBet($mise, $conn);

        header("Location: ../index.php");
    }
}
