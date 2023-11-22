<?php

$routes = [
    'index' => [
        'method' => 'GET',
        'expression' => '/^\/?$/',
        'controller' => 'task',
        'controller_method' => 'index'
    ],
    'task.add' => [
        'method' => 'POST',
        'expression' => '/^\/add-task\/?$/',
        'controller' => 'task',
        'controller_method' => 'addTask'
    ],

    'auth.login' => [
        'method' => 'GET',
        'expression' => '/^\/login\/?$/',
        'controller' => 'auth',
        'controller_method' => 'login'
    ],
    'auth.process-login' => [
        'method' => 'POST',
        'expression' => '/^\/process-login\/?$/',
        'controller' => 'auth',
        'controller_method' => 'login'
    ],
    'auth.logout' => [
        'method' => 'POST',
        'expression' => '/^\/logout\/?$/',
        'controller' => 'auth',
        'controller_method' => 'logout'
    ],

    'admin.edit-task' => [
        'method' => 'GET',
        'expression' => '/^\/admin\/edit-task\/?$/',
        'controller' => 'admin',
        'controller_method' => 'editTask'
    ],
    'admin.process-edit-task' => [
        'method' => 'POST',
        'expression' => '/^\/admin\/process-edit-task\/?$/',
        'controller' => 'admin',
        'controller_method' => 'editTask'
    ],

    'admin.delete-task' => [
        'method' => 'POST',
        'expression' => '/^\/admin\/delete-task\/?$/',
        'controller' => 'admin',
        'controller_method' => 'deleteTask'
    ],
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace(HOME_URL, '', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"];
$uriParts = explode('/', $uri);
if (empty($uriParts[0]))
{
    array_shift($uriParts);
}

$routeFound = null;
$correctMethod = true;
foreach ($routes as $route)
{
    if (preg_match($route['expression'], $uri))
    {
        $routeFound = $route;
        if ($route['method'] != $requestMethod)
        {
            $correctMethod = false;
        }
        break;
    }
}

//var_dump($routes);
//var_dump($routeFound);
//var_dump($uri);die;
if (!$routeFound)
{
    header("HTTP/1.1 404 Not Found");
    $error = [
        "name" => "Not found!",
        "message" => "Route not found!",
        "status" => 404
    ];
    echo json_encode($error);
    exit();
} elseif (!$correctMethod)
{
    header("HTTP/1.1 422 Unprocessable Entity");
    $error = [
        "name" => "Unprocessable Entity",
        "message" => "Method not supported",
        "status" => 422
    ];
    echo json_encode($error);
    exit();
}