<?php

require_once "NeuralNetwork.php";

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . $class;
});

$fileNotFound = false;
$controllerName = isset($_GET['target']) ? ucfirst($_GET['target']) : 'Base';
$methodName = isset($_GET['action']) ? $_GET['action'] : 'getMainPage';
$controllerClassName = '\\Controller\\' . $controllerName . 'Controller';
if (class_exists($controllerClassName)) {
    $contoller = new $controllerClassName();
    if (method_exists($contoller, $methodName)) {
        try {
            $contoller->$methodName();
        } catch (\PDOException $e) {
            //            header("HTTP/1.1 500");
            echo $e->getMessage();
            die();
        }
    } else {
        $fileNotFound = true;
    }
} else {
    $fileNotFound = true;
}
if ($fileNotFound) {
    echo 'target or action invalid: target = ' . $controllerName . ' and action = ' . $methodName;
}