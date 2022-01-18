<?php
    define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// Définir les entiers des rôles :
    define('ROLE_ETD', 0);
    define('ROLE_ADM', 1);
    define('ROLE_ORGA', 2);
    define('ROLE_JURY', 3);

    require_once('Controller/Router.php');

    $router = new Router();
    $router->routeReq();
