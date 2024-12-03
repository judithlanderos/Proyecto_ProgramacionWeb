<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .card {
            border-radius: 10px;
        }
        .card-body {
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h3.card-title {
            color: #2d6a4f;
            font-weight: 600;
        }
        .btn-primary {
            background-color: #2d6a4f;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1b4d3a;
        }
        .text-secondary {
            color: #2d6a4f;
        }
        .text-secondary:hover {
            text-decoration: underline;
        }
        .form-label {
            color: #2d6a4f;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">¿Olvidaste tu contraseña?</h3>
                    <form action="../controllers/procesar_olvide_contrasena.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enviar enlace de restablecimiento</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="login.php" class="text-secondary">Volver al inicio de sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
