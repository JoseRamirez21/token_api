<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia a tu host de base de datos si es diferente
$dbname = 'cliente_api'; // Nombre de tu base de datos
$username = 'root'; // Nombre de usuario de la base de datos
$password = ''; // Contraseña de la base de datos (Mac-Root)(Windows)

// Crear la conexión PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurar el modo de errores de PDO para excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configurar el charset a utf8 para manejar correctamente caracteres especiales
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Si hay un error, mostrarlo
    die("Conexión fallida: " . $e->getMessage());
}
?>
