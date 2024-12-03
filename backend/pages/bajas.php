<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .navbar {
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            color: white !important;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: white;
            color: green;
            border: 2px solid white;
            border-radius: 20px;
            padding: 0.375rem 1.5rem;
        }

        .btn-login:hover {
            background-color: green;
            color: white;
            border-color: green;
        }

        .form-container {
            width: 70%;
            margin: 20px auto;
            padding: 25px;
            background-color: white;
            border: none;
            border-radius: 8px;
        }

        h3 {
            text-align: center;
            color: green;
            margin: 20px 0;
        }

        .form-label {
            color: #666;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 12px;
        }

        .form-control:focus {
            border-color: green;
            box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
        }

        .btn-baja {
            background-color: green;
            border: 2px solid green;
            padding: 10px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-baja:hover {
            background-color: #228B22;
        }

        .table-responsive {
            width: 80%;
            margin: 20px auto;
        }

        .table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            font-size: 0.9em;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: green;
            color: white;
            padding: 10px;
            font-weight: 500;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e2e6ea;
        }

    </style>
</head>
<body>
<?php require_once('panel_principal.php'); ?>

<?php 
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
    if ($mensaje == 'exito') {
        echo "<div class='alert alert-success'>Alumno eliminado con éxito.</div>";
    } elseif ($mensaje == 'error') {
        echo "<div class='alert alert-danger'>Ocurrió un error al intentar eliminar al alumno.</div>";
    } elseif ($mensaje == 'no_existe') {
        echo "<div class='alert alert-warning'>El número de control no existe en la base de datos.</div>";
    } elseif ($mensaje == 'invalido') {
        echo "<div class='alert alert-warning'>Por favor, ingresa un número de control válido.</div>";
    }
}
?>

    <div class="form-container">
        <h3>Eliminar Alumno</h3>
        <form action="../controllers/procesar_bajas.php" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="numControl" class="form-label">Número de Control</label>
                <input type="text" class="form-control" id="numControl" name="numControl" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn-baja">Eliminar</button>
            </div>
        </form>
    </div>

    <h3>Listado de Alumnos</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Num Control</th>
                    <th>Nombre</th>
                    <th>Apellido P</th>
                    <th>Apellido M</th>
                    <th>Fecha Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('../controllers/controller_alumno.php');
                $alumnoDAO = new AlumnoDAO();
                $datos = $alumnoDAO->infoAlumnos();
                while ($fila = mysqli_fetch_assoc($datos)) {
                    echo "<tr>
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

    <script>
        const rows = document.querySelectorAll('.table tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', function() {
                const numControl = this.cells[0].textContent; 
                document.getElementById('numControl').value = numControl;
            });
        });
    </script>
</body>
</html>
