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
    include("../includes/header.php");
    require_once("../config/database.php");
    ?>
   
<div class="container">
     <h1 class="container-title"> Classement </h1>
    <?php

    define('database', $database);
    define('host', $host);
    define('user', $user);
    define('password', $password);

    $conn = new mysqli($host, $user, $password, $database);

    $rank = 'SELECT pseudo, points FROM accounts ORDER BY points DESC ';
    $resultrank = $conn->query($rank);
    $data = $resultrank->fetch_all(MYSQLI_ASSOC);

    //echo var_dump($data);

    for($i =0; $i<=20; $i++){
        if(isset($data[$i])){
            echo '<div class="line"> 
            <div class="right">
            <p> score :' . $data[$i]['points'] .' </p>
            </div>
            
            <div class="left"> 
            <p>' . $i+1 ." ".  $data[$i]['pseudo'] . ' </p> 
            </div>


        </div>';
        } else {
            break;
        }
        
    }
    
    ?>  
   

</div>

       
</body>

</html>