<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas de Alumnos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9; 
            color: #333;
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            color: #388e3c; 
            margin: 20px 0;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            gap: 10px;
        }

        #searchInput {
            padding: 8px 12px;
            border: 1px solid #388e3c; /* Verde */
            border-radius: 4px;
            width: 300px;
            font-size: 14px;
        }

        .search-btn, .clear-btn {
            background-color: #388e3c; /* Verde */
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .search-btn:hover, .clear-btn:hover {
            background-color: #2e7d32; /* Verde más oscuro */
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th {
            background-color: #388e3c; 
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f1f8e9; 
        }

        tr:hover {
            background-color: #c8e6c9; 
        }

        .no-results {
            text-align: center;
            color: #388e3c; 
            font-size: 18px;
            padding: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #searchInput {
                width: 70%;
            }

            .search-container {
                flex-direction: column;
            }

            .search-btn, .clear-btn {
                width: 100%;
                margin-top: 10px;
            }

            table {
                width: 100%;
            }
        }
    </style>
    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require_once('panel_principal.php'); ?>

    <h3>Consulta de Alumnos</h3>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar por número de control, nombre o correo...">
        <button class="search-btn">
            <i class="fas fa-search"></i> Buscar
        </button>
        <button class="clear-btn">
            <i class="fas fa-times"></i> Limpiar
        </button>
    </div>

    <?php
    include_once('../controllers/controller_alumno.php');
    $alumnoDAO = new AlumnoDAO();
    $datos = $alumnoDAO->mostrarAlumnos();

    if (mysqli_num_rows($datos) > 0) {
        echo '<table id="alumnosTable">
                <thead>
                    <tr>
                        <th>Número de Control</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Carrera</th>
                    </tr>
                </thead>
                <tbody>';
        
        while ($fila = mysqli_fetch_assoc($datos)) {
            echo "<tr>
                    <td>".$fila['numControl']."</td>
                    <td>".$fila['nombre']."</td>
                    <td>".$fila['apellidoP']."</td>
                    <td>".$fila['apellidoM']."</td>
                    <td>".$fila['fecha_nacimiento']."</td>
                    <td>".$fila['telefono']."</td>
                    <td>".$fila['email']."</td>
                    <td>".$fila['Carrera_carrera_id']."</td>
                  </tr>";
        }
        
        echo '</tbody></table>';
    } else {
        echo "<p class='no-results'>No se encontraron registros</p>";
    }
    ?>

    <!-- Script jQuery -->
    <script>
        $(document).ready(function () {
            // Filtrar la tabla en tiempo real
            $('#searchInput').on('input', function () {
                const searchTerm = $(this).val().toLowerCase();
                let noMatch = true;

                $('#alumnosTable tbody tr').each(function () {
                    const rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchTerm)) {
                        $(this).fadeIn(); // Mostrar con animación
                        noMatch = false;
                    } else {
                        $(this).fadeOut(); 
                    }
                });

                if (noMatch) {
                    $('.no-results').remove(); 
                    $('#alumnosTable').after('<p class="no-results">No se encontraron resultados</p>');
                } else {
                    $('.no-results').remove();
                }
            });

            $('.clear-btn').on('click', function () {
                $('#searchInput').val('');
                $('#alumnosTable tbody tr').fadeIn(); 
                $('.no-results').remove();
            });
        });
    </script>
</body>
</html>
