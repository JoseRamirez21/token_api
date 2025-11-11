<?php
require_once __DIR__ . '/config/config.php';

try {
    $stmt = $pdo_cons->query("SELECT * FROM token_api");
    $tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($tokens);
    echo "</pre>";
} catch (PDOException $e) {
    die("Error al consultar tokens: " . $e->getMessage());
}
