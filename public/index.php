<?php
require '../vendor/autoload.php';

$router = new App\Router(dirname(__DIR__) . '/views');

$router
    ->get('/', 'home', "Page d'accueil")
    ->get('/basket', 'sports', 'Sports')
    ->run();
