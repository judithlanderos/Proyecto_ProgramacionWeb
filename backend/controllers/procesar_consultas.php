<?php
include_once('../controllers/controller_alumno.php');

$num_control = isset($_GET['num_control']) ? $_GET['num_control'] : null;
$datos_correctos = false;

if ($num_control !== null && !empty($num_control) && is_numeric($num_control)) {
    $datos_correctos = true;
}

if ($datos_correctos) {
    $alumnoDAO = new AlumnoDAO();
    $alumno = $alumnoDAO->consultarAlumno($num_control);

    if ($alumno) {
        echo '<h3>Datos del Alumno</h3>';
        echo '<table>
                <tr><th>Número de Control</th><td>' . $alumno['numControl'] . '</td></tr>
                <tr><th>Nombre</th><td>' . $alumno['nombre'] . '</td></tr>
                <tr><th>Apellido Paterno</th><td>' . $alumno['apellidoP'] . '</td></tr>
                <tr><th>Apellido Materno</th><td>' . $alumno['apellidoM'] . '</td></tr>
                <tr><th>Fecha de Nacimiento</th><td>' . $alumno['fecha_nacimiento'] . '</td></tr>
                <tr><th>Teléfono</th><td>' . $alumno['telefono'] . '</td></tr>
                <tr><th>Email</th><td>' . $alumno['email'] . '</td></tr>
                <tr><th>Carrera</th><td>' . $alumno['Carrera_carrera_id'] . '</td></tr>
              </table>';
    } else {
        echo "<p class='no-results'>No se encontró el registro del alumno.</p>";
    }
} else {
    echo "<p class='no-results'>Por favor, ingresa un número de control válido.</p>";
}
?>
