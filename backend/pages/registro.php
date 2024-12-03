<?php
session_start();
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
unset($_SESSION['error_message']); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(to right, #43a047, #66bb6a);
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: white;
        }
        .btn-success {
            background-color: #43a047;
            border: none;
        }
        .btn-success:hover {
            background-color: #66bb6a;
        }
        .form-label {
            color: #333;
        }
        .text-warning {
            color: #121312 !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card p-4 my-5">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4 text-success">Registro</h3>

                    <?php if ($error_message): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= htmlspecialchars($error_message) ?>
                        </div>
                    <?php endif; ?>

                    <form action="../controllers/registrar_usuario.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Ingresa tu usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-block">Registrarse</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="../pages/login.php" class="text-secondary">¿Ya tienes cuenta? Inicia sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
