<?php
require '../vendor/autoload.php';

$router = new App\Router(dirname(__DIR__) . '/views');

$router
    ->get('/', 'home', "Page d'accueil")
    ->get('/basket', 'sports', 'Basketball')
    ->get('/football', 'sports', 'Football')
    ->get('/login', 'login', 'Page de connexion')
    ->run();
