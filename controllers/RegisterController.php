<?php
require_once __DIR__ . '/../models/Usuario.php';

class RegisterController {

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // Función para manejar el registro
    public function registrar($nombre_usuario, $correo, $clave) {
        // Intentar registrar el usuario
        $resultado = $this->usuarioModel->registrarUsuario($nombre_usuario, $correo, $clave);

        if ($resultado) {
            // Si el registro es exitoso, redirigir a la página de login
            header("Location: index.php?registro=exitoso");
            exit();
        } else {
            // Si el correo ya existe, retornar un mensaje de error
            return 'El correo ya está registrado.';
        }
    }
}
