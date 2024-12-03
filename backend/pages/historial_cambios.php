<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Cambios</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f9f9f9;
}

h1 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #fff;  
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;  
}

thead {
    background-color: #28a745;  
    color: white;
}

thead th {
    padding: 10px;
    text-align: center;
    font-weight: bold;
    border: 1px solid #ddd;  
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;  
}

tbody tr:hover {
    background-color: #e2e2e2;  
    cursor: pointer;
}

tbody td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

    </style>
</head>
<body>
    <?php require_once('panel_principal.php'); ?>

    <h1>Historial de Cambios en Alumnos</h1>
    <?php include_once('../controllers/controller_trigger.php'); ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número de Control</th>
                <th>Columna Modificada</th>
                <th>Valor Anterior</th>
                <th>Valor Nuevo</th>
                <th>Fecha</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['numControl'] . "</td>";
                    echo "<td>" . $row['columna_modificada'] . "</td>";
                    echo "<td>" . $row['valor_anterior'] . "</td>";
                    echo "<td>" . $row['valor_nuevo'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['usuario'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay registros en el historial.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
