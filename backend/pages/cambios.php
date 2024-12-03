<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambios de ALUMNOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-cambiar {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-cambiar:hover {
            background-color: green;
        }

        .error-message {
            color: red;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: red !important;
        }

        .table-responsive {
            margin-top: 30px;
        }

        .table thead {
            background-color: green;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php 
$datosRecuperados = [];
$erroresCampos = [];

if (isset($_GET['datos'])) {
    $datosRecuperados = json_decode(urldecode($_GET['datos']), true);
}

if (isset($_GET['errores_campos'])) {
    $erroresCampos = json_decode(urldecode($_GET['errores_campos']), true);
}
?>

<?php require_once('panel_principal.php'); ?>

<?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'exito'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Éxito!</strong> Los datos fueron modificados correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            var successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                var bsAlert = new bootstrap.Alert(successAlert);
                bsAlert.close();
            }
        }, 3000);
    </script>
<?php endif; ?>

<div class="container mt-5">
<form id="formCambios" action="../controllers/procesar_cambios.php" method="post" class="row g-3">
    <input type="hidden" id="caja_num_control" name="numControl" 
           value="<?php echo htmlspecialchars($datosRecuperados['numControl'] ?? ''); ?>" tabindex="1">

    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control <?php echo isset($erroresCampos['nombre']) ? 'is-invalid' : ''; ?>" 
               id="nombre" name="nombre" required tabindex="2"
               value="<?php echo htmlspecialchars($datosRecuperados['nombre'] ?? ''); ?>">
        <?php if (isset($erroresCampos['nombre'])): ?>
            <div class="error-message"><?php echo $erroresCampos['nombre']; ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="apellidoP" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control <?php echo isset($erroresCampos['apellidoP']) ? 'is-invalid' : ''; ?>" 
               id="apellidoP" name="apellidoP" required tabindex="3"
               value="<?php echo htmlspecialchars($datosRecuperados['apellidoP'] ?? ''); ?>">
        <?php if (isset($erroresCampos['apellidoP'])): ?>
            <div class="error-message"><?php echo $erroresCampos['apellidoP']; ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="apellidoM" class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control <?php echo isset($erroresCampos['apellidoM']) ? 'is-invalid' : ''; ?>" 
               id="apellidoM" name="apellidoM" tabindex="4"
               value="<?php echo htmlspecialchars($datosRecuperados['apellidoM'] ?? ''); ?>">
        <?php if (isset($erroresCampos['apellidoM'])): ?>
            <div class="error-message"><?php echo $erroresCampos['apellidoM']; ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
        <input type="date" class="form-control <?php echo isset($erroresCampos['fecha_nacimiento']) ? 'is-invalid' : ''; ?>" 
               id="fecha_nacimiento" name="fecha_nacimiento" required tabindex="5"
               value="<?php echo htmlspecialchars($datosRecuperados['fecha_nacimiento'] ?? ''); ?>">
        <?php if (isset($erroresCampos['fecha_nacimiento'])): ?>
            <div class="error-message"><?php echo $erroresCampos['fecha_nacimiento']; ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control <?php echo isset($erroresCampos['telefono']) ? 'is-invalid' : ''; ?>" 
               id="telefono" name="telefono" tabindex="6"
               value="<?php echo htmlspecialchars($datosRecuperados['telefono'] ?? ''); ?>">
        <?php if (isset($erroresCampos['telefono'])): ?>
            <div class="error-message"><?php echo $erroresCampos['telefono']; ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control <?php echo isset($erroresCampos['email']) ? 'is-invalid' : ''; ?>" 
               id="email" name="email" required tabindex="7"
               value="<?php echo htmlspecialchars($datosRecuperados['email'] ?? ''); ?>">
        <?php if (isset($erroresCampos['email'])): ?>
            <div class="error-message"><?php echo $erroresCampos['email']; ?></div>
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
        <?php if (isset($erroresCampos['Carrera_carrera_id'])): ?>
            <div class="error-message"><?php echo $erroresCampos['Carrera_carrera_id']; ?></div>
        <?php endif; ?>
    </div>

    <div class="col-12 button-container">
        <button type="submit" class="btn-cambiar" tabindex="9">MODIFICAR</button>
    </div>
</form>


    <h3 class="mt-5">Listado de Alumnos</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Num_Control</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Fecha Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody id="tablaAlumnos">
                <?php
                include_once('../controllers/controller_alumno.php');
                $alumnoDAO = new AlumnoDAO();
                $datos = $alumnoDAO->mostrarAlumnos();
                while ($fila = mysqli_fetch_assoc($datos)) {
                    echo "<tr onclick='cargarDatos(" . json_encode($fila) . ")'>
                        <td>{$fila['numControl']}</td>
                        <td>{$fila['nombre']}</td>
                        <td>{$fila['apellidoP']}</td>
                        <td>{$fila['apellidoM']}</td>
                        <td>{$fila['fecha_nacimiento']}</td>
                        <td>{$fila['telefono']}</td>
                        <td>{$fila['email']}</td>
                        <td>{$fila['Carrera_carrera_id']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function cargarDatos(alumno) {
        document.getElementById('caja_num_control').value = alumno.numControl;
        document.getElementById('nombre').value = alumno.nombre;
        document.getElementById('apellidoP').value = alumno.apellidoP;
        document.getElementById('apellidoM').value = alumno.apellidoM || '';
        document.getElementById('fecha_nacimiento').value = alumno.fecha_nacimiento;
        document.getElementById('telefono').value = alumno.telefono || '';
        document.getElementById('email').value = alumno.email;
        
        let carreraSelect = document.getElementById('carrera');
        carreraSelect.value = alumno.Carrera_carrera_id || 'Administracion';
    }
</script>
</body>
</html>