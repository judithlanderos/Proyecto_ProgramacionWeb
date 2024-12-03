<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['username'];
    $password = $_POST['password'];
    $correo = $_POST['email'];

    // Validar correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "El correo electrónico no es válido.";
        header("Location: ../pages/registro.php");
        exit();
    }

    // Cifrar la contraseña
    $password_cifrada = sha1($password);

    // Incluir la clase de conexión PDO
    include_once('../../database/conexion_bd_usuarios.php');
    $con = ConexionBDUsuarios::getInstancia();
    //$con = new ConexionBDUsuarios();
    $conexion = $con->getConexion();

    if ($conexion) {
        // Verificar si el correo ya está registrado utilizando PDO
        $sql = "SELECT * FROM usuarios WHERE Correo = :correo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['error_message'] = "El correo electrónico ya está registrado.";
            header("Location: ../pages/registro.php");
            exit();
        } else {
            // Cifrar el nombre de usuario
            $usuario_cifrado = sha1($usuario);

            // Insertar el nuevo usuario
            $sql_insert = "INSERT INTO usuarios (Nombre_Usuario, Password, Correo) 
                           VALUES (:usuario, :password, :correo)";
            $stmt_insert = $conexion->prepare($sql_insert);
            $stmt_insert->bindParam(':usuario', $usuario_cifrado, PDO::PARAM_STR);
            $stmt_insert->bindParam(':password', $password_cifrada, PDO::PARAM_STR);
            $stmt_insert->bindParam(':correo', $correo, PDO::PARAM_STR);

            // Ejecutar la inserción
            if ($stmt_insert->execute()) {
                $_SESSION['valida'] = true;
                $_SESSION['usuario'] = $usuario;

                // Aquí ejecutamos el hilo para enviar el correo en segundo plano
                $command = "php enviar_correo.php '$correo' &";  
                exec($command);

                header("Location: ../pages/panel_principal.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Error al registrar el usuario.";
                header("Location: ../pages/registro.php");
                exit();
            }
        }
    } else {
        $_SESSION['error_message'] = "Error de conexión con la base de datos.";
        header("Location: ../pages/registro.php");
        exit();
    }
}
?>
