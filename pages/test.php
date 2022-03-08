<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Test</title>
</head>

<body>

    <?php include("../html/header.php"); ?>

    <div class="container">
        <p>
            <?php
            if (isset($_POST['email']) && isset($_POST['password'])) {
                echo "Connexion effectuée ✅ <br>" . $_POST['email'] . $_POST['password'];
            } else {
            }
            ?>



        </p>
    </div>

</body>

</html>