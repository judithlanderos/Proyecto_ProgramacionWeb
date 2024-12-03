<?php
include_once('../controllers/controller_alumno.php');

$alumnoDAO = new AlumnoDAO();

if (isset($_POST['numControl']) && !empty($_POST['numControl'])) {
    $numControl = $_POST['numControl'];

    if ($alumnoDAO->existeAlumno($numControl)) {
        $bajaExitoso = $alumnoDAO->registrarBaja($numControl);

        if ($bajaExitoso) {
            header('Location: ../pages/bajas.php?mensaje=exito');
            exit();
        } else {
            header('Location: ../pages/bajas.php?mensaje=error');
            exit();
        }
    } else {
        header('Location: ../pages/bajas.php?mensaje=no_existe');
        exit();
    }
} else {
    header('Location: ../pages/bajas.php?mensaje=invalido');
    exit();
}
?>
