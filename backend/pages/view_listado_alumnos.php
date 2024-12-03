<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos y Carreras</title>
    <link rel="stylesheet" href="styles.css"> 
 <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0px;
    background-color: #f9f9f9;
}
.d-flex {
    padding: 0;
    background-color: #28a745;
    border: none;
    margin: 0;
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
    <h1>Listado de Alumnos y Carreras</h1>
    <?php include_once('../controllers/controller_listado_alumnos.php'); ?>
    <?php if (!empty($alumnos_carreras)): ?>
    <table>
        <thead>
            <tr>
                <th>Num Control</th>
                <th>Nombre</th>
                <th>Apellido P</th>
                <th>Apellido M</th>
                <th>Fecha Nacimiento</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos_carreras as $alumno): ?>
            <tr>
                <td><?= htmlspecialchars($alumno['numControl']) ?></td>
                <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                <td><?= htmlspecialchars($alumno['apellidoP']) ?></td>
                <td><?= htmlspecialchars($alumno['apellidoM']) ?></td>
                <td><?= htmlspecialchars($alumno['fecha_nacimiento']) ?></td>
                <td><?= htmlspecialchars($alumno['telefono']) ?></td>
                <td><?= htmlspecialchars($alumno['email']) ?></td>
                <td><?= htmlspecialchars($alumno['nombre_carrera']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No hay alumnos registrados.</p>
    <?php endif; ?>
</body>
</html>