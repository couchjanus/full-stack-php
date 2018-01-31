<?php

if (function_exists('date_default_timezone_set')){
    date_default_timezone_set('Europe/Kiev');
}


// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once realpath(__DIR__).'/../config/app.php';
require_once realpath(__DIR__).'/./autoload.php';
// Регистрируем автозагрузчик
spl_autoload_register("autoloadsystem");

$app = new App();
$app->init();

// require_once CORE.'Connection.php';
// require_once MODELS.'Category.php';
// require_once MODELS.'Product.php';
// require_once MODELS.'Post.php';
// require_once MODELS.'Role.php';
// require_once MODELS.'User.php';
// require_once CORE.'Session.php';
// require_once CORE.'View.php';
// require_once CORE.'Controller.php';
// require_once CORE.'Request.php';
// require_once CORE.'Router.php';
//
// // Запускаем сессию
// Session::init();
//
// $routesFile = CONFIG.'routes.php';
//
// Router::load($routesFile)
//     ->directPath(Request::uri(), Request::method());
