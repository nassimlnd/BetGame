<?php

require('controllers/rank.php');

?>

<title>Classement - BetGame</title>

<div class="scoreboard">
    <div class="scoreboard-title-container">
        <div class="logo">
            <img src="images/logo.png" alt="Logo BetGame">
        </div>
        <div class="login-title">
            <h2>Classement</h2>
        </div>
    </div>

    <div class="scoreboard-buttons">
        <a href="index.php?page=classement&tri=desc" class="tri-buttons">Tri par ordre croissant</a>
        <a href="index.php?page=classement&tri=points" class="tri-buttons">Tri par points</a>
        <a href="index.php?page=classement&tri=pseudo" class="tri-buttons">Tri par pseudo</a>
    </div>

    <div class="scoreboard-lines">
        <div class="main-line">
            <div class="pos">
                <p>Position</p>
            </div>
            <div class="pseudo">
                <p>Pseudo</p>
            </div>
            <div class="score">
                <p>Score</p>
            </div>
            <div class="rank">
                <p>Rank</p>
            </div>
        </div>

        <?php

        $conn = connect();
        $rank = "";

        if (isset($_GET['tri'])) {
            $tri = $_GET['tri'];
        } else {
            $tri = 'points';
        }

        switch ($tri) {
            case 'desc':
                $rank = "SELECT pseudo, points FROM accounts ORDER BY points";
                break;
            case 'points':
                $rank = "SELECT pseudo, points FROM accounts ORDER BY points DESC";
                break;
            case 'pseudo':
                $rank = "SELECT pseudo, points FROM accounts ORDER BY pseudo";
                break;
        }

        if (isset($rank)) {
            $resultrank = $conn->query($rank);
            $data = $resultrank->fetch_all(MYSQLI_ASSOC);
            for ($i = 0; $i <= 20; $i++) {
                if (isset($data[$i])) {
                    $ranknum = $data[$i]['points'];
                    $rankdesc = setRank($ranknum);
                    echo '<div class="line">
                        <div class="pos"> 
                            <p>' . $i + 1 . ' </p> 
                        </div>
                        <div class="pseudo">
                            <p> ' .  $data[$i]['pseudo'] . ' </p>
                        </div>
                        <div class="score">
                            <p>' . $data[$i]['points'] . ' BetCoins</p>
                        </div>
                        <div class="rank">
                            <p> ' . $rankdesc . ' </p>
                        </div>
                    </div>';
                } else {
                    break;
                }
            }
        }

        ?>
    </div>
</div>
</body>

</html>