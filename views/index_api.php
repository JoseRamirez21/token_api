<?php
require_once __DIR__ . '/../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🌎 Buscador Turístico - API</title>
    <link rel="icon" href="../asset/img/logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background: linear-gradient(135deg, #cce5ff, #e8f5e9);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      padding-top: 60px;
    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: #ffffffcc;
      backdrop-filter: blur(8px);
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 15px 0;
      z-index: 1000;
    }

    .search-box {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }

    .search-box input {
      width: 350px;
      border-radius: 30px;
      border: 1px solid #007bff;
      padding: 8px 15px;
      outline: none;
      transition: all 0.3s ease;
    }

    .search-box input:focus {
      box-shadow: 0 0 5px rgba(0,123,255,0.4);
    }

    .search-box button {
      border: none;
      border-radius: 30px;
      background: linear-gradient(90deg, #007bff, #00bcd4);
      color: white;
      padding: 8px 20px;
      transition: 0.3s ease;
    }

    .search-box button:hover {
      transform: scale(1.05);
    }

    h1 {
      text-align: center;
      font-weight: 700;
      color: #007bff;
      margin-bottom: 0;
      font-size: 1.6rem;
    }

    #resultados {
      margin-top: 120px;
      display: flex;
      flex-wrap: wrap;
      gap: 25px;
      justify-content: center;
      padding: 0 20px 60px;
    }

    .card {
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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

  <header>
    <div class="container">
      <h1>🌎 Buscador Turístico</h1>
     <form id="formBusqueda" class="search-box mt-2">
  <div class="text-center">
    <label for="token" class="form-label mb-0 text-primary">Token de acceso:</label>
    <input type="text" id="token" class="form-control d-inline-block w-auto" 
           placeholder="Ingresa tu token"
           value="77790ffa98bfe3f332365ff43afdddf7-2" required>
  </div>

  <input type="text" id="dato" name="dato" placeholder="Buscar lugares..." required>
  <input type="hidden" id="url_api" value="http://localhost/turismo2025">
  <button type="submit">🔍 Buscar</button>
</form>

    </div>
  </header>

  <main>
    <div id="resultados"></div>
  </main>

  <script src="script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
