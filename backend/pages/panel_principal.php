<?php
session_start();
if (!$_SESSION['valida']) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9f7ef;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #28a745 !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
        }

        .navbar-brand:hover, .nav-link:hover {
            color: #d4d4d4 !important;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }

        .welcome-text {
            color: #fff;
        }

        main {
            padding: 20px;
        }

        h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Gestión de Alumnos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="altas.php">Altas</a></li>
                    <li class="nav-item"><a class="nav-link" href="bajas.php">Bajas</a></li>
                    <li class="nav-item"><a class="nav-link" href="cambios.php">Cambios</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultas.php">Consultas</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_listado_alumnos.php">Vistas</a></li>
                    <li class="nav-item"><a class="nav-link" href="historial_cambios.php">Historial de Cambios-Trigger</a></li>
                    <li class="nav-item"><a class="nav-link" href="procedimiento_funcion.php">Procedimiento y Funcion</a></li>
                </ul>
                <form class="d-flex" action="../controllers/cerrar_sesion.php" method="POST">
                    <button class="btn btn-warning" type="submit">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container">
        <h2>Bienvenido al sistema ABCC</h2>
        <p>Gestiona Altas, Bajas, Cambios y Consultas de forma eficiente.</p>
    </main>
</body>
</html>
