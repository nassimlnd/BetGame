<?php

/* Configuration de la base de donnée */

const DB_NAME = 'betgame';
const DB_HOST = '127.0.0.1';
const DB_USER = 'root';
const DB_PASSWORD = '';

/* Fonction de connexion */

function connect(): mysqli
{
    return new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}
