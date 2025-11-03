<?php
// Iniciar sesión
session_start(); // Asegúrate de que esta línea esté al principio del archivo

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['usuario_id'])) {
    header('Location: views/dashboard.php'); // Redirigir al dashboard si ya está logueado
    exit();
}

$error = ''; // Variable para mensajes de error

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es login
    if (isset($_POST['login'])) {
        require_once 'controllers/LoginController.php';
        $loginController = new LoginController();
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $error = $loginController->login($correo, $clave); // Retorna el mensaje de error
    }

    // Si es registro
    if (isset($_POST['register'])) {
        require_once 'controllers/RegisterController.php';
        $registerController = new RegisterController();
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $error = $registerController->registrar($nombre_usuario, $correo, $clave); // Retorna el mensaje de error
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Turismo Perú</title>
    <link rel="icon" href="asset/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="asset/css/estilo.css">
</head>
<body>

    <div class="login-container">
        <div class="logo-container">
            <img src="asset/img/logo.png" alt="Logo Turismo Perú" class="logo">
        </div>

        <h2>Bienvenido a Turismo Perú</h2>

        <!-- Mostrar mensaje de error si es necesario -->
        <?php if ($error): ?>
            <div class="error-message">
                <p style="color: red;"><?php echo $error; ?></p>
            </div>
        <?php endif; ?>

        <!-- Formulario de Login -->
        <div class="login-form" id="login-form">
            <h3>Iniciar sesión</h3>
            <form action="index.php" method="POST">
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="clave" placeholder="Contraseña" required>
                <button type="submit" name="login">Iniciar sesión</button>
            </form>
            <p>¿No tienes cuenta? <a href="#" onclick="toggleForm()">Regístrate aquí</a></p>
        </div>

        <!-- Formulario de Registro -->
        <div class="register-form" id="register-form">
            <h3>Regístrate</h3>
            <form action="index.php" method="POST">
                <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="clave" placeholder="Contraseña" required>
                <button type="submit" name="register">Registrarse</button>
            </form>
            <p>¿Ya tienes cuenta? <a href="#" onclick="toggleForm()">Inicia sesión aquí</a></p>
        </div>

    </div>

    <script src="asset/js/script.js"></script>
</body>
</html>
