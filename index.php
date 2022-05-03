<?php

/*******************************************
 * Include autoloader de composer pour les classes et les namespaces
 *******************************************/
include_once(@dirname(__FILE__) . '/vendor/autoload.php');

/*******************************************
 * On démarre une nouvelle session ou reprend une session existante
 *******************************************/
session_start();

/*******************************************
 * Inclusions des Fichier
 *******************************************/
include_once(@dirname(__FILE__) . '/configuration/Configuration.php');
include_once(@dirname(__FILE__) . '/includes/Header.php');

/*******************************************
 * Actualisation des données de l'API / Check des bets
 *******************************************/

use App\Controllers\BetController;
use App\Controllers\ApiController;
ApiController::refreshAll();
BetController::checkBet();



/*******************************************
 * URL Rewriting
 *******************************************/
if (empty($_GET['page'])) {
    $_GET['page'] = 'home';
}

if (!file_exists("page/" . urlencode($_GET["page"]) . ".php")) {
    $_GET["page"] = "404";
}

$urlInclusion = 'page/' . urlencode($_GET['page']) . '.php';
include($urlInclusion);


/*******************************************
 * Inclusions des Fichier
 *******************************************/
include_once(@dirname(__FILE__) . '/includes/Footer.php');
