<?php
$correo = $argv[1];  

//hilo
mail($correo, "Confirmación de registro", "Gracias por registrarte en nuestro sistema.");
?>
