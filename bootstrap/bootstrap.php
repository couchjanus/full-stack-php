<?php

require_once realpath(__DIR__).'/../config/app.php';

switch ($_SERVER['REQUEST_URI']) {

    case '/':
        # code...
        include VIEWS.'home/index.php';
        break;

    case '/about':
        # code...
        include VIEWS.'home/about.php';
        break;

    default:
         echo "<h1>404</h1>";
}
