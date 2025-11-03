<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controllers/TokenApiController.php';

$controller = new TokenApiController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $controller->listar();
        break;
    case 'PUT':
        $controller->actualizar();
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
        break;
}
