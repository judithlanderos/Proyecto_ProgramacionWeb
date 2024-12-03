<?php

class ConexionBDUsuarios {
    private static $instancia = null;  
    private $conexion;
    private $host = "localhost";
    private $usuario = "judith";
    private $password = "judilth@3";
    private $bd = "usuario_bd_escuela";

    private function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->bd";
            $this->conexion = new PDO($dsn, $this->usuario, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión a la BD: " . $e->getMessage());
        }
    }

    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new ConexionBDUsuarios();
        }
        return self::$instancia;
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function validarUsuario($usuario, $password) {
        $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password");
        
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>
