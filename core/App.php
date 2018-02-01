<?php
class App {

    private $result = NULL;

    public function __construct(){
        // Запускаем сессию
        Session::init();
    }

    public function init(){

        $routesFile = CONFIG.'routes.php';

        Router::load($routesFile)
            ->directPath(Request::uri(), Request::method());

    }
}
