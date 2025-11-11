<?php
// ==========================
// CONFIGURACIÓN DE BASES DE DATOS
// ==========================

// Sistema Consumidor
$host_cons = 'localhost';
$dbname_cons = 'cliente_api';
$user_cons = 'root';
$pass_cons = '';

// Sistema Principal
$host_princ = 'localhost';
$dbname_princ = 'turismo_peru';
$user_princ = 'root';
$pass_princ = '';

try {
    // Conexión consumidor
    $pdo_cons = new PDO("mysql:host=$host_cons;dbname=$dbname_cons;charset=utf8mb4", $user_cons, $pass_cons);
    $pdo_cons->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Conexión principal
    $pdo_princ = new PDO("mysql:host=$host_princ;dbname=$dbname_princ;charset=utf8mb4", $user_princ, $pass_princ);
    $pdo_princ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
