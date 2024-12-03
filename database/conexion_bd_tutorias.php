<?php

class ConexionBDTutorias{
    private $conexion;
    private $host = "localhost:3306";
    private $usuario = "judith";
    private $password = "judilth@3";
    private $bd = "Proyecto_Tutorias";

    public function __construct(){
        $this->conexion = mysqli_connect($this->host, $this->usuario, $this->password, $this->bd);

        if(!$this->conexion)
        die("Error en la conexion a la BD" . mysqli_connect_error());
    
    }

    public function getConexion(){
        return $this->conexion;
    }

}

?>