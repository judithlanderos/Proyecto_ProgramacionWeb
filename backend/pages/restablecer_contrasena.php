<?php
session_start();
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
unset($_SESSION['error_message']);
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
unset($_SESSION['success_message']);

$token = isset($_GET['token']) ? $_GET['token'] : null;
if (!$token) {
    $_SESSION['error_message'] = "Token inválido o expirado.";
    header("Location: ../pages/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card p-4 my-5">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4 text-success">Restablecer Contraseña</h3>

                        <?php if ($error_message): ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?= htmlspecialchars($error_message) ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($success_message): ?>
                            <div class="alert alert-success text-center" role="alert">
                                <?= htmlspecialchars($success_message) ?>
                            </div>
                        <?php endif; ?>

                        <form action="../controllers/procesar_restablecer_contrasena.php" method="POST">
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu nueva contraseña" required>
                            </div>
                            <input type="hidden" name="token" value="<?= $token ?>">

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-block">Restablecer Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
