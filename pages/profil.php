<title>Profil - BetGame</title>

<div class="flex">
    <div class="sidebar">
        <aside>
            <h2 class="sport-title">Profil</h2>
            <div class="barre"></div>
            <div class="sidebar-links-container">
                <a href="index.php?page=profil&section=informations" class="sidebar-links">Informations</a>
                <a href="index.php?page=profil&section=historique" class="sidebar-links">Historique des paris</a>
            </div>
        </aside>
    </div>

    <main class="main">
        <div class="container">

            <?php
            if (isset($_GET['section'])) {
                $page = htmlspecialchars($_GET['section']);
                require('controllers/rank.php');

                switch ($page) {
                    case 'informations':
                        $pseudo = $_SESSION['user'];
                        $email = $_SESSION['email'];
                        $points = $_SESSION['points'];
                        $rank = setRank($points);
            ?>
                        <h1 class="profil-title">Informations</h1>

                        <div class="profil-informations">
                            <p><strong>Pseudo</strong> : <?= $pseudo ?></p>
                            <p><strong>Email</strong> : <?= $email ?></p>
                            <p><strong>BetCoin(s)</strong> : <?= $points ?></p>
                            <p><strong>Rank</strong> : <?= $rank ?> </p>
                        </div>

                        <div class="profil-buttons flex">
                            <a href="index.php?page=profil&modify=email">Modifier l'adresse e-mail</a>
                            <a href="index.php?page=profil&modify=password">Modifier le mot de passe</a>
                        </div>
                    <?php
                        break;

                    case 'historique':

                    ?>
                        <h2 class="profil-title">Historique des paris</h2>

                        <!--<div class="betline">
                            <div class="betline-head flex">
                                <p class="betline-title">Bet n° X</p>
                                <p class="betline-status"><strong>Status</strong> : Gagné ✅</p>
                            </div>
                            <div class="betline-body">
                                <div class="flex" style="justify-content: space-between;">
                                    <p>Nombre de match pariés : X</p>
                                    <p>Cote totale : X</p>
                                </div>
                                <br>
                                <div class="flex" style="justify-content: space-between;">
                                    <p>Mise : X</p>
                                    <button class="betline-button" onclick="showBetDetails(1)">En savoir plus</button>
                                </div>
                            </div>
                            <div class="betline-details" id="1">
                                <p class="betline-details-title"><strong>Détails du bet :</strong></p>
                                <br>
                                <div class="gameline flex">
                                    <p>Equipe 1 - Equipe 2</p>
                                    <p>1/N/2</p>
                                </div>
                            </div>
                        </div>-->
                    <?php

                        $conn = connect();

                        $queryAllBets = 'SELECT * FROM bets WHERE accountid =' . $_SESSION['id'];

                        $resultAllBets = $conn->query($queryAllBets);
                        $dataBets = $resultAllBets->fetch_all(MYSQLI_ASSOC);

                        if ($resultAllBets->num_rows <= 0) {
                            echo "<p>Vous n'avez pas encore effectué de paris.</p>";
                        } else {
                            for ($i = 0; $i < count($dataBets); $i++) {
                                $dataBetsID = $dataBets[$i]['id'];
                                $queryNumMatches = "SELECT * FROM bets_details WHERE betid =" . $dataBetsID;
                                $resultNumMatches = $conn->query($queryNumMatches);
                                $numMatches = $resultNumMatches->num_rows;

                                if ($dataBets[$i]['status'] == '') {
                                    echo '<div class="betline">
                                    <div class="betline-head flex">
                                        <p class="betline-title">Bet n° ' . $dataBets[$i]['id'] . '</p>
                                        <p class="betline-status"><strong>Status</strong> : 🕒 En attente</p>
                                    </div>
                                    <div class="betline-body">
                                        <div class="flex" style="justify-content: space-between;">
                                            <p>Nombre de match pariés : ' . $numMatches . '</p>
                                            <p>Cote totale : ' . ($dataBets[$i]['cote'] / 100) . '</p>
                                        </div>
                                        <br>
                                        <div class="flex" style="justify-content: space-between;">
                                            <p>Mise : ' . $dataBets[$i]['mise'] . '</p>
                                            <button class="betline-button" onclick="showBetDetails(' . $i . ')">+ de détails</button>
                                        </div>
                                    </div>
                                    <div class="betline-details" id="' . $i . '">
                                <p class="betline-details-title"><strong>Détails du bet :</strong></p>
                                <br>';
                                    getMatches($dataBets[$i]['id']);
                                    echo '</div>
                                </div>';
                                } elseif ($dataBets[$i]['status'] == '1') {
                                    echo '<div class="betline">
                                    <div class="betline-head flex">
                                        <p class="betline-title">Bet n° ' . $dataBets[$i]['id'] . '</p>
                                        <p class="betline-status"><strong>Status</strong> : ✅ Gagné</p>
                                    </div>
                                    <div class="betline-body">
                                        <div class="flex" style="justify-content: space-between;">
                                            <p>Nombre de match pariés : ' . $numMatches . '</p>
                                            <p>Cote totale : ' . ($dataBets[$i]['cote'] / 100) . '</p>
                                        </div>
                                        <br>
                                        <div class="flex" style="justify-content: space-between;">
                                            <p>Mise : ' . $dataBets[$i]['mise'] . '</p>
                                            <button class="betline-button" onclick="showBetDetails(' . $i . ')">+ de détails</button>
                                        </div>
                                    </div>
                                    <div class="betline-details" id="' . $i  . '">
                                <p class="betline-details-title"><strong>Détails du bet :</strong></p>
                                <br>';
                                    getMatches($dataBets[$i]['id']);
                                    echo '</div>
                                </div>';
                                } elseif ($dataBets[$i]['status'] == '0') {
                                    echo '<div class="betline">
                                    <div class="betline-head flex">
                                        <p class="betline-title">Bet n° ' . $dataBets[$i]['id'] . '</p>
                                        <p class="betline-status"><strong>Status</strong> : ❌ Perdu</p>
                                    </div>
                                    <div class="betline-body">
                                        <div class="flex" style="justify-content: space-between;">
                                            <p>Nombre de match pariés : ' . $numMatches . '</p>
                                            <p>Cote totale : ' . ($dataBets[$i]['cote'] / 100) . '</p>
                                        </div>
                                        <br>
                                        <div class="flex" style="justify-content: space-between;">
                                            <p>Mise : ' . $dataBets[$i]['mise'] . '</p>
                                            <button class="betline-button" onclick="showBetDetails(' . $i . ')">+ de détails</button>
                                        </div>
                                    </div>
                                    <div class="betline-details" id="' . $i  . '">
                                <p class="betline-details-title"><strong>Détails du bet :</strong></p>
                                <br>';
                                    getMatches($dataBets[$i]['id']);
                                    echo '</div>
                                </div>';
                                }
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
                    <h1 class="profil-title">Modifier l'e-mail</h1>

                    <div class="profil-informations">
                        <p><strong>E-mail actuelle</strong> : <?= $email ?></p>

                        <form action="controllers/modifyprofil.php" method="POST" class="modify">
                            <input type="text" name="email" class="edit-input" placeholder="Nouvel e-mail" required>
                            <input type="text" name="emailretype" id="edit-input" placeholder="Re-taper le nouvel e-mail" required>
                            <div class="profil-buttons flex">
                                <button type="submit">Modifier</button>
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
                    <h1 class="profil-title">Modifier le mot de passe</h1>

                    <div class="profil-informations">
                        <form action="controllers/modifyprofil.php" method="POST" class="modify">
                            <label for="oldpassword">Ancien mot de passe</label>
                            <input type="password" name="oldpassword" required>
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" name="password">
                            <label for="passwordretype">Re-taper le nouveau mot de passe</label>
                            <input type="password" name="passwordretype" required>
                            <div class="profil-buttons flex">
                                <button type="submit">Modifier</button>
                            </div>
                        </form>
                    </div>
            <?php
                } else {
                    header("Location: index.php?page=profil&section=informations&error=inputnotfound");
                }
            } else {
                header("Location: index.php?page=profil&section=informations");
            };

            ?>
        </div>
    </main>
</div>

</body>

</html>