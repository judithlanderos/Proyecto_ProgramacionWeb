<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numControl = $_POST['numControl'];
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'] ?? ''; 
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'] ?? ''; 
    $email = $_POST['email'];
    $Carrera_carrera_id = $_POST['carrera'];

    $errores = [];
    $errorCampos = [];

    if (empty($nombre)) {
        $errores[] = "nombre_error|El nombre es obligatorio.";
        $errorCampos['nombre'] = "El nombre es obligatorio.";
    } elseif (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
        $errores[] = "nombre_error|El nombre solo debe contener letras y espacios.";
        $errorCampos['nombre'] = "El nombre solo debe contener letras y espacios.";
    }

    if (empty($apellidoP)) {
        $errores[] = "apellidoP_error|El primer apellido es obligatorio.";
        $errorCampos['apellidoP'] = "El primer apellido es obligatorio.";
    } elseif (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellidoP)) {
        $errores[] = "apellidoP_error|El primer apellido solo debe contener letras y espacios.";
        $errorCampos['apellidoP'] = "El primer apellido solo debe contener letras y espacios.";
    }

    if (!empty($apellidoM) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $apellidoM)) {
        $errores[] = "apellidoM_error|El segundo apellido solo debe contener letras y espacios.";
        $errorCampos['apellidoM'] = "El segundo apellido solo debe contener letras y espacios.";
    }

    if (empty($fecha_nacimiento)) {
        $errores[] = "fecha_nacimiento_error|La fecha de nacimiento es obligatoria.";
        $errorCampos['fecha_nacimiento'] = "La fecha de nacimiento es obligatoria.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_nacimiento)) {
        $errores[] = "fecha_nacimiento_error|La fecha de nacimiento no es válida.";
        $errorCampos['fecha_nacimiento'] = "La fecha de nacimiento no es válida.";
    }

    if (!empty($telefono) && !preg_match('/^\d{10}$/', $telefono)) {
        $errores[] = "telefono_error|El teléfono debe contener 10 dígitos sin guiones.";
        $errorCampos['telefono'] = "El teléfono debe contener 10 dígitos sin guiones.";
    }

    if (empty($email)) {
        $errores[] = "email_error|El correo electrónico es obligatorio.";
        $errorCampos['email'] = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "email_error|El correo electrónico no es válido.";
        $errorCampos['email'] = "El correo electrónico no es válido.";
    }

    if (empty($Carrera_carrera_id)) {
        $errores[] = "carrera_error|La carrera es obligatoria.";
        $errorCampos['Carrera_carrera_id'] = "La carrera es obligatoria.";
    }

    if (count($errores) > 0) {
        $mensaje = implode('<br>', array_map(function($error) { 
            return explode('|', $error)[1]; 
        }, $errores));
        
        $datosFormulario = [
            'numControl' => $numControl,
            'nombre' => $nombre,
            'apellidoP' => $apellidoP,
            'apellidoM' => $apellidoM,
            'fecha_nacimiento' => $fecha_nacimiento,
            'telefono' => $telefono,
            'email' => $email,
            'Carrera_carrera_id' => $Carrera_carrera_id
        ];
        
        $datosEncoded = urlencode(json_encode($datosFormulario));
        $erroresEncoded = urlencode(json_encode($errorCampos));
        
        header("Location: ../pages/cambios.php?datos=" . $datosEncoded . "&errores_campos=" . $erroresEncoded);
        exit;
    }

    include_once('../controllers/controller_alumno.php');

    $alumnoDAO = new AlumnoDAO();

    $exito = $alumnoDAO->modificarAlumno($numControl, $nombre, $apellidoP, $apellidoM, $fecha_nacimiento, $telefono, $email, $Carrera_carrera_id);

    if ($exito) {
        header('Location: ../pages/cambios.php?mensaje=exito');
    } else {
        header('Location: ../pages/cambios.php?mensaje=error');
    }
    exit;
}
?>