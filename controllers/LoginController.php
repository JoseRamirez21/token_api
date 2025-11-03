<?php
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // Función para manejar el login
    public function login($correo, $clave) {
        // Verificar las credenciales
        $usuario = $this->usuarioModel->verificarCredenciales($correo, $clave);

        if ($usuario) {
            // Si las credenciales son correctas, iniciar la sesión
            session_start(); // Asegúrate de que esta línea esté aquí
            $_SESSION['usuario_id'] = $usuario['id']; // Guardar el ID del usuario en la sesión
            $_SESSION['usuario_nombre'] = $usuario['nombre_usuario']; // Guardar el nombre del usuario
            header('Location: views/dashboard.php'); // Redirigir al dashboard
            exit();
        } else {
            // Si las credenciales son incorrectas, mostrar un mensaje de error
            return 'Correo o contraseña incorrectos.';
        }
    }
}
?>
