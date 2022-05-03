<?php

/*******************************************
 * On démarre une nouvelle session ou reprend une session existante
 *******************************************/
session_start();

/*******************************************
 * Inclusions des Fichier
 *******************************************/
include_once(@dirname(__FILE__) . '/includes/Header.php');
include_once('config/DatabaseConfiguration.php');

/*******************************************
 * Actualisation des données de l'API / Check des bets
 *******************************************/

require 'controllers/api-sports.php';
require 'controllers/bet.php';

refreshAll();
checkBet(connect());

/*******************************************
 * Récupération de la page requested et affichage
 *******************************************/
if (empty($_GET['page'])) {
    $_GET['page'] = 'home';
}

if (!file_exists("pages/" . urlencode($_GET["page"]) . ".php")) {
    $_GET["page"] = "404";
}

$urlInclusion = 'pages/' . urlencode($_GET['page']) . '.php';
include($urlInclusion);


/*******************************************
 * Inclusions des Fichier
 *******************************************/
include_once(@dirname(__FILE__) . '/includes/Footer.php');
