<?php
require_once __DIR__ . '/../config/config.php';

class TokenApiModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los tokens
    public function obtenerTokens() {
        $stmt = $this->conn->prepare("SELECT * FROM token_api");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar un token específico
    public function actualizarToken($id, $nuevoToken) {
        $stmt = $this->conn->prepare("UPDATE token_api SET token = :token, ultima_actualizacion = NOW() WHERE id = :id");
        return $stmt->execute([
            ':token' => $nuevoToken,
            ':id' => $id
        ]);
    }
}
