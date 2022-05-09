<?php
if (!isset($_SESSION['user'])) {
?>
    <script type="text/javascript">
        window.location.href = 'index.php?page=home';
    </script>
<?php
}

if ($_GET['sport'] == 'basket') {
?>
    <title>Basket-ball - BetGame</title>

    <div class="flex">
        <div class="sidebar">
            <aside>
                <h2 class="sport-title">Ligues</h2>
                <div class="barre"></div>
                <div class="sidebar-links-container">
                    <a href="index.php?page=sports&sport=basket&league=nba" class="sidebar-links">NBA</a>
                    <a href="index.php?page=sports&sport=basket&league=proa" class="sidebar-links">Pro A</a>
                    <a href="index.php?page=sports&sport=basket&league=gleague" class="sidebar-links">G League</a>
                    <a href="index.php?page=sports&sport=basket&league=euroleague" class="sidebar-links">Euroleague</a>
                </div>
            </aside>
        </div>
        <main class="main">
            <?php

            if (!isset($_GET['league'])) {
                $_GET['league'] = 'nba';
            }

            if (isset($_GET['league'])) {
                $league = htmlspecialchars($_GET['league']);
                $sport = 'basket';

                $fileName = dirname(__DIR__) . '/data/json/' . $sport . '/' . $league . '.json';
                $basketJson = file_get_contents($fileName);

                $basketJson = json_decode($basketJson, true);

                for ($i = 0; $i < count($basketJson['response']); $i++) {
                    if ($basketJson['response'][$i]['status']['long'] == "Not Started") {
                        $matchID = $basketJson['response'][$i]['id'];
                        $nameTeamHome = $basketJson['response'][$i]['teams']['home']['name'];
                        $nameTeamAway = $basketJson['response'][$i]['teams']['away']['name'];
                        $logoTeamHome = $basketJson['response'][$i]['teams']['home']['logo'];
                        $logoTeamAway = $basketJson['response'][$i]['teams']['away']['logo'];

                        if (checkCoteMatch($matchID, $sport, $league) == false) {
                            setBaseCoteMatch($matchID, $sport, $league);
                        }

                        $coteHome = getCoteMatch($matchID, '1', $sport, $league) / 100;
                        $coteAway = getCoteMatch($matchID, '2', $sport, $league) / 100;

                        echo '
                        <div class="container">
                        <div class="match-title">
                            <span>Match n° ' . $matchID . '</span>
                            </div>
                            <div class="flex match-teams">
                            <div class="match-teamhome">
                                <div class="match-teamhome-logo">
                                    <img src="' . $logoTeamHome . '" alt="Logo de l\'équipe locale" width="200px" height="200px">
                                </div>
                                <h2 class="match-teamname">' . $nameTeamHome . '</h2>
                                <div class="match-odds-home">
                                    <a href="controllers/bet.php?sport=' . $sport . '&bet=1&matchid=' . $matchID . '&league=' . $league . '" class="odds-links">' . $coteHome . '</a>
                                </div>
                            </div>
                            <div class="match-center">
                                <span>Heure</span><br>
                                <span>Date</span>
                            </div>
                            <div class="match-teamaway">
                                <div class="match-teamaway-logo">
                                    <img src="' . $logoTeamAway . '" alt="Logo de l\'équipe visiteuse" width="200px" height="200px">
                                </div>
                                <h2 class="match-teamname">' . $nameTeamAway . '</h2>
                                <div class="match-odds-away">
                                    <a href="controllers/bet.php?sport=' . $sport . '&bet=2&matchid=' . $matchID . '&league=' . $league . '" class="odds-links">' . $coteAway . '</a>
                                </div>
                            </div>
                        </div>
                        </div>';
                    }
                }
            }
            ?>
        </main>

        <?php
        if (isset($_SESSION['bet'][0])) {
            if (isset($_GET['bet']) || !empty($_SESSION['bet'])) {
        ?>
                <div class="betip">
                    <div class="betip-title flex">
                        <h2>En cours :</h2>
                        <div class="downbutton">
                            <button></button>
                        </div>
                    </div>
                    <?php
                    for ($i = 0; $i < count($_SESSION['bet']); $i++) {
                        if ($_SESSION['bet'][$i] != null && isset($_SESSION['bet'][$i])) {
                            $matchIDSession = $_SESSION['bet'][$i]['matchid'];
                            $leagueSession = $_SESSION['bet'][$i]['league'];
                            $sportSession = $_SESSION['bet'][$i]['sport'];

                            $fileNameBet = @dirname(__DIR__) . '/data/json/' . $sportSession . '/' . $leagueSession . '.json';
                            str_replace(" ", "", $fileNameBet);

                            $matchesBet = file_get_contents($fileNameBet);
                            $matchesBet = json_decode($matchesBet, true);

                            if ($sportSession == 'foot') {
                                for ($j = 0; $j < count($matchesBet['response']); $j++) {
                                    if ($matchIDSession == $matchesBet['response'][$j]['fixture']['id']) {
                                        $nameHomeSession = $matchesBet['response'][$j]['teams']['home']['name'];
                                        $nameAwaySession = $matchesBet['response'][$j]['teams']['away']['name'];

                                        $logoHomeSession = $matchesBet['response'][$j]['teams']['home']['logo'];
                                        $logoAwaySession = $matchesBet['response'][$j]['teams']['away']['logo'];

                                        $coteSession = getCoteMatch($matchID, $_SESSION['bet'][$i]['bet'], $sportSession, $leagueSession) / 100;
                                        break;
                                    }
                                }
                            } elseif ($sportSession == 'basket') {
                                for ($j = 0; $j < count($matchesBet['response']); $j++) {
                                    if ($matchIDSession == $matchesBet['response'][$j]['id']) {
                                        $nameHomeSession = $matchesBet['response'][$j]['teams']['home']['name'];
                                        $nameAwaySession = $matchesBet['response'][$j]['teams']['away']['name'];

                                        $logoHomeSession = $matchesBet['response'][$j]['teams']['home']['logo'];
                                        $logoAwaySession = $matchesBet['response'][$j]['teams']['away']['logo'];

                                        $coteSession = getCoteMatch($matchID, $_SESSION['bet'][$i]['bet'], $sportSession, $leagueSession) / 100;
                                        break;
                                    }
                                }
                            }

                            echo '
                            <div class="flex bet">
                            <p>' . $nameHomeSession . ' - ' . $nameAwaySession . '</p>
                            <p>' . $coteSession . '</p>
                            <a href="controllers/bet.php?sport=' . $sportSession . '&matchid=' . $matchIDSession . '&league=' . $leagueSession . '&delete=' . $i . '">❌</a>
                            </div>';
                        }
                    }
                    ?>
                    <div class="form">
                        <form action="controllers/bet.php" method="POST" class="flex">
                            <input type="text" name="mise" placeholder="Mise" class="betip-mise">
                            <button type="submit" class="betip-button">Bet</button>
                        </form>
                    </div>
                </div>
        <?php
            }
        } ?>
    </div>
<?php
} elseif ($_GET['sport'] == 'foot') {
?>
    <title>Football - BetGame</title>

    <div class="flex">
        <div class="sidebar">
            <aside>
                <h2 class="sport-title">Ligues</h2>
                <div class="barre"></div>
                <div class="sidebar-links-container">
                    <a href="index.php?page=sports&sport=foot&league=ligue1" class="sidebar-links">Ligue 1</a>
                    <a href="index.php?page=sports&sport=foot&league=liga" class="sidebar-links">Liga</a>
                    <a href="index.php?page=sports&sport=foot&league=pl" class="sidebar-links">Premier League</a>
                    <a href="index.php?page=sports&sport=foot&league=seriea" class="sidebar-links">Serie A</a>
                </div>
            </aside>
        </div>
        <main class="main">
            <?php

            if (!isset($_GET['league'])) {
                $_GET['league'] = 'ligue1';
            }

            if (isset($_GET['league'])) {
                $league = htmlspecialchars($_GET['league']);
                $sport = 'foot';

                $fileName = dirname(__DIR__) . '/data/json/' . $sport . '/' . $league . '.json';
                $footJson = file_get_contents($fileName);

                $footJson = json_decode($footJson, true);

                for ($i = 0; $i < count($footJson['response']); $i++) {
                    if ($footJson['response'][$i]['fixture']['status']['long'] == "Not Started") {
                        $matchID = $footJson['response'][$i]['fixture']['id'];
                        $nameTeamHome = $footJson['response'][$i]['teams']['home']['name'];
                        $nameTeamAway = $footJson['response'][$i]['teams']['away']['name'];
                        $logoTeamHome = $footJson['response'][$i]['teams']['home']['logo'];
                        $logoTeamAway = $footJson['response'][$i]['teams']['away']['logo'];

                        $coteHome = getCoteMatch($matchID, '1', $sport, $league) / 100;
                        $coteDraw = getCoteMatch($matchID, 'N', $sport, $league) / 100;
                        $coteAway = getCoteMatch($matchID, '2', $sport, $league) / 100;

                        echo '<div class="container">
                            <div class="match-title">
                                <span>Match n° ' . $matchID . '</span>
                                </div>
                                <div class="flex match-teams">
                                <div class="match-teamhome">
                                    <div class="match-teamhome-logo">
                                        <img src="' . $logoTeamHome . '" alt="Logo de l\'équipe locale" width="200px" height="200px">
                                    </div>
                                    <h2 class="match-teamname">' . $nameTeamHome . '</h2>
                                    <div class="match-odds-home">
                                    <a href="controllers/bet.php?sport=' . $sport . '&bet=1&matchid=' . $matchID . '&league=' . $league . '" class="odds-links">' . $coteHome . '</a>
                                    </div>
                                </div>
                                <div class="match-center">
                                    <span>Heure</span><br>
                                    <span>Date</span>
                                </div>
                                <div class="match-teamaway">
                                    <div class="match-teamaway-logo">
                                        <img src="' . $logoTeamAway . '" alt="Logo de l\'équipe visiteuse" width="200px" height="200px">
                                    </div>
                                    <h2 class="match-teamname">' . $nameTeamAway . '</h2>
                                    <div class="match-odds-away">
                                    <a href="controllers/bet.php?sport=' . $sport . '&bet=2&matchid=' . $matchID . '&league=' . $league . '" class="odds-links">' . $coteAway . '</a>
                                    </div>
                                </div>
                            </div>
                            </div>';
                    }
                }
            }
            ?>
        </main>
        <?php
        if (isset($_SESSION['bet'][0])) {
            if (isset($_GET['bet']) || !empty($_SESSION['bet'])) {
        ?>
                <div class="betip">
                    <div class="betip-title flex">
                        <h2>En cours :</h2>
                        <div class="downbutton">
                            <button></button>
                        </div>
                    </div>
                    <?php
                    for ($i = 0; $i < count($_SESSION['bet']); $i++) {
                        if ($_SESSION['bet'][$i] != null && isset($_SESSION['bet'][$i])) {
                            $matchIDSession = $_SESSION['bet'][$i]['matchid'];
                            $leagueSession = $_SESSION['bet'][$i]['league'];
                            $sportSession = $_SESSION['bet'][$i]['sport'];

                            $fileNameBet = @dirname(__DIR__) . '/data/json/' . $sportSession . '/' . $leagueSession . '.json';
                            str_replace(" ", "", $fileNameBet);

                            $matchesBet = file_get_contents($fileNameBet);
                            $matchesBet = json_decode($matchesBet, true);

                            if ($sportSession == 'foot') {
                                for ($j = 0; $j < count($matchesBet['response']); $j++) {
                                    if ($matchIDSession == $matchesBet['response'][$j]['fixture']['id']) {
                                        $nameHomeSession = $matchesBet['response'][$j]['teams']['home']['name'];
                                        $nameAwaySession = $matchesBet['response'][$j]['teams']['away']['name'];

                                        $logoHomeSession = $matchesBet['response'][$j]['teams']['home']['logo'];
                                        $logoAwaySession = $matchesBet['response'][$j]['teams']['away']['logo'];

                                        $coteSession = getCoteMatch($matchID, $_SESSION['bet'][$i]['bet'], $sportSession, $leagueSession) / 100;
                                        break;
                                    }
                                }
                            } elseif ($sportSession == 'basket') {
                                for ($j = 0; $j < count($matchesBet['response']); $j++) {
                                    if ($matchIDSession == $matchesBet['response'][$j]['id']) {
                                        $nameHomeSession = $matchesBet['response'][$j]['teams']['home']['name'];
                                        $nameAwaySession = $matchesBet['response'][$j]['teams']['away']['name'];

                                        $logoHomeSession = $matchesBet['response'][$j]['teams']['home']['logo'];
                                        $logoAwaySession = $matchesBet['response'][$j]['teams']['away']['logo'];

                                        $coteSession = getCoteMatch($matchID, $_SESSION['bet'][$i]['bet'], $sportSession, $leagueSession) / 100;
                                        break;
                                    }
                                }
                            }


                            echo '
                            <div class="flex bet">
                            <p>' . $nameHomeSession . ' - ' . $nameAwaySession . '</p>
                            <p>' . $coteSession . '</p>
                            <a href="controllers/bet.php?sport=' . $sportSession . '&matchid=' . $matchIDSession . '&league=' . $leagueSession . '&delete=' . $i . '">❌</a>
                            </div>';
                        }
                    }

                    ?>
                    <div class="form">
                        <form action="controllers/bet.php" method="POST" class="flex">
                            <input type="text" name="mise" placeholder="Mise" class="betip-mise">
                            <button type="submit" class="betip-button">Bet</button>
                        </form>
                    </div>
                </div>
        <?php
            }
        } ?>
    </div>
<?php
}
