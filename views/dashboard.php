<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al login
    header("Location: index.php");
    exit();
}

// Si está autenticado, mostrar el dashboard
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Turismo Perú</title>
    <link rel="icon" href="asset/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="asset/css/estilo.css">
    <style>
        /* Agregar estilos básicos para el dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
        }

        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #dc3545;
            transition: background-color 0.3s;
        }

        .header a:hover {
            background-color: #c82333;
        }

        .content {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 5px;
        }

        .content h3 {
            color: #007bff;
        }

        .content p {
            font-size: 16px;
        }

    </style>
</head>
<body>

    <div class="dashboard-container">
        <div class="header">
            <h2>Bienvenido, <?php echo $_SESSION['user_nombre']; ?>!</h2>
            <a href="logout.php">Cerrar sesión</a>
        </div>

        <div class="content">
            <h3>Contenido del Dashboard</h3>
            <p>Bienvenido a la página de administración. Aquí puedes acceder a diferentes secciones de tu cuenta.</p>
            <!-- Agregar más contenido del dashboard aquí -->
        </div>
    </div>

</body>
</html>
