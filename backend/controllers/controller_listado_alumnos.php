<?php
//Views
include_once('../../database/conexion_bd_tutorias.php');

$conexionObj = new ConexionBDTutorias();

$conexion = $conexionObj->getConexion();

$query = "SELECT * FROM listado_alumnos_carreras";
$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$alumnos_carreras = []; 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $alumnos_carreras[] = $row;
    }
}

?>