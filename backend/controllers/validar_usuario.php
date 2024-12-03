<?php
session_start();

// Clave secreta de reCAPTCHA
$secret_key = "6LdutY8qAAAAAFkLvu1fZJfmr8hsQqMpe7T5Yzad";

// Obtener la respuesta del CAPTCHA
$captcha_response = $_POST['g-recaptcha-response'];

// Verificar si se completó el CAPTCHA
if (empty($captcha_response)) {
    $_SESSION['error_message'] = 'Por favor, completa el CAPTCHA.';
    header('location: ../pages/login.php');
    exit();
}

// Validar el CAPTCHA en el servidor de Google
$verify_url = "https://www.google.com/recaptcha/api/siteverify";
$data = [
    'secret' => $secret_key,
    'response' => $captcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$ch = curl_init($verify_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$response = curl_exec($ch);
curl_close($ch);

// Decodificar la respuesta JSON
$result = json_decode($response, true);

// Si el CAPTCHA no es válido
if (!$result['success']) {
    $_SESSION['error_message'] = 'Error de validación CAPTCHA. Inténtalo de nuevo.';
    header('location: ../pages/login.php');
    exit();
}

$usuario = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];  

$u_cifrado = sha1($usuario);
$p_cifrado = sha1($password);
$email = $email;

include_once('../../database/conexion_bd_usuarios.php');

//$con = new ConexionBDUsuarios();
$con = ConexionBDUsuarios::getInstancia();
$conexion = $con->getConexion();

if ($conexion) {
    // Validamos el usuario y el correo con PDO
    $sql = "SELECT * FROM usuarios WHERE Nombre_Usuario = :usuario AND Correo = :correo";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':usuario', $u_cifrado, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        $_SESSION['error_message'] = 'No hay usuario o correo con esos datos. Por favor, regístrate.';
        header('location: ../pages/login.php');
        exit();
    } else {
        $sql_password = "SELECT * FROM usuarios WHERE Nombre_Usuario = :usuario AND Password = :password AND Correo = :correo";
        $stmt_password = $conexion->prepare($sql_password);
        $stmt_password->bindParam(':usuario', $u_cifrado, PDO::PARAM_STR);
        $stmt_password->bindParam(':password', $p_cifrado, PDO::PARAM_STR);
        $stmt_password->bindParam(':correo', $email, PDO::PARAM_STR);
        $stmt_password->execute();

        if ($stmt_password->rowCount() == 1) {
            $_SESSION['valida'] = true;
            $_SESSION['usuario'] = $usuario;
            header('location: ../pages/panel_principal.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Contraseña incorrecta. Por favor, inténtalo de nuevo.';
            header('location: ../pages/login.php');
            exit();
        }
    }
} else {
    echo "Error en la conexión con la base de datos.";
}
?>
