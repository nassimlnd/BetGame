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
    <title>Basket-ball - BetGame</title>
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
    include('../includes/header.php');
    ?>

    <div class="sidebar">
        <aside>
            <h4 class="sidebar-title">Profil</h4>
            <ul>
                <li><a href="profil.php?page=informations">Informations</a></li>
                <li><a href="basket.php?page=historique">Historique de paris</a></li>
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

            ?>
                        <h1 class="title">Informations</h1>

                        <div class="informations">
                            <p><strong>Pseudo</strong> : <?= $pseudo ?></p>
                            <p><strong>Email</strong> : <?= $email ?></p>
                        </div>

                        <div class="buttonsmodify">
                            <a href="profil.php?modify=email"><button>Modifier l'adresse e-mail</button></a>
                            <a href="#"><button>Modifier le mot de passe</button></a>
                        </div>
                    <?php
                }
            } else if (isset($_GET['modify'])) {
                $email = $_SESSION['email'];
                $element = htmlspecialchars($_GET['modify']);

                if ($element == "email") {
                    ?>
                    <?php
                    if (isset($_GET['error'])) {
                        $error = htmlspecialchars($_GET['error']);

                        if ($error == "success") {
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
                            <input type="text" name="email" id="modify">
                            <label for="emailretype">Re-taper la nouvelle adresse e-mail</label>
                            <input type="text" name="emailretype" id="modify">
                            <div class="buttonsmodify">
                                <button type="submit">Envoyer</button>
                            </div>
                        </form>
                    </div>


                <?php
                } elseif ($element == "password") {
                ?>
                    <h1 class="title">Modifier l'e-mail</h1>

                    <div class="informations">
                        <p><strong>Email</strong> : <?= $email ?></p>

                        <form action="../controllers/modifyprofil.php" method="POST">
                            <label for="email">Nouvel e-mail</label>
                            <input type="text" name="email" id="modify">
                            <label for="emailretype">Re-taper la nouvelle adresse e-mail</label>
                            <input type="text" name="emailretype" id="modify">
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