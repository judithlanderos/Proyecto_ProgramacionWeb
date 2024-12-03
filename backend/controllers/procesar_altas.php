<?php
session_start();
include_once('controller_alumno.php');

$num_control = $_POST['caja_num_control'];
$nombre = $_POST['caja_nombre'];
$primer_apellido = $_POST['primerApellido'];
$segundo_apellido = $_POST['segundoApellido'] ?? ''; 
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$carrera = $_POST['carrera'];

$datos_correctos = true;
$errores = [];

if (!preg_match('/^[a-zA-Z]\d{8}$/', $num_control)) {
    $datos_correctos = false;
    $errores['num_control'] = "Número de control debe ser 1 letra seguida de 8 números";
    unset($_SESSION['nc']); 
}

if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $nombre)) {
    $datos_correctos = false;
    $errores['nombre'] = "El nombre solo puede contener letras";
    unset($_SESSION['nombre']); 
}

if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $primer_apellido)) {
    $datos_correctos = false;
    $errores['primer_apellido'] = "El primer apellido solo puede contener letras";
}

if (!empty($segundo_apellido) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $segundo_apellido)) {
    $datos_correctos = false;
    $errores['segundo_apellido'] = "El segundo apellido solo puede contener letras";
}

if (!preg_match('/^\d{10}$/', $telefono)) {
    $datos_correctos = false;
    $errores['telefono'] = "El teléfono debe contener 10 dígitos";
}

if (!preg_match('/^[a-zA-Z]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/', $email)) {
    $datos_correctos = false;
    $errores['email'] = "El correo electrónico no tiene un formato válido (letras@letras.com)";
}
if (empty($_POST['carrera'])) {
    $_SESSION['errores']['carrera'] = 'Por favor selecciona una carrera.';
    header('Location: formulario_alumnos.php');
    exit();
}

if (!$datos_correctos) {
    $_SESSION['nc'] = $num_control;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['primer_apellido'] = $primer_apellido;
    $_SESSION['segundo_apellido'] = $segundo_apellido;
    $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
    $_SESSION['telefono'] = $telefono;
    $_SESSION['email'] = $email;
    $_SESSION['carrera'] = $carrera;

    $_SESSION['errores'] = $errores;

    header('Location: ../pages/altas.php');
    exit();
}

$alumnoDAO = new AlumnoDAO();

if ($alumnoDAO->existeAlumno($num_control)) {
    $_SESSION['error_validacion'] = "El número de control ya existe. Por favor, ingresa otro número de control.";
    header('Location: ../pages/altas.php');
    exit();
}

$res = $alumnoDAO->agregarAlumno($num_control, $nombre, $primer_apellido, $segundo_apellido, $fecha_nacimiento, $telefono, $email, $carrera);

if ($res) {
    $_SESSION['insercion_correcta'] = true;
    $_SESSION['nc'] = '';
    $_SESSION['nombre'] = '';
    $_SESSION['primer_apellido'] = '';
    $_SESSION['segundo_apellido'] = '';
    $_SESSION['fecha_nacimiento'] = '';
    $_SESSION['telefono'] = '';
    $_SESSION['email'] = '';
    $_SESSION['carrera']= '';
} else {
    $_SESSION['error_validacion'] = "Error al insertar el registro.";
}

header('Location: ../pages/altas.php');
exit();
?>