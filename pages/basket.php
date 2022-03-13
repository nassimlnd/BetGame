<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/sportOverview.css" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Canonical -->
    <link rel="canonical" href="https://www.example.com">
    <!-- Robots -->
    <meta name="robots" content="noindex, nofollow">
    <!-- Device -->
    <!-- <meta name="viwport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5">
    <meta name="format-detection" content="telephone=no">
    <!-- Title -->
    <title>Basket-ball - BetGame</title>
    <!-- Description -->
    <meta name="description" content="Home description.">
    <!-- Social -->
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Quick Parcel Project — Home">
    <meta name="twitter:description" content="Home description.">
    <meta name="twitter:image" content="#">
    <!-- Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.example.com">
    <meta property="og:title" content="Quick Parcel Project — Home">
    <meta property="og:description" content="Home description.">
    <meta property="og:image" content="#">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <!-- Favicon -->
    <meta name="theme-color" content="#fff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fanwood+Text:ital@0;1&family=Tenor+Sans&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include("../includes/header.php");
    ?>


    <div class="sidebar">
        <aside>
            <h4 class="sidebar-title">Ligues</h4>
            <ul>
                <li><a href="basket.php?league=nba">NBA</a></li>
                <li><a href="basket.php?league=proa">Pro A</a></li>
                <li><a href="basket.php?league=gleague">G League</a></li>
                <li><a href="basket.php?league=euroleague">Euroleague</a></li>
            </ul>
        </aside>
    </div>


    <main class="main">

        <?php

        if (isset($_GET['league'])) {
            $ligue = htmlspecialchars($_GET['league']);

            switch ($ligue) {
                case 'nba':
                    $someArray = file_get_contents("../json/nba.json");

                    $someArray = json_decode($someArray, true);
                    $cb = 1;

                    for ($i = 0; $i < count($someArray['response']); $i++) {
                        if ($someArray['response'][$i]['status']['long'] == "Not Started") {
                            $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                            $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                            $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                            $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                            echo '<div class="container">';
                            echo '<table id="tableM">';
                            echo '<tr>';
                            echo '<thead>';
                            echo '<th colspan="3" class="matchtitle">Match du jour</th>';
                            echo '</thead>';
                            echo '</tr>';
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamhome . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamhome . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';
                            echo '<td id="scoresOverview">';
                            echo '<div id="score1">000 </div> <br>';
                            echo '<div id="score">SCORE</div> <br>';
                            echo '<div id="score2">000 </div> <br>';
                            echo '</td>';

                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamaway . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamaway . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';

                            echo '</tr>';
                            echo '</tbody>';
                            echo '<tfoot>';
                            echo '<tr>';
                            echo '<td id="foot" colspan="3"><a id="pari" href="../pages/pari.php?matchid=' . $someArray['response'][$i]['id'] . '&sport=basket&league=nba">Parier</a></td>';
                            echo '</tr>';
                            echo '</tfoot>';
                            echo '</table>';
                            echo '</div>';
                        }
                    }
                    break;

                case 'proa':
                    $someArray = file_get_contents("../json/proa.json");

                    $someArray = json_decode($someArray, true);
                    $cb = 1;

                    for ($i = 0; $i < count($someArray['response']); $i++) {
                        if ($someArray['response'][$i]['status']['long'] == "Not Started") {
                            $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                            $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                            $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                            $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                            echo '<div class="container">';
                            echo '<table id="tableM">';
                            echo '<tr>';
                            echo '<thead>';
                            echo '<th colspan="3" class="matchtitle">Match du jour</th>';
                            echo '</thead>';
                            echo '</tr>';
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamhome . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamhome . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';
                            echo '<td id="scoresOverview">';
                            echo '<div id="score1">000 </div> <br>';
                            echo '<div id="score">SCORE</div> <br>';
                            echo '<div id="score2">000 </div> <br>';
                            echo '</td>';

                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamaway . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamaway . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';

                            echo '</tr>';
                            echo '</tbody>';
                            echo '<tfoot>';
                            echo '<tr>';
                            echo '<td id="foot" colspan="3"><a id="pari" href="../pages/pari.php?matchid=' . $someArray['response'][$i]['id'] . '&sport=basket&league=proa">Parier</a></td>';
                            echo '</tr>';
                            echo '</tfoot>';
                            echo '</table>';
                            echo '</div>';
                        }
                    }
                    break;

                case 'gleague':
                    $someArray = file_get_contents("../json/gleague.json");

                    $someArray = json_decode($someArray, true);
                    $cb = 1;

                    for ($i = 0; $i < count($someArray['response']); $i++) {
                        if ($someArray['response'][$i]['status']['long'] == "Not Started") {
                            $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                            $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                            $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                            $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                            echo '<div class="container">';
                            echo '<table id="tableM">';
                            echo '<tr>';
                            echo '<thead>';
                            echo '<th colspan="3" class="matchtitle">Match du jour</th>';
                            echo '</thead>';
                            echo '</tr>';
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamhome . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamhome . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';
                            echo '<td id="scoresOverview">';
                            echo '<div id="score1">000 </div> <br>';
                            echo '<div id="score">SCORE</div> <br>';
                            echo '<div id="score2">000 </div> <br>';
                            echo '</td>';

                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamaway . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamaway . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';

                            echo '</tr>';
                            echo '</tbody>';
                            echo '<tfoot>';
                            echo '<tr>';
                            echo '<td id="foot" colspan="3"><a id="pari" href="../pages/pari.php?matchid=' . $someArray['response'][$i]['id'] . '&sport=basket&league=gleague">Parier</a></td>';
                            echo '</tr>';
                            echo '</tfoot>';
                            echo '</table>';
                            echo '</div>';
                        }
                    }
                    break;

                case 'euroleague':
                    $someArray = file_get_contents("../json/euroleague.json");

                    $someArray = json_decode($someArray, true);
                    $cb = 1;

                    for ($i = 0; $i < count($someArray['response']); $i++) {
                        if ($someArray['response'][$i]['status']['long'] == "Not Started") {
                            $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                            $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                            $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                            $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                            echo '<div class="container">';
                            echo '<table id="tableM">';
                            echo '<tr>';
                            echo '<thead>';
                            echo '<th colspan="3" class="matchtitle">Match du jour</th>';
                            echo '</thead>';
                            echo '</tr>';
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamhome . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamhome . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';
                            echo '<td id="scoresOverview">';
                            echo '<div id="score1">000 </div> <br>';
                            echo '<div id="score">SCORE</div> <br>';
                            echo '<div id="score2">000 </div> <br>';
                            echo '</td>';

                            echo '<td id="tableImg">';
                            echo '<figure class="teammate">';
                            echo '<img src="' . $logoteamaway . '" alt="pdp" id="pdp">';
                            echo '<figcaption>' . $nameteamaway . '</figcaption>';
                            echo '</figure>';
                            echo '</td>';

                            echo '</tr>';
                            echo '</tbody>';
                            echo '<tfoot>';
                            echo '<tr>';
                            echo '<td id="foot" colspan="3"><a id="pari" href="../pages/pari.php?matchid=' . $someArray['response'][$i]['id'] . '&sport=basket&league=euroleagie">Parier</a></td>';
                            echo '</tr>';
                            echo '</tfoot>';
                            echo '</table>';
                            echo '</div>';
                        }
                    }
                    break;
            }
        } else {
        ?>
            <div class="container">
                <table id="tableM">
                    <tr>
                        <thead>
                            <th colspan="3" class="matchtitle">Match du jour</th>
                        </thead>
                    </tr>
                    <tbody>
                        <tr>
                            <td id="tableImg">
                                <figure class="teammate">
                                    <img src="../images/pdpqui.png" alt="pdp" id="pdp">
                                    <figcaption>nom de l'équipe</figcaption>
                                </figure>
                            </td>
                            <td id="scoresOverview">
                                <div id="score1">000 </div> <br>
                                <div id="score">SCORE</div> <br>
                                <div id="score2">000 </div> <br>
                            </td>

                            <td id="tableImg">
                                <figure class="teammate">
                                    <img src="../images/pdpqui.png" alt="pdp" id="pdp">
                                    <figcaption>nom de l'équipe</figcaption>
                                </figure>
                            </td>

                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td id="foot" colspan="3"> <a id="pari" href="../pages/pari.php">Parier</a> </td>
                        </tr>
                    </tfoot>


                </table>

                <table id="tableM">
                    <tr>
                        <thead>
                            <th colspan="3" class="matchtitle">Match du jour</th>
                        </thead>
                    </tr>

                    <tbody>
                        <tr>
                            <td id="tableImg">
                                <figure class="teammate">
                                    <img src="../images/pdpqui.png" alt="pdp" id="pdp">
                                    <figcaption>nom de l'équipe</figcaption>
                                </figure>

                            </td>
                            <td id="scoresOverview">
                                <div id="score1">000 </div> <br>
                                <div id="score">SCORE</div> <br>
                                <div id="score2">000 </div> <br>

                            </td>

                            <td id="tableImg">
                                <figure class="teammate">
                                    <img src="../images/pdpqui.png" alt="pdp" id="pdp">
                                    <figcaption>nom de l'équipe</figcaption>
                                </figure>
                            </td>

                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td id="foot" colspan="3"> <a id="pari" href="../pages/pari.php">Parier</a> </td>
                        </tr>
                    </tfoot>


                </table>

                <table id="tableM">
                    <tr>
                        <thead>
                            <th colspan="3" class="matchtitle">Match du jour</th>
                        </thead>
                    </tr>




                    <tbody>
                        <tr>
                            <td id="tableImg">
                                <figure class="teammate">
                                    <img src="../images/pdpqui.png" alt="pdp" id="pdp">
                                    <figcaption>nom de l'équipe</figcaption>
                                </figure>

                            </td>
                            <td id="scoresOverview">
                                <div id="score1">000 </div> <br>
                                <div id="score">SCORE</div> <br>
                                <div id="score2">000 </div> <br>

                            </td>

                            <td id="tableImg">
                                <figure class="teammate">
                                    <img src="../images/pdpqui.png" alt="pdp" id="pdp">
                                    <figcaption>nom de l'équipe</figcaption>
                                </figure>
                            </td>

                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td id="foot" colspan="3"> <a id="pari" href="../pages/pari.php">Parier</a> </td>
                        </tr>
                    </tfoot>


                </table>
            </div>
    </main>
<?php
        }

?>









</body>

</html>