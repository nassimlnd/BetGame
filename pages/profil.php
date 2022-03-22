<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/profil.css" />
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
    <title>Profil - BetGame</title>
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
    include("../controllers/rank.php");
    include('../includes/header.php');
    ?>

    <div class="sidebar">
        <aside>
            <h4 class="sidebar-title">Profil</h4>
            <ul>
                <li><a href="profil.php?page=informations">Informations</a></li>
                <li><a href="profil.php?page=historique">Historique de paris</a></li>
            </ul>
        </aside>
    </div>

    <main class="main">
        <div class="container">

            <?php
            if (isset($_GET['page'])) {
                $page = htmlspecialchars($_GET['page']);

                switch ($page) {
                    case 'informations':
                        $pseudo = $_SESSION['user'];
                        $email = $_SESSION['email'];
                        $points = $_SESSION['points'];

            ?>
                        <h1 class="title">Informations</h1>

                        <?php
                        $rank = attributerank($points);
                        ?>

                        <div class="informations">
                            <p><strong>Pseudo</strong> : <?= $pseudo ?></p>
                            <p><strong>Email</strong> : <?= $email ?></p>
                            <p><strong>BetCoin(s)</strong> : <?= $points ?></p>
                            <p><strong>Rank</strong> : <?= $rank ?> </p>
                        </div>

                        <div class="buttonsmodify">
                            <a href="profil.php?modify=email"><button>Modifier l'adresse e-mail</button></a>
                            <a href="profil.php?modify=password"><button>Modifier le mot de passe</button></a>
                        </div>
                    <?php
                        break;

                    case 'historique':
                        require_once('../config/database.php');

                        define('host', $host);
                        define('user', $user);
                        define('password', $password);
                        define('database', $database);

                        $conn = new mysqli($host, $user, $password, $database);

                        $queryallbets = 'SELECT * FROM bets WHERE accountid =' . $_SESSION['id'];

                        $resultallbets = $conn->query($queryallbets);
                        $databets = $resultallbets->fetch_all(MYSQLI_ASSOC);

                        if ($resultallbets->num_rows <= 0) {
                            echo "<p>Vous n'avez pas encore effectué de paris.</p>";
                        } else {
                            for ($i = 0; $i < count($databets); $i++) {
                                echo '<div class="linebet">
                                <div class="top left">
                                    <p class="title-bet">Bet n° ' . $databets[$i]['id'] . '</p>
                                </div>
                                <div class="top middle">
                                </div>
                                <div class="top right">
                                    <p class="status-bet"><strong>Status</strong>: 🕒 En attente</p>
                                </div>
                                <div class="bottom left">
                                    <p class="text-bet">Nombre de match pariés : X</p>
                                </div>
                                <div class="bottom middle">
                                    <p class="text-bet">Cote totale : ' . $databets[$i]['cote'] . '</p>
                                </div>
                                <div class="bottom right">
                                    <p class="text-bet">Mise : ' . $databets[$i]['mise'] . '</p>
                                </div>
                            </div>';
                            }
                        }
                }
            } else if (isset($_GET['modify'])) {
                $email = $_SESSION['email'];
                $element = htmlspecialchars($_GET['modify']);

                if ($element == "email") {
                    ?>
                    <?php
                    if (isset($_GET['error']) && isset($_GET['modify'])) {
                        $error = htmlspecialchars($_GET['error']);
                        $modify = htmlspecialchars($_GET['modify']);

                        if ($error == "success" && $modify == "email") {
                    ?>
                            <div class="successbox">
                                <p>L'adresse e-mail a bien été modifié.</p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <h1 class="title">Modifier l'e-mail</h1>

                    <div class="informations">
                        <p><strong>E-mail actuelle</strong> : <?= $email ?></p>

                        <form action="../controllers/modifyprofil.php" method="POST" class="modify">
                            <label for="email">Nouvel e-mail</label>
                            <input type="text" name="email" id="modify" required>
                            <label for="emailretype">Re-taper la nouvelle adresse e-mail</label>
                            <input type="text" name="emailretype" id="modify" required>
                            <div class="buttonsmodify">
                                <button type="submit">Envoyer</button>
                            </div>
                        </form>
                    </div>


                <?php
                } elseif ($element == "password") {
                ?>
                    <?php
                    if (isset($_GET['error']) && isset($_GET['modify'])) {
                        $error = htmlspecialchars($_GET['error']);
                        $modify = htmlspecialchars($_GET['modify']);
                        if ($error == "success" && $modify = "password") {
                    ?>
                            <div class="successbox">
                                <p>Le mot de passe a bien été modifié.</p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <h1 class="title">Modifier le mot de passe</h1>

                    <div class="informations">
                        <form action="../controllers/modifyprofil.php" method="POST" class="modify">
                            <label for="oldpassword">Ancien mot de passe</label>
                            <input type="password" name="oldpassword" required>
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" name="password">
                            <label for="passwordretype">Re-taper le nouveau mot de passe</label>
                            <input type="password" name="passwordretype" required>
                            <div class="buttonsmodify">
                                <button type="submit">Envoyer</button>
                            </div>
                        </form>
                    </div>
            <?php
                } else {
                    header("Location: profil.php?error=inputnotfound");
                }
            } else {
                header("Location: profil.php?page=informations");
            };

            ?>
        </div>
    </main>

</body>

</html>