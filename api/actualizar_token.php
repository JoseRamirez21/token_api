<?php
require_once __DIR__ . '/../config/config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? null;
$nuevo_token = $data['token'] ?? null;

if (!$id || !$nuevo_token) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit;
}

$stmt = $pdo->prepare("UPDATE tokens SET token = ?, fecha_actualizacion = NOW() WHERE id = ?");
$stmt->execute([$nuevo_token, $id]);

echo json_encode(['status' => 'success']);
