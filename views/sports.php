<?php

if (str_contains($_SERVER['REQUEST_URI'], '/basket')) {
?>

    <div class="sidebar">
        <aside>
            <h2 class="sport-title">Basketball</h2>
            <div class="sidebar-links-container">
                <a href="basket?league=nba" class="sidebar-links">NBA</a>
                <a href="basket?league=proa" class="sidebar-links">Pro A</a>
                <a href="basket?league=gleague" class="sidebar-links">G League</a>
                <a href="basket?league=euroleague" class="sidebar-links">Euroleague</a>
            </div>
        </aside>
    </div>


    <main class="main">
        <div class="container">

            <?php

            if (isset($_GET['league'])) {
                $league = htmlspecialchars($_GET['league']);
                $sport = 'basket';

                $filename = '../data/' . $sport . '/' . $league . '.json';
                $someArray = file_get_contents($filename);

                $someArray = json_decode($someArray, true);

                for ($i = 0; $i < count($someArray['response']); $i++) {
                    if ($someArray['response'][$i]['status']['long'] == "Not Started") {
                        $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                        $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                        $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                        $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                        //echo '<div class="container">';
                        echo '<div class="container-match">';
                        echo '<h1 class="titre-match">Match du jour</h1>';
                        echo '<div class="left">';
                        echo '<figure class="team">';
                        echo '<img src="' . $logoteamhome . '" alt="teamhome">';
                        echo '<figcaption class="">' . $nameteamhome . '</figcaption>';
                        echo '</figure>';
                        echo '</div>';
                        echo '<div class="middle">';
                        echo '<div class="text">';
                        echo '<p>Date :</p>';
                        echo '<p>' . date('d/m/Y', strtotime($someArray['response'][$i]['date'])) . '</p>';
                        echo '<p>-</p>';
                        echo '<p>Heure :</p>';
                        echo '<p>' . $someArray['response'][$i]['time'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="right">';
                        echo '<figure class="team">';
                        echo '<img src="' . $logoteamaway . '" alt="teamhome">';
                        echo '<figcaption class="">' . $nameteamaway . '</figcaption>';
                        echo '</figure>';
                        echo '</div>';
                        echo '<a class="lien" href="../views/pari.php?matchid=' . $someArray['response'][$i]['id'] . '&sport=basket&league=' . $league . '"><button id="pari">Parier</button></a>';
                        echo '</div>';
                    }
                }
            } else {
                header("Location: basket?league=nba");
            }
            ?>
        </div>
    <?php
} elseif (str_contains($_SERVER['REQUEST_URI'], '/football')) {
    ?>

        <div class="sidebar">
            <aside>
                <h4 class="sidebar-title">Ligues</h4>
                <ul>
                    <li><a href="foot.php?league=ligue1">Ligue 1</a></li>
                    <li><a href="foot.php?league=liga">Liga</a></li>
                    <li><a href="foot.php?league=pl">Premier League</a></li>
                    <li><a href="foot.php?league=seriea">Serie A</a></li>
                </ul>
            </aside>
        </div>


        <main class="main">
            <div class="container">

                <?php

                if (isset($_GET['league'])) {
                    $league = htmlspecialchars($_GET['league']);
                    $sport = 'foot';

                    $filename = '../data/' . $sport . '/' . $league . '.json';
                    $someArray = file_get_contents($filename);

                    $someArray = json_decode($someArray, true);

                    for ($i = 0; $i < count($someArray['response']); $i++) {
                        if ($someArray['response'][$i]['fixture']['status']['long'] == "Not Started") {
                            $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                            $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                            $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                            $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                            //echo '<div class="container">';
                            echo '<div class="container-match">';
                            echo '<h1 class="titre-match">Match du jour</h1>';
                            echo '<div class="left">';
                            echo '<figure class="team">';
                            echo '<img src="' . $logoteamhome . '" alt="teamhome">';
                            echo '<figcaption class="">' . $nameteamhome . '</figcaption>';
                            echo '</figure>';
                            echo '</div>';
                            echo '<div class="middle">';
                            echo '<div class="text">';
                            echo '<p>Date :</p>';
                            echo '<p>' . date('d/m/Y', strtotime($someArray['response'][$i]['fixture']['date'])) . '</p>';
                            echo '<br>';
                            echo '<p>-</p>';
                            echo '<br>';
                            echo '<p>Heure :</p>';
                            echo '<p>' . date('H:i:s', strtotime($someArray['response'][$i]['fixture']['date'])) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="right">';
                            echo '<figure class="team">';
                            echo '<img src="' . $logoteamaway . '" alt="teamhome">';
                            echo '<figcaption class="">' . $nameteamaway . '</figcaption>';
                            echo '</figure>';
                            echo '</div>';
                            echo '<a class="lien" href="../views/pari.php?matchid=' . $someArray['response'][$i]['fixture']['id'] . '&sport=' . $sport . '&league=' . $league . '"><button id="pari">Parier</button></a>';
                            echo '</div>';
                        }
                    }
                } else {
                    header("Location: football?league=ligue1");
                }
                ?>
            </div>

        <?php
    } elseif (str_contains($_SERVER['REQUEST_URI'], '/hockey')) {
        ?>
            <div class="sidebar">
                <aside>
                    <h4 class="sidebar-title">Ligues</h4>
                    <ul>
                        <li><a href="foot.php?league=ligue1">Ligue 1</a></li>
                        <li><a href="foot.php?league=liga">Liga</a></li>
                        <li><a href="foot.php?league=pl">Premier League</a></li>
                        <li><a href="foot.php?league=seriea">Serie A</a></li>
                    </ul>
                </aside>
            </div>


            <main class="main">
                <div class="container">

                    <?php

                    if (isset($_GET['league'])) {
                        $league = htmlspecialchars($_GET['league']);
                        $sport = 'foot';

                        $filename = '../json/' . $sport . '/' . $league . '.json';
                        $someArray = file_get_contents($filename);

                        $someArray = json_decode($someArray, true);

                        for ($i = 0; $i < count($someArray['response']); $i++) {
                            if ($someArray['response'][$i]['fixture']['status']['long'] == "Not Started") {
                                $nameteamhome = $someArray['response'][$i]['teams']['home']['name'];
                                $nameteamaway = $someArray['response'][$i]['teams']['away']['name'];

                                $logoteamhome = $someArray['response'][$i]['teams']['home']['logo'];
                                $logoteamaway = $someArray['response'][$i]['teams']['away']['logo'];


                                //echo '<div class="container">';
                                echo '<div class="container-match">';
                                echo '<h1 class="titre-match">Match du jour</h1>';
                                echo '<div class="left">';
                                echo '<figure class="team">';
                                echo '<img src="' . $logoteamhome . '" alt="teamhome">';
                                echo '<figcaption class="">' . $nameteamhome . '</figcaption>';
                                echo '</figure>';
                                echo '</div>';
                                echo '<div class="middle">';
                                echo '<div class="text">';
                                echo '<p>Date :</p>';
                                echo '<p>' . date('d/m/Y', strtotime($someArray['response'][$i]['fixture']['date'])) . '</p>';
                                echo '<br>';
                                echo '<p>-</p>';
                                echo '<br>';
                                echo '<p>Heure :</p>';
                                echo '<p>' . date('H:i:s', strtotime($someArray['response'][$i]['fixture']['date'])) . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="right">';
                                echo '<figure class="team">';
                                echo '<img src="' . $logoteamaway . '" alt="teamhome">';
                                echo '<figcaption class="">' . $nameteamaway . '</figcaption>';
                                echo '</figure>';
                                echo '</div>';
                                echo '<a class="lien" href="../views/pari.php?matchid=' . $someArray['response'][$i]['fixture']['id'] . '&sport=' . $sport . '&league=' . $league . '"><button id="pari">Parier</button></a>';
                                echo '</div>';
                            }
                        }
                    } else {
                        header("Location: foot.php?league=ligue1");
                    }
                    ?>
                </div>
            <?php
        }
