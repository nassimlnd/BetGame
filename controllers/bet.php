<?php

if (!isset($_SESSION['user'])) {
    session_start();
}

// Includes

include_once("points.php");
include_once("match.php");

// Database connection variables
require_once('../config/database.php');

define('user', $user);
define('password', $password);
define('host', $host);
define('database', $database);

$conn = new mysqli($host, $user, $password, $database);


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
                'cote' => $cote
            );

            if (empty($_SESSION['bet'])) {
                $_SESSION['bet'] = array(
                    0 => array(
                        "bet" => $bet,
                        'matchid' => $matchid,
                        'sport' => $sport,
                        'league' => $league,
                        'cote' => $cote
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
            $sport = $_SESSION['bet'][$i]['sport'];
            $filename = '../json/' . $sport . '/' . $league . '.json';
            str_replace(" ", "", $filename);

            $matches = file_get_contents($filename);
            $matches = json_decode($matches, true);
            $matchidsession = $_SESSION['bet'][$i]['matchid'];
            if ($error = 'no') {
                for ($j = 0; $j < count($matches['response']); $j++) {
                    if ($sport == 'foot') {
                        if ($matchidsession == $matches['response'][$j]['fixture']['id']) {
                            $status = $matches['response'][$j]['fixture']['status']['long'];

                            if ($status != "Not Started") {
                                $error = 'gamestarted';
                                break;
                            }
                        }
                    } elseif ($sport == 'basket') {
                        if ($matchidsession == $matches['response'][$j]['id']) {
                            $status = $matches['response'][$j]['status']['long'];

                            if ($status != "Not Started") {
                                $error = 'gamestarted';
                                break;
                            }
                        }
                    }
                }
            } else break;
        }
    }

    // Adding the bet to the database
    if ($error == 'no') {
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

        setCoteMatch($conn, $matchidbet, $sportbet, $leaguebet, $betbet);

        refreshPointsBet($mise, $conn);

        header("Location: ../index.php");
    }
}

function checkBet(mysqli $conn): bool
{
    include_once('../controllers/points.php');

    $win = false;

    $queryallbets = "SELECT * FROM bets WHERE accountid =" . $_SESSION['id'];
    $resultallbets = $conn->query($queryallbets);
    $arrayallbets = $resultallbets->fetch_all(MYSQLI_ASSOC);

    for ($i = 0; $i < count($arrayallbets); $i++) {
        if ($arrayallbets[$i]['validated'] == 0) {
            $betsdetails = "SELECT * FROM bets_details WHERE betid =" . $arrayallbets[$i]['id'];
            $resultbetdetails = $conn->query($betsdetails);
            $arraybetdetails = $resultbetdetails->fetch_all(MYSQLI_ASSOC);

            for ($j = 0; $j < count($arraybetdetails); $j++) {
                $sportbetdetails = $arraybetdetails[$j]['sport'];
                $leaguebetdetails = $arraybetdetails[$j]['league'];
                $matchidbetdetails = $arraybetdetails[$j]['matchid'];
                $betbetdetails = $arraybetdetails[$j]['bet'];

                $filename = '../json/' . $sportbetdetails . '/' . $leaguebetdetails . '.json';
                $arrayjson = file_get_contents($filename);
                $arrayjson = json_decode($arrayjson, true);

                for ($k = 0; $k < count($arrayjson['response']); $k++) {
                    if ($sportbetdetails == "foot") {
                        if ($matchidbetdetails == $arrayjson['response'][$k]['fixture']['id']) {
                            if ($arrayjson['response'][$k]['fixture']['status']['long'] == "Game Finished") {
                                $scorehome = $arrayjson['response'][$k]['score']['fulltime']['home'];
                                $scoreaway = $arrayjson['response'][$k]['score']['fulltime']['away'];

                                $winner = '0';
                                if ($scorehome > $scoreaway) {
                                    $winner = 1;
                                } else $winner = 2;

                                if ($betbetdetails == $winner) {
                                    $win = true;
                                } else {
                                    if ($conn->query("UPDATE bets SET status = 0, validated = 1 WHERE id =" . $arrayallbets[$i]['id'])) {
                                        echo 'ok';
                                    }
                                    return false;
                                }
                            } else break;
                        }
                    } elseif ($sportbetdetails == "basket") {
                        if ($matchidbetdetails == $arrayjson['response'][$k]['id']) {
                            if ($arrayjson['response'][$k]['status']['long'] == "Game Finished") {
                                $scorehome = $arrayjson['response'][$k]['scores']['home']['total'];
                                $scoreaway = $arrayjson['response'][$k]['scores']['away']['total'];

                                $winner = 0;
                                if ($scorehome > $scoreaway) {
                                    $winner = 1;
                                } else $winner = 2;

                                if ($betbetdetails == $winner) {
                                    $win = true;
                                } else {
                                    $basketrequest = "UPDATE bets SET status = 0 WHERE id =" . $arrayallbets[$i]['id'];
                                    $basketrequest2 = "UPDATE bets SET validated = 1 WHERE id =" . $arrayallbets[$i]['id'];
                                    if ($conn->query($basketrequest) && $conn->query($basketrequest2)) {
                                        echo 'ok';
                                    }
                                    return false;
                                }
                            } else break;
                        }
                    }
                }
            }

            if ($win == true) {
                $cotetotale = $arrayallbets[$i]['cote'];
                $mise = $arrayallbets[$i]['mise'];

                $actualpoints = $_SESSION['points'];

                $newamountpoints = $mise * $cotetotale + $actualpoints;

                if ($conn->query("UPDATE bets SET status = 1 WHERE id =" . $arrayallbets[$i]['id']) && $conn->query("UPDATE bets SET validated = 1 WHERE id =" . $arrayallbets[$i]['id'])) {
                    echo 'ok';
                }

                setPoints($newamountpoints, $conn);
                return true;
            } else {
                return false;
            }
        }
    }
}

checkBet($conn);
