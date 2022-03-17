<?php

function checkCoteMatch(int $matchid, mysqli $conn, string $sport, string $league): bool
{
    $querycheck = "SELECT * FROM cotes WHERE matchid =" . $matchid . " AND sport ='" . $sport . "' AND league='" . $league . "'";
    $resultquerycheck = $conn->query($querycheck);

    if ($resultquerycheck->num_rows == 0) {
        return false;
    } else return true;
}

function setCoteMatch(mysqli $conn, int $matchid, string $sport, string $league): bool
{
    $querysetcote = "INSERT INTO cotes(id, matchid, home, away, draw, sport, league) VALUES ('', " . $matchid . ", 2, 2, 2, '" . $sport . "', '" . $league . "')";
    if ($conn->query($querysetcote) == true) {
        return true;
    } else return false;
}

function getCoteMatch(mysqli $conn, int $matchid, string $bet, string $sport, string $league): int
{
    if (checkCoteMatch($matchid, $conn, $sport, $league) == false) {
        return 2;
    } else {
        if ($bet == 1) {
            $querygetcote = "SELECT home FROM cotes WHERE matchid =" . $matchid . " AND sport ='" . $sport . "' AND league='" . $league . "'";
            $resultgetcote = $conn->query($querygetcote);
            $arraygetcote = $resultgetcote->fetch_all(MYSQLI_ASSOC);

            $cote = $arraygetcote[0]['home'];

            return $cote;
        } else if ($bet == 2) {
            $querygetcote = "SELECT away FROM cotes WHERE matchid =" . $matchid . " AND sport =" . $sport . " AND league=" . $league;
            $resultgetcote = $conn->query($querygetcote);
            $arraygetcote = $resultgetcote->fetch_all(MYSQLI_ASSOC);
            $cote = $arraygetcote[0]['away'];

            return $cote;
        } else if ($bet == "N") {
            $querygetcote = "SELECT draw FROM cotes WHERE matchid =" . $matchid . " AND sport =" . $sport . " AND league=" . $league;
            $resultgetcote = $conn->query($querygetcote);
            $arraygetcote = $resultgetcote->fetch_all(MYSQLI_ASSOC);

            $cote = $arraygetcote[0]['draw'];

            return $cote;
        }
    }
}
