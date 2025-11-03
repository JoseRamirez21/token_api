<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/../config/config.php';

// Obtener los tokens de la BD
$stmt = $pdo->query("SELECT * FROM token_api");
$tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Turismo Perú</title>
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
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: fadeInUp 0.8s ease;
        }

        h1 {
            text-align: center;
            color: var(--color-primario);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            text-align: center;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--color-primario);
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .btn-editar {
            background-color: var(--color-secundario);
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-editar:hover {
            background-color: #5673d8;
            transform: scale(1.05);
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-contenido {
            background: white;
            padding: 25px;
            border-radius: 12px;
            width: 400px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            animation: fadeInUp 0.4s ease;
        }

        .modal input {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .modal-botones {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn-guardar {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-cancelar {
            background-color: #999;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <img src="../asset/img/logo.png" alt="Logo">
        Turismo Perú
    </div>
    <a href="../logout.php" class="logout-button">Cerrar sesión</a>
</nav>

<main>
    <h1>Gestión de Tokens</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Token</th>
            <th>Última actualización</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($tokens as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['id']) ?></td>
                <td><?= htmlspecialchars($t['token']) ?></td>
                <td><?= htmlspecialchars($t['ultima_actualizacion'] ?? '—') ?></td>
                <td>
                    <button class="btn-editar" onclick="abrirModal(<?= $t['id'] ?>, '<?= htmlspecialchars($t['token']) ?>')">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<!-- Modal -->
<div class="modal" id="modal">
    <div class="modal-contenido">
        <h3><i class="fa-solid fa-key"></i> Actualizar Token</h3>
        <p>Token actual:</p>
        <input type="text" id="tokenActual" readonly>
        <p>Nuevo token:</p>
        <input type="text" id="nuevoToken" placeholder="Escribe el nuevo token">
        <div class="modal-botones">
            <button class="btn-guardar" onclick="guardarToken()"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            <button class="btn-cancelar" onclick="cerrarModal()"><i class="fa-solid fa-xmark"></i> Cancelar</button>
        </div>
    </div>
</div>

<script>
    let idSeleccionado = null;

    function abrirModal(id, token) {
        idSeleccionado = id;
        document.getElementById('tokenActual').value = token;
        document.getElementById('nuevoToken').value = "";
        document.getElementById('modal').style.display = 'flex';
    }

    function cerrarModal() {
        document.getElementById('modal').style.display = 'none';
    }

    async function guardarToken() {
        const nuevoToken = document.getElementById('nuevoToken').value.trim();
        if (!nuevoToken) {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Por favor ingresa un nuevo token.',
                confirmButtonColor: '#3b4e76'
            });
            return;
        }

        try {
            const res = await fetch('../api/token_api.php', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: idSeleccionado, token: nuevoToken })
            });
            const data = await res.json();

            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado correctamente!',
                    text: 'El token se actualizó con éxito.',
                    confirmButtonColor: '#4CAF50'
                }).then(() => location.reload());
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo actualizar el token.',
                    confirmButtonColor: '#ff4b5c'
                });
            }
        } catch (err) {
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor.',
                confirmButtonColor: '#ff4b5c'
            });
        }

        cerrarModal();
    }
</script>

</body>
</html>
