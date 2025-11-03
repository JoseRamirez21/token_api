<?php
require_once __DIR__ . '/../config/config.php';

class Usuario {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Verificar las credenciales del usuario
    public function verificarCredenciales($correo, $clave) {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($clave, $usuario['clave'])) {
            return $usuario;
        }

        return false;
    }

    // Registrar un nuevo usuario
    public function registrarUsuario($nombre_usuario, $correo, $clave) {
        // Verificar si el correo ya está registrado
        $sql = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false; // Si el correo ya existe, retornar false
        }

        // Encriptar la contraseña
        $hashed_password = password_hash($clave, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre_usuario, correo, clave) VALUES (:nombre_usuario, :correo, :clave)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':clave', $hashed_password);

        if ($stmt->execute()) {
            return true; // Si la inserción es exitosa, retornar true
        }

        return false; // Si ocurre algún error
    }
}
?>
