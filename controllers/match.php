<?php

function checkCoteMatch(int $matchid, string $sport, string $league): bool
{
    $conn = connect();

    $querycheck = "SELECT * FROM cotes WHERE matchid =" . $matchid . " AND sport ='" . $sport . "' AND league='" . $league . "'";
    $resultquerycheck = $conn->query($querycheck);

    if ($resultquerycheck->num_rows == 0) {
        return false;
    } else return true;
}

function setBaseCoteMatch(int $matchid, string $sport, string $league): bool
{
    $conn = connect();

    if (!checkCoteMatch($matchid, $sport, $league)) {
        $querysetcote = "INSERT INTO cotes(id, matchid, home, away, draw, sport, league) VALUES ('', " . $matchid . ", 200, 200, 200, '" . $sport . "', '" . $league . "')";
        if ($conn->query($querysetcote) == true) {
            return true;
        } else return false;
    }
}

function getCoteMatch(int $matchid, string $bet, string $sport, string $league): int
{
    require_once @dirname(__DIR__) . '/config/DatabaseConfiguration.php';

    $conn = connect();

    if (checkCoteMatch($matchid, $sport, $league) == false) {
        return 200;
    } else {
        if ($bet == 1) {
            $querygetcote = "SELECT home FROM cotes WHERE matchid =" . $matchid . " AND sport ='" . $sport . "' AND league='" . $league . "'";
            $resultgetcote = $conn->query($querygetcote);
            $arraygetcote = $resultgetcote->fetch_all(MYSQLI_ASSOC);

            $cote = $arraygetcote[0]['home'];

            return $cote;
        } else if ($bet == 2) {
            $querygetcote = "SELECT away FROM cotes WHERE matchid =" . $matchid . " AND sport ='" . $sport . "' AND league='" . $league . "'";
            $resultgetcote = $conn->query($querygetcote);
            $arraygetcote = $resultgetcote->fetch_all(MYSQLI_ASSOC);
            $cote = $arraygetcote[0]['away'];

            return $cote;
        } else if ($bet == "N") {
            $querygetcote = "SELECT draw FROM cotes WHERE matchid =" . $matchid . " AND sport ='" . $sport . "' AND league='" . $league . "'";
            $resultgetcote = $conn->query($querygetcote);
            $arraygetcote = $resultgetcote->fetch_all(MYSQLI_ASSOC);

            $cote = $arraygetcote[0]['draw'];

            return $cote;
        }
    }
}

function setCoteMatch(mysqli $conn, int $matchid, string $sport, string $league, string $bet): void
{

    if ($bet == '1') {
        $cotehome = getCoteMatch($matchid, '1', $sport, $league) - 5;
        $coteaway = getCoteMatch($matchid, '2', $sport, $league) + 5;
        $cotedraw = getCoteMatch($matchid, 'N', $sport, $league) + 5;
        $queryupdatecote = "UPDATE cotes SET home=" . $cotehome . ", away=" . $coteaway . ", draw=" . $cotedraw . " WHERE matchid=" . $matchid . " AND sport='" . $sport . "' AND league='" . $league . "'";

        echo $queryupdatecote;

        if ($conn->query($queryupdatecote)) {
            echo 'ok';
        }
    } elseif ($bet == '2') {
        $cotehome = getCoteMatch($matchid, '1', $sport, $league) + 5;
        $coteaway = getCoteMatch($matchid, '2', $sport, $league) - 5;
        $cotedraw = getCoteMatch($matchid, 'N', $sport, $league) + 5;
        $queryupdatecote = "UPDATE cotes SET home=" . $cotehome . ", away=" . $coteaway . ", draw=" . $cotedraw . " WHERE matchid=" . $matchid . " AND sport='" . $sport . "' AND league='" . $league . "'";

        $conn->query($queryupdatecote);
    } elseif ($bet == 'N') {
        $cotehome = getCoteMatch($matchid, '1', $sport, $league) + 5;
        $coteaway = getCoteMatch($matchid, '2', $sport, $league) + 5;
        $cotedraw = getCoteMatch($matchid, 'N', $sport, $league) - 5;
        $queryupdatecote = "UPDATE cotes SET home=" . $cotehome . ", away=" . $coteaway . ", draw=" . $cotedraw . " WHERE matchid=" . $matchid . " AND sport='" . $sport . "' AND league='" . $league . "'";

        $conn->query($queryupdatecote);
    }
}
