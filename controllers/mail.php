<?php

function sendMailConfirmation(int $code, string $username, string $email): void
{
    $to_email = $email;
    $subject = "BetGame - Confirmation d'inscription";
    $headers = 'Mime-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From: BetGame <betgame.corp@gmail.com>" . "\r\n";
    $headers .= "\r\n";

    $body = '
    <html>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <body>
            <div style="font-family: \'Montserrat\'; font-size: 15px;">
                <img src="https://i.ibb.co/ctfV3X6/Test-banniere-mail-betgame.png" alt="bannimg">
                <br>
                <p>Bonjour ' . $username . ',</p>
                <p>Merci d’avoir rejoint <strong>BetGame</strong>.</p>
                <br>
                <p>Nous aimerions vous confirmer que votre compte a été créé avec succès. Pour accéder à BetGame, entrez ce code lors de votre première connexion.</p>
                <br>
                <p><strong>Code : ' . $code . '</strong></p>
                <br>
                <p>Cordialement,</p>
                <p>L\'équipe de <strong>BetGame</strong></p>
            </div>
        </body>
    </html>
    ';

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
}
