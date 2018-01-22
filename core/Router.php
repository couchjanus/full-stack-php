<?php

class Router
{
    protected $routes = [];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public function directPath($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            echo $this->routes[$uri];
            
            // var_dump(explode('@', $this->routes[$uri]));
            return;
            // return $this->callAction(...explode('@', $this->routes[$uri]));
            // return $this->action(...explode('@', $this->routes[$uri]));
        
        }

        throw new Exception('No route defined for this URI.');
    }


    protected function callAction($controller, $action, $vars = [])
    {

      include(CONTROLLERS.$controller.EXT);

      $controller = new $controller;

      if (! method_exists($controller, $action)) {
        throw new Exception(
        "{$controller} does not respond to the {$action} action."
        );
      }
      return $controller->$action($vars); // return $vars to the action
    }

    protected function action($segments, $action, $vars = [])
    {
      
      $segments = explode('\\', $segments);

      $controller = array_pop($segments);

      $controllerFile = '';

      do {
          if(count($segments)==0){
             $controllerFile = CONTROLLERS .$controllerFile.$controller . EXT;
             break;
          }
          else{
              $segment = array_shift($segments);
              $controllerFile = $controllerFile.$segment.'/';
          }
      }while ( count($segments) >= 0);
      
      include($controllerFile);
      
      $controller = new $controller;

      if (! method_exists($controller, $action)) {
        throw new Exception(
        "{$controller} does not respond to the {$action} action."
        );
      }
      return $controller->$action($vars); // return $vars to the action
    }
}

// $filename = CONFIG.'routes'.EXT;

// $result = null;

// // if (file_exists($filename)) {
// //     $routes = include($filename);
// // } else {
// //     echo "Файл $filename не существует";
// // }

// if (file_exists($filename)) {
//     define('ROUTES',include($filename));
// } else {
//     echo "Файл $filename не существует";
// }


// function getURI(){
//     if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))
//         return trim($_SERVER['REQUEST_URI'], '/');
// }

// function directPath($uri)
//     {
//       // Проверить наличие такого запроса в routes.php
//         if (array_key_exists($uri, ROUTES)) {
//             return ROUTES[$uri];
//         }
//         Throw new Exception('No route defined for this URI.');
//     }


// //получаем строку запроса

// $uri = getURI();

// $path = directPath($uri);


// list($segments, $action) = explode('@', $path);

// $segments = explode('\\', $segments);
// // 

// $controller = array_pop($segments);

// $controllerFile = '';

// do {
//     if(count($segments)==0){
//        $controllerFile = CONTROLLERS .$controllerFile.$controller . EXT;
//        break;
//     }
//     else{
//         $segment = array_shift($segments);
//         $controllerFile = $controllerFile.$segment.'/';
//     }
// }while ( count($segments) >= 0);

// //Подключаем файл контроллера

//     try {
//       include_once($controllerFile);
//       $controller = new $controller;

//       try {
//           // код который может выбросить исключение
//           $controller->$action();  
//           $result = true;
//       } catch (Exception $e) {

//         $result = false;
//           // код который может обработать исключение
//         if (! method_exists($controller, $action)) {
//           throw new Exception(
//           "{$controller} does not respond to the {$action} action."
//           );
//         }
//       }
//     } 
//     catch (Exception $e) {
//         // код который может обработать исключение
//         // если конечно оно появится
//         $result = false;
//         if (! file_exists($controllerFile)) {
//           throw new Exception("{$controllerFile} does not respond.");
//       }
//     }
//     finally{
//       return  $result;
//     } 



// if(!$result){
//      require_once VIEWS.'404'.EXT;
// }
