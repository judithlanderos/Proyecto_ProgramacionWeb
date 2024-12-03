<?php

include_once('../../database/conexion_bd_tutorias.php');

$conexionObj1 = new ConexionBDTutorias();
$conexion1 = $conexionObj1->getConexion(); 

require_once('../pages/panel_principal.php');

echo "<h2>Resultado del Procedimiento Almacenado</h2>";
$queryProcedimiento = "CALL obtenerTotalAlumnosSistemas()";
$resultadoProcedimiento = mysqli_query($conexion1, $queryProcedimiento);

if ($resultadoProcedimiento) {
    $row = mysqli_fetch_assoc($resultadoProcedimiento);
    echo "Total de alumnos en Ingeniería en Sistemas Computacionales (Procedimiento Almacenado): " . $row['total_alumnos'];
} else {
    echo "Error al ejecutar el procedimiento almacenado: " . mysqli_error($conexion1);
}

mysqli_free_result($resultadoProcedimiento);

$conexionObj2 = new ConexionBDTutorias();
$conexion2 = $conexionObj2->getConexion(); 

echo "<h2>Resultado de la Función</h2>";
$queryFuncion = "SELECT totalAlumnosPorCarrera('Ingenieria en Sistemas Computacionales') AS total_alumnos";
$stmt = $conexion2->prepare($queryFuncion);

$stmt->execute();
$stmt->bind_result($totalAlumnos);
$stmt->fetch();

echo "Total de alumnos en Ingeniería en Sistemas Computacionales (Función): " . $totalAlumnos;

$stmt->close();
mysqli_close($conexion1);
mysqli_close($conexion2);
?>
