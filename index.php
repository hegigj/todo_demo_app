<?php
session_start();

require_once 'vendor/autoload.php';

use Controllers\AuthController;
use Controllers\TodoController;

if (!isset($_SESSION[AuthController::USER_SESSION])) {
    header('Location: /auth/login');
}

$requestMethod = $_SERVER['REQUEST_METHOD']; // access request method (GET,POST)
$requestUri = parse_url($_SERVER['REQUEST_URI']); // access request uri
$requestPath = $requestUri['path']; // get request path /project_directory/...

$pathChunks = explode("/", $requestPath); // split path to array ['', 'project_directory', ...]
array_shift($pathChunks); // remove first empty index

$controllerName = array_shift($pathChunks); // get path, and we are going to use this path to find the controller
$controller = null;

switch (strtoupper($controllerName)) {
    case 'TODO':
        $controller = new TodoController(array_merge($_POST, $_GET, $_FILES, $_SERVER, $_SESSION));
        break;
    case 'AUTH':
        $controller = new AuthController(array_merge($_POST, $_GET, $_FILES, $_SERVER, $_SESSION));
        break;
}

if ($controller) {
    if (count($pathChunks) === 2) {
        $id = (int) $pathChunks[0];
        $method = $pathChunks[1];
        call_user_func_array([$controller, $method], [$id]);
    } elseif (count($pathChunks) === 1) {
        $chunk = $pathChunks[0];

        if (is_numeric($chunk)) {
            $id = (int) $chunk;
            $controller->getById($id);
        } else {
            $method = $chunk;
            call_user_func_array([$controller, $method], []);
        }
    } else {
        $controller->index();
    }

    $_GET = [];
    $_POST = [];
    $_SESSION['errors'] = [];
    $_SESSION['oldValues'] = [];
}
