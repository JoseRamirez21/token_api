<?php
// ==========================
// CONFIGURACIÓN DE BASES DE DATOS
// ==========================

// Sistema Consumidor
$host_cons = 'localhost';
$dbname_cons = 'cliente_api';
$user_cons = 'root';
$pass_cons = '';



try {
    // Conexión consumidor
    $pdo_cons = new PDO("mysql:host=$host_cons;dbname=$dbname_cons;charset=utf8mb4", $user_cons, $pass_cons);
    $pdo_cons->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

