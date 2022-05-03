<?php

// Includes

include_once("controllers/points.php");
include_once("controllers/match.php");

// Database connection variables

$conn = connect();


// counting bet in session data 
// principal array = session bet 
if (isset($_GET['bet']) && isset($_GET['matchid']) && isset($_GET['sport']) && isset($_GET['league'])) {
    addBet($conn);
}

if (isset($_GET['delete']) && isset($_GET['matchid']) && isset($_GET['sport']) && isset($_GET['league'])) {
    deleteBet();
}

if (isset($_POST['mise'])) {
    miseBet($conn);
}

function checkBet(mysqli $conn): void
{
    if (isset($_SESSION['user'])) {
        $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

        if ($curPageName == 'index.php') {
            include_once('controllers/points.php');
        } else
            include_once('../controllers/points.php');

        $win = false;
        $loose = false;

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

                    if ($curPageName == 'index.php') {
                        $filename = 'json/' . $sportbetdetails . '/' . $leaguebetdetails . '.json';
                    } else
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
                                        }
                                        $loose = true;
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
                                        }
                                        $loose = true;
                                    }
                                } else break;
                            }
                        }
                    }
                }

                if ($win == true && $loose == false) {
                    $cotetotale = $arrayallbets[$i]['cote'];
                    $mise = $arrayallbets[$i]['mise'];

                    $actualpoints = $_SESSION['points'];

                    $newamountpoints = $mise * ($cotetotale / 100) + $actualpoints;

                    if ($conn->query("UPDATE bets SET status = 1 WHERE id =" . $arrayallbets[$i]['id']) && $conn->query("UPDATE bets SET validated = 1 WHERE id =" . $arrayallbets[$i]['id'])) {
                    }

                    setPoints($newamountpoints, $conn);
                }
            }
        }
    }
}

function addBet(mysqli $conn): void
{
    if (!isset($_SESSION['user'])) {
        session_start();
    }
    $matchid = htmlspecialchars($_GET['matchid']);
    $bet = htmlspecialchars($_GET['bet']);
    $sport = htmlspecialchars($_GET['sport']);
    $league = htmlspecialchars($_GET['league']);
    $cote = getCoteMatch($conn, $matchid, $bet, $sport, $league);

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

function miseBet(mysqli $conn): void
{
    if (!isset($_SESSION['user'])) {
        session_start();
    }

    $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
    $mise = htmlspecialchars($_POST['mise']);
    $error = 'no';
    $cotetotale = 1;

    // Check if the player has enough points to bet
    if ($mise > $_SESSION['points'] || $_SESSION['points'] == 0) {
        $error = 'notenoughpoints';
    }

    // Check if the game has started or not : if the game has started we cant bet, else we can.
    if ($error == 'no') {
        for ($i = 0; $i < count($_SESSION['bet']); $i++) {
            $cotetotale = $cotetotale * $_SESSION['bet'][$i]['cote'];
            $league = $_SESSION['bet'][$i]['league'];
            $sport = $_SESSION['bet'][$i]['sport'];

            if ($curPageName == 'index.php') {
                $filename = 'json/' . $sport . '/' . $league . '.json';
            } else
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
        $addbet = "INSERT INTO bets(id, accountid, cote, mise, date) VALUES ('', '" . $_SESSION['id'] . "', '$cotetotale', '$mise', '$date')";
        if ($conn->query($addbet)) {
        }

        $betid = $conn->insert_id;

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

function deleteBet(): void
{
    if (!isset($_SESSION['user'])) {
        session_start();
    }

    $matchid = htmlspecialchars($_GET['matchid']);
    $bet = htmlspecialchars($_GET['bet']);
    $sport = htmlspecialchars($_GET['sport']);
    $league = htmlspecialchars($_GET['league']);
    $nb = htmlspecialchars($_GET['delete']);
    array_splice($_SESSION['bet'], $nb, 1);
    header('Location: ../pages/pari.php?sport=' . $sport . '&matchid=' . $matchid . '&league=' . $league);
}
