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
    <title>Iniciar Sesión</title>

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
                    <h3 class="card-title text-center mb-4 text-success">Iniciar Sesión</h3>

                    <?php if ($error_message): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= htmlspecialchars($error_message) ?>
                        </div>
                    <?php endif; ?>
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                    <form action="../controllers/validar_usuario.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Ingresa tu nombre de usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        </div>
                        
                        <div class="g-recaptcha" data-sitekey="6LdutY8qAAAAAEmzSwFfwV3zgpAdL3m4ezHwyEez"></div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                    <p>¿Olvidaste tu contraseña? <a href="recuperar_contraseña.php" class="text-warning">Recuperala</a></p>
                    </div>
                </div>
            </div>
            <div class="text-center text-white">
                <p>¿No tienes cuenta? <a href="registro.php" class="text-warning">Regístrate</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
