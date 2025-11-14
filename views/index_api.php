<?php
require_once __DIR__ . '/../config/config.php';
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}


// OBTENER EL TOKEN AUTOMÁTICO DESDE BD LOCAL
$stmt = $pdo_cons->query("SELECT token FROM token_api");
$tokenRow = $stmt->fetch(PDO::FETCH_ASSOC);
$token = $tokenRow ? $tokenRow['token'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🌎 Buscador Turístico - API</title>
  <link rel="icon" href="../asset/img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root {
      --color-primario: #3b4e76;
      --color-secundario: #6b8ef5;
      --color-acento: #ff4b5c;
      --fondo: #f4f7fb;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: var(--fondo);
      color: #333;
    }

    /* NAVBAR */
    nav {
      background: linear-gradient(135deg, var(--color-primario), var(--color-secundario));
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      position: fixed;
      width: 96%;
      top: 0;
      z-index: 1000;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
      font-size: 1.4rem;
      font-weight: bold;
    }

    .logo img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .nav-links a:hover {
      color: #e0e0e0;
    }

    .logout-button {
      background-color: var(--color-acento);
      color: white;
      padding: 8px 18px;
      border-radius: 25px;
      text-decoration: none;
      font-size: 15px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .logout-button:hover {
      background-color: #ff2f47;
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(255, 75, 92, 0.5);
    }

    /* CONTENIDO */
    main {
      max-width: 1000px;
      margin: 100px auto 40px;
      background: #fff;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: var(--color-primario);
      margin-bottom: 20px;
    }

    .search-box {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .search-box input[type="text"] {
      border-radius: 30px;
      border: 1px solid var(--color-primario);
      padding: 8px 15px;
      outline: none;
      transition: all 0.3s ease;
    }

    .search-box input[type="text"]:focus {
      box-shadow: 0 0 5px rgba(59,78,118,0.4);
    }

    .search-box button {
      border: none;
      border-radius: 30px;
      background: var(--color-secundario);
      color: white;
      padding: 8px 20px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .search-box button:hover {
      transform: scale(1.05);
    }

    #resultados {
      display: flex;
      flex-wrap: wrap;
      gap: 25px;
      justify-content: center;
      padding-bottom: 20px;
    }

    .card {
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      max-width: 260px;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-img-top {
      height: 160px;
      object-fit: cover;
    }

    .card-body {
      text-align: center;
      padding: 15px;
    }
  </style>
</head>
<body>

<nav>
    <div class="logo">
        <img src="../asset/img/logo.png" alt="Logo">
        Cliente API - Turismo Perú
    </div>
    <div class="nav-links">
        <a href="dashboard.php"><i class="fa-solid fa-key"></i> Tokens</a>
        <a href="index_api.php"><i class="fa-solid fa-map-location-dot"></i> Buscar Lugares</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
    </div>
</nav>

<main>
    <h1>🌎 Buscador Turístico</h1>

    <form id="formBusqueda" class="search-box">
        <!-- ✅ TOKEN AUTOMÁTICO -->
        <input type="hidden" id="token" value="<?= htmlspecialchars($token) ?>">
        <input type="text" id="dato" name="dato" placeholder="Buscar lugares..." required>
        <input type="hidden" id="url_api" value="https://turismo2025.404brothers.com.pe">
        <button type="submit">🔍 Buscar</button>
    </form>

    <div id="resultados"></div>
</main>

<script src="script.js?v=<?php echo time(); ?>"></script>

<!-- ✅ ALERTA SI NO HAY TOKEN ACTIVO -->
<?php if (empty($token)): ?>
<script>
Swal.fire({ 
  icon: 'warning',
  title: 'Token no configurado',
  text: 'No se encontró un token activo en el sistema consumidor. Por favor, agrega uno desde el panel de tokens.',
  confirmButtonText: 'Entendido'
});
</script>
<?php endif; ?>

</body>
</html>
