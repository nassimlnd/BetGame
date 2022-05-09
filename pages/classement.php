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

    <!--<form action="../pages/scoreboard.php" method="GET">
        <select name="select" id="select">
            <option value="1"> par points desc</option>
            <option value="2"> par points</option>
            <option value="3"> par pseudo</option>
        </select>
        <button type="submit" id="Change">Envoyer</button>
    </form>-->

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
        $rank = 'SELECT pseudo, points FROM accounts ORDER BY points DESC';
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

        ?>
    </div>
</div>
</body>

</html>