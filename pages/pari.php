<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php?log_error=notconnected");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pari - BetGame</title>
    <link rel="stylesheet" href="../css/pari.css">
</head>

<body>

    <?php
    include("../includes/header.php");


    if (isset($_GET['sport']) && isset($_GET['matchid']) && isset($_GET['league'])) {

        $matchid = htmlspecialchars($_GET['matchid']);
        $league = htmlspecialchars($_GET['league']);
        $sport = htmlspecialchars($_GET['sport']);

        $filename = '../json/' . $league . '.json';
        str_replace(" ", "", $filename);

        $matches = file_get_contents($filename);
        $matches = json_decode($matches, true);

        $nameteamaway = '';
        $nameteamhome = '';

        $logoteamaway = '';
        $logoteamhome = '';



        for ($i = 0; $i < count($matches['response']); $i++) {
            if ($matchid == $matches['response'][$i]['id']) {
                $nameteamhome = $matches['response'][$i]['teams']['home']['name'];
                $nameteamaway = $matches['response'][$i]['teams']['away']['name'];

                $logoteamhome = $matches['response'][$i]['teams']['home']['logo'];
                $logoteamaway = $matches['response'][$i]['teams']['away']['logo'];
                break;
            }
        }

        if (isset($_SESSION['bet'][0])) {
            if (isset($_GET['bet']) || !empty($_SESSION['bet'])) {
    ?>
                <div class="sidebar">
                    <aside>
                        <h4 class="sidebar-title">Paris en cours :</h4>
                        <?php
                        if (isset($_GET['error'])) {
                            $error = htmlspecialchars($_GET['error']);
                            switch ($error) {
                                case "alreadybet":
                        ?>
                                    <div class="errorbox">
                                        <p> <strong>Vous ne pouvez pas parier 2 fois sur le même match!</strong> </p>
                                    </div>
                                <?php
                                    break;

                                case "toomanybet":
                                ?>
                                    <div class="errorbox">
                                        <p><strong>Vous ne pouvez pas faire plus de 5 paris à la fois!</strong></p>
                                    </div>
                        <?php
                                    break;
                            }
                        }

                        for ($i = 0; $i < count($_SESSION['bet']); $i++) {
                            if ($_SESSION['bet'][$i] != null && isset($_SESSION['bet'][$i])) {
                                $matchidsession = $_SESSION['bet'][$i]['matchid'];
                                for ($j = 0; $j < count($matches['response']); $j++) {
                                    if ($matchidsession == $matches['response'][$j]['id']) {
                                        $nameteamhomesession = $matches['response'][$j]['teams']['home']['name'];
                                        $nameteamawaysession = $matches['response'][$j]['teams']['away']['name'];

                                        $logoteamhomesession = $matches['response'][$j]['teams']['home']['logo'];
                                        $logoteamawaysession = $matches['response'][$j]['teams']['away']['logo'];
                                        break;
                                    }
                                }
                                echo '<div class="line">';
                                echo "<p class = 'left'>" . $nameteamawaysession . " - " . $nameteamhomesession . "</p>";
                                echo "<p class = 'right'> COTE </p>";
                                echo '<p class = "middle">' . $_SESSION['bet'][$i]['bet'] . '</p>';
                                echo '<div class="cross"><a href="../controllers/bet.php?sport=' . $sport . '&matchid=' . $matchid . '&league=' . $league . '&delete=' . $i . '">❌</a></div>';
                                echo '</div>';
                            }
                        }
                        ?>
                        <form action="../controllers/bet.php" method="POST" class="form-paris">
                            <label for="mise">Mise :</label>
                            <input type="text" name="mise" class="input-mise" required>
                            <a href="#"><button type="submit">Valider</button></a>
                        </form>
                    </aside>
                </div>
        <?php
            }
        }

        ?>

        <main class="main">
            <div class="container-principal">
                <h1>Pari :</h1>

                <div class="gauche">
                    <figure>
                        <figcaption class="titreequipe"><?= $nameteamhome ?></figcaption>
                        <img src="<?= $logoteamhome ?>" alt="gauche" class="image">
                    </figure>
                    <p class="cote">Cote : 2.00</p>
                    <a href="../controllers/bet.php?sport=<?= $sport ?>&bet=1&matchid=<?= $matchid ?>&league=<?= $league ?>"><button class="btnmise">Miser</button></a>
                </div>

                <div class="milieu">
                    <p id="vs">-</p>
                </div>

                <div class="droit">
                    <figure>
                        <figcaption class="titreequipe"><?= $nameteamaway ?></figcaption>
                        <img src="<?= $logoteamaway ?>" alt="droit" class="image">
                    </figure>
                    <p class="cote">Cote : 2.00</p>
                    <a href="../controllers/bet.php?sport=<?= $sport ?>&bet=2&matchid=<?= $matchid ?>&league=<?= $league ?>"><button class="btnmise">Miser</button></a>
                </div>
            </div>

        <?php

    }
    if (!isset($_GET['sport']) || !isset($_GET['matchid']) || !isset($_GET['league'])) {
        header('Location: ../index.php');
    };

        ?>

        <div class="container-details">
            <div class="line">
                <div class="left">
                    <p class="stats">150 kg</p>
                </div>
                <div class="middle">
                    <p class="detailsname">Poids</p>
                </div>
                <div class="right">
                    <p class="stats">100 kg</p>
                </div>
            </div>
            <div class="line">
                <div class="left">
                    <p class="stats">150 kg</p>
                </div>
                <div class="middle">
                    <p class="detailsname">Taille</p>
                </div>
                <div class="right">
                    <p class="stats">100 kg</p>
                </div>
            </div>
            <div class="line">
                <div class="left">
                    <p class="stats">150 kg</p>
                </div>
                <div class="middle">
                    <p class="detailsname">Nombre de victoires</p>
                </div>
                <div class="right">
                    <p class="stats">100 kg</p>
                </div>
            </div>
            <div class="line">
                <div class="left">
                    <p class="stats">150 kg</p>
                </div>
                <div class="middle">
                    <p class="detailsname">Origine</p>
                </div>
                <div class="right">
                    <p class="stats">100 kg</p>
                </div>
            </div>
        </div>
        </main>


        <script type="module" src="js/index.js"></script>
</body>

</html>