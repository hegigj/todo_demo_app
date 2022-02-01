<?php

include __DIR__.'/controllers/AuthController.php';
include __DIR__.'/controllers/TodoController.php';

$requestMethod = $_SERVER['REQUEST_METHOD']; // access request method (GET,POST)
$requestUri = parse_url($_SERVER['REQUEST_URI']); // access request uri
$requestPath = $requestUri['path']; // get request path /project_directory/...

$pathChunks = explode("/", $requestPath); // split path to array ['', 'project_directory', ...]
array_shift($pathChunks); // remove first empty index
array_shift($pathChunks); // remove second index which is the project directory

$controllerName = array_shift($pathChunks); // get path, and we are going to use this path to find the controller
$controller = null;

switch ($controllerName) {
    case 'todo':
        $controller = new TodoController();
        break;
    case 'auth':
        $controller = new AuthController();
        break;
}

if (count($pathChunks) === 2) {
    $id = (int) $pathChunks[0];
    $method = $pathChunks[1];
    echo "IF: id:$id and method:$method";
} elseif (count($pathChunks) === 1) {
    $chunk = $pathChunks[0];

    if (is_numeric($chunk)) {
        $id = (int) $chunk;
    }
} else {
    $controller->index();
}