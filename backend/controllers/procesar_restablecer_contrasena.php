<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $token = $_POST['token'];

    $password_cifrada = sha1($password);

    include_once('../../database/conexion_bd_usuarios.php');
    $con = ConexionBDUsuarios::getInstancia();
    //$con = new ConexionBDUsuarios();
    $conexion = $con->getConexion();

    if ($conexion) {
        // Verificar el token
        $sql = "SELECT * FROM usuarios WHERE token_recuperacion='$token'";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) == 0) {
            $_SESSION['error_message'] = "Token inválido o expirado.";
            header("Location: ../pages/login.php");
            exit();
        } else {
            $sql_update = "UPDATE usuarios SET Contrasena='$password_cifrada', token_recuperacion=NULL WHERE token_recuperacion='$token'";
            mysqli_query($conexion, $sql_update);

            $_SESSION['success_message'] = "Contraseña restablecida correctamente.";
            header("Location: ../pages/login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Error de conexión con la base de datos.";
        header("Location: ../pages/login.php");
        exit();
    }
}
?>
