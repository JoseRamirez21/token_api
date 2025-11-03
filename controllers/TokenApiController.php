<?php
require_once __DIR__ . '/../models/TokenApiModel.php';

class TokenApiController {
    private $model;

    public function __construct($db) {
        $this->model = new TokenApiModel($db);
    }

    public function listar() {
        $tokens = $this->model->obtenerTokens();
        echo json_encode(['status' => 'success', 'data' => $tokens]);
    }

    public function actualizar() {
        $input = json_decode(file_get_contents("php://input"), true);

        if (empty($input['id']) || empty($input['token'])) {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos para actualizar']);
            return;
        }

        if ($this->model->actualizarToken($input['id'], $input['token'])) {
            echo json_encode(['status' => 'success', 'message' => '✅ Token actualizado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '❌ Error al actualizar el token']);
        }
    }
}
