<?php
// подключаем файлы ядра
function autoloadsystem($class) {
    $filename = ROOT . "/core/" . $class . ".php";
    if(file_exists($filename)){
       require $filename;
    }
    $filename = ROOT . "/models/" . $class . ".php";
    if(file_exists($filename)){
       require $filename;
    }
 }
