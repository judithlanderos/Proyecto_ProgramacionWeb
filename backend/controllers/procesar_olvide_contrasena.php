<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    include_once('../../database/conexion_bd_usuarios.php');
    $con = ConexionBDUsuarios::getInstancia();
    //$con = new ConexionBDUsuarios();
    $conexion = $con->getConexion();

    if ($conexion) {
        $sql = "SELECT * FROM usuarios WHERE Email = '$email'";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Generar un token único
            $token = bin2hex(random_bytes(50));
            $sql_token = "UPDATE usuarios SET reset_token='$token', token_expiry=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE Email='$email'";
            mysqli_query($conexion, $sql_token);

            // Enviar el correo
            $reset_link = "http://yourwebsite.com/pages/restablecer_contrasena.php?token=$token";
            mail($email, "Restablecimiento de contraseña", "Haz clic en este enlace para restablecer tu contraseña: $reset_link");

            $_SESSION['success_message'] = "Se ha enviado un enlace a tu correo electrónico.";
        } else {
            $_SESSION['error_message'] = "No existe una cuenta con este correo.";
        }
    } else {
        $_SESSION['error_message'] = "Error en la conexión con la base de datos.";
    }

    header('Location: ../pages/olvide_contrasena.php');
    exit();
}
?>
