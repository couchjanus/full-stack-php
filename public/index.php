<?php

switch ($_SERVER['REQUEST_URI']) {

    case '/':
        # code...
        require_once 'home.php';
        break;

    case '/about':
        # code...
        require_once 'about.php';
        break;

    default:
        # code...
        echo $_SERVER['REQUEST_URI'];
}


// switch ($_SERVER['REQUEST_URI']) {

//     case '/':
//         # code...
//         include realpath(__DIR__).'/../views/home/index.php';
//         break;

//     case '/about':
//         # code...
//         include realpath(__DIR__).'/../views/home/about.php';
//         break;

//     default:
//          echo "<h1>404</h1>";
// }

// require_once realpath(__DIR__).'/../bootstrap/bootstrap.php';