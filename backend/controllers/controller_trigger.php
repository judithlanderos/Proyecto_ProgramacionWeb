<?php
include_once('../../database/conexion_bd_tutorias.php');

$conexionObj = new ConexionBDTutorias();
$conexion = $conexionObj->getConexion();

$sql = "SELECT * FROM historial_cambios_alumnos ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}
?>
