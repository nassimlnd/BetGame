<?php

/*******************************************
 * On démarre une nouvelle session ou reprend une session existante
 *******************************************/
session_start();

/*******************************************
 * Inclusions des Fichier
 *******************************************/
include_once(@dirname(__FILE__) . '/configuration/Configuration.php');
include_once(@dirname(__FILE__) . '/includes/Header.php');
include_once(@dirname(__FILE__) . '/vendor/autoload.php');

/*******************************************
 * Actualisation des données de l'API / Check des bets
 *******************************************/

require 'src/Controllers/ApiController.php';
require 'src/Controllers/BetController.php';

refreshAll();
checkBet();

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