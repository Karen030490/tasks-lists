<?php

$methodName = $route['controller_method'];
$controller = $route['controller'];

$controllerClassname = '\controller\\' . ucfirst($controller) . 'Controller';

if (class_exists($controllerClassname)) {
    $reqController = new $controllerClassname;
    $reqController->{$methodName}($uriParts);
    // Use $reqController as needed
} else {
    // Handle case where the class doesn't exist
    echo "Controller class not found";
}
