<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/report.css" />
    <title>Report</title>
</head>
<body>
    <?php
    include("../includes/header.php");
    ?>
    <div class ="container">
        <h2 id="h2-form">Vous avez rencontré un problème? Dites le nous!</h2>

        <form action="admin.php" method="POST">
        <textarea name="report-bugs" cols="80" rows="10" minlength="10" maxlength="500" required></textarea>

            <div class ="submit-button">
                <input type="submit" value = "Cliquez pour envoyer votre rapport">
            </div>
            
        </form>

    </div> 
    


</body>
</html>