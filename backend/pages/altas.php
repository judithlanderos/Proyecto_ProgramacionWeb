<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #eafaf1;
        }
        .btn-primary {
            background-color: #4CAF50 !important; 
            border-color: #4CAF50 !important;
        }
        .btn-primary:hover {
            background-color: #45a049 !important;
            border-color: #45a049 !important;
        }
        .alert-warning {
            background-color: #28a745; 
            color: white;
        }
        .alert-warning .btn-close {
            color: white;
        }
        .error-text {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
    <?php require_once('panel_principal.php'); ?>

    <?php if (isset($_SESSION['insercion_correcta']) && $_SESSION['insercion_correcta']) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Registro agregado correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_validacion'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error_validacion']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="container mt-5">
        <form action="../controllers/procesar_altas.php" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="caja_num_control" class="form-label">Número de Control</label>
                <input type="text" class="form-control" id="caja_num_control" name="caja_num_control" 
                placeholder="1 letra seguida de 8 números" 
                value="<?php echo isset($_SESSION['nc']) ? $_SESSION['nc'] : '' ?>" 
                maxlength="9" required tabindex="1">
                <?php if (isset($_SESSION['errores']['num_control'])): ?>
                    <div class="error-text"><?php echo $_SESSION['errores']['num_control']; ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="caja_nombre" name="caja_nombre" 
                placeholder="Solo letras" 
                value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '' ?>" 
                maxlength="50" required tabindex="2">
                <?php if (isset($_SESSION['errores']['nombre'])): ?>
                    <div class="error-text"><?php echo $_SESSION['errores']['nombre']; ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <label for="primerApellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" id="primerApellido" name="primerApellido" 
                placeholder="Solo letras" 
                value="<?php echo isset($_SESSION['primer_apellido']) ? $_SESSION['primer_apellido'] : '' ?>" 
                maxlength="50" required tabindex="3">
                <?php if (isset($_SESSION['errores']['primer_apellido'])): ?>
                    <div class="error-text"><?php echo $_SESSION['errores']['primer_apellido']; ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <label for="segundoApellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" 
                placeholder="Solo letras" 
                value="<?php echo isset($_SESSION['segundo_apellido']) ? $_SESSION['segundo_apellido'] : '' ?>" 
                maxlength="50" tabindex="4">
                <?php if (isset($_SESSION['errores']['segundo_apellido'])): ?>
                    <div class="error-text"><?php echo $_SESSION['errores']['segundo_apellido']; ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" 
                value="<?php echo isset($_SESSION['fecha_nacimiento']) ? $_SESSION['fecha_nacimiento'] : '' ?>" 
                required tabindex="5">
            </div>

            <div class="col-md-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" 
                placeholder="10 dígitos" 
                value="<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : '' ?>" 
                maxlength="10" required tabindex="6">
                <?php if (isset($_SESSION['errores']['telefono'])): ?>
                    <div class="error-text"><?php echo $_SESSION['errores']['telefono']; ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" 
                placeholder="letras@letras.com" 
                value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" 
                maxlength="100" required tabindex="7">
                <?php if (isset($_SESSION['errores']['email'])): ?>
                    <div class="error-text"><?php echo $_SESSION['errores']['email']; ?></div>
                <?php endif; ?>
            </div> 
            <div class="col-md-6">
                <label for="carrera" class="form-label">Carrera</label>
                <select class="form-select" id="carrera" name="carrera" required tabindex="8">
                    <option value="" disabled selected>Selecciona tu carrera</option>
                    <option value="Ingenieria en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                    <option value="Ingenieria Mecatronica">Ingeniería Mecatrónica</option>
                    <option value="Ingenieria en Industrias Alimentarias">Ingeniería en Industrias Alimentarias</option>
                    <option value="Licenciatura en Contador">Licenciatura en Contaduría</option>
                    <option value="Administracion">Administración</option>
                </select>
                <?php if (isset($_SESSION['errores']['carrera'])): ?>
                    <div class="error-text"><?php echo $_SESSION['errores']['carrera']; ?></div>
                <?php endif; ?>
            </div>

            <div class="col-12 button-container">
                <button type="submit" class="btn btn-primary" tabindex="9">AGREGAR</button>
            </div>
        </form>
    </div>

    <?php
    unset($_SESSION['insercion_correcta']);
    unset($_SESSION['error_validacion']);
    unset($_SESSION['errores']);
    ?>
</body>
</html>
