<!DOCTYPE html>


<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement - BetGame</title>
    <link rel="stylesheet" href="../css/scoreboard.css">
</head>

<body>

    <?php
    include("../controllers/rank.php");
    include("../includes/header.php");
    require_once("../config/database.php");
    ?>

    <div class="container">
        <h1 class="container-title"> Classement </h1>


    <form action="../pages/scoreboard.php" method="GET" >
    <select name="select" id="select">
        <option value="1"> par points desc</option>
        <option value="2"> par points</option>
        <option value="3"> par pseudo</option>
    </select>
    <button type="submit" id="Change">Envoyer</button>
    </form>
    
        <div class="main-line">
            <div class="left">
                <p>Position</p>
            </div>
            <div class="middle">
                <p>Pseudo</p>
            </div>
            <div class="right">
                <p>Score</p>
            </div>
            <div class="cross">
                <p>Rank</p>
            </div>
        </div>
        
<?php
    if (!isset($host)) {
        define('database', $database);
        define('host', $host);
        define('user', $user);
        define('password', $password);
    }

    $conn = new mysqli($host, $user, $password, $database);
    $rank = "";
    if(isset($_GET['select'])){
        $value = $_GET['select'];
    
    switch($value){
        case $value == 1:
            $rank = 'SELECT pseudo, points FROM accounts ORDER BY points DESC';
            break;
        case $value == 2:
            $rank = 'SELECT pseudo, points FROM accounts ORDER BY points';
            break;
         case $value == 3:
            $rank = 'SELECT pseudo, points FROM accounts ORDER BY pseudo';
            break;
            }
            $resultrank = $conn->query($rank);
            $data = $resultrank->fetch_all(MYSQLI_ASSOC);
            for ($i = 0; $i <= 20; $i++) {
                if (isset($data[$i])) {
                    $ranknum = $data[$i]['points'];
                    $rankdesc = attributerank($ranknum);
                    echo '<div class="line">
                        <div class="left"> 
                            <p>' . $i + 1 . ' </p> 
                        </div>
                        <div class="middle">
                            <p> ' .  $data[$i]['pseudo'] . ' </p>
                        </div>
                        <div class="right">
                            <p>' . $data[$i]['points'] . ' BetCoins</p>
                        </div>
                        <div class="cross">
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
</body>

</html>