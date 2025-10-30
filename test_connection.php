<?php
require_once 'config/config.php';

if ($pdo) {
    echo "Conexión exitosa a la base de datos!";
} else {
    echo "Error en la conexión a la base de datos.";
}
?>
