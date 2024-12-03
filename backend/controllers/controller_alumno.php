<?php

include('../../database/conexion_bd_tutorias.php');

class AlumnoDAO {

    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionBDTutorias();
    }

    // ======================== MÉTODOS ABCC (CRUD) ========================

    // ------------------ MÉTODO DE ALTAS ------------------
    public function agregarAlumno($numControl, $nombre, $apellidoP, $apellidoM, $fecha_nacimiento, $telefono, $email, $Carrera_carrera_id) {
        $sql = "INSERT INTO alumnos (numControl, nombre, apellidoP, apellidoM, fecha_nacimiento, telefono, email, Carrera_carrera_id) 
                VALUES ('$numControl', '$nombre', '$apellidoP', '$apellidoM', '$fecha_nacimiento', '$telefono', '$email', '$Carrera_carrera_id')";
        $res = mysqli_query($this->conexion->getConexion(), $sql);

        if (!$res) {
            echo "Error al ejecutar la consulta: " . mysqli_error($this->conexion->getConexion());
        }

        return $res;
    }
    public function existeAlumno($numControl) {
        $sql = "SELECT COUNT(*) as total FROM alumnos WHERE numControl = '$numControl'";
        $res = mysqli_query($this->conexion->getConexion(), $sql);
    
        if (!$res) {
            echo "Error al ejecutar la consulta: " . mysqli_error($this->conexion->getConexion());
            return false;
        }
    
        $row = mysqli_fetch_assoc($res);
        return $row['total'] > 0; 
    }
    

    // ------------------ MÉTODO DE BAJAS ------------------
    public function registrarBaja($numControl) {
        $conexion = $this->conexion->getConexion();

        // Iniciar transacción
        $this->iniciarTransaccion();

        $sql = "SELECT numControl, nombre, apellidoP, apellidoM, 'Baja solicitada'
                FROM listado_alumnos_carreras
                WHERE numControl = '$numControl'";
        
        $res = mysqli_query($conexion, $sql);
        if (!$res || mysqli_num_rows($res) == 0) {
            die("No se encontraron datos para el numControl: $numControl");
        }
    
        $sql_insertar = "INSERT INTO historial_bajas (numControl, nombre, apellidoP, apellidoM, motivo)
                         SELECT numControl, nombre, apellidoP, apellidoM, 'Baja solicitada'
                         FROM listado_alumnos_carreras
                         WHERE numControl = '$numControl'";
        
        $res_insertar = mysqli_query($conexion, $sql_insertar);
        
        if (!$res_insertar) {
            mysqli_rollback($conexion);  // Revertir cambios si hay error
            die("Error al insertar en historial_bajas: " . mysqli_error($conexion));
        }
    
        // Eliminar alumno
        $sql_eliminar = "DELETE FROM alumnos WHERE numControl = '$numControl'";
        $res_eliminar = mysqli_query($conexion, $sql_eliminar);
        
        if (!$res_eliminar) {
            mysqli_rollback($conexion);  
            die("Error al eliminar el alumno: " . mysqli_error($conexion));
        }
    
        $this->confirmarTransaccion();
        return true; 
    }
    
    public function eliminarAlumno($numControl) {
        $sql = "DELETE FROM alumnos WHERE numControl = '$numControl'";
        $res = mysqli_query($this->conexion->getConexion(), $sql);

        if (!$res) {
            echo "Error al ejecutar la consulta: " . mysqli_error($this->conexion->getConexion());
        }

        return $res;
    }

    // ------------------ MÉTODO DE CAMBIOS ------------------
    public function modificarAlumno($numControl, $nombre, $apellidoP, $apellidoM, $fecha_nacimiento, $telefono, $email, $Carrera_carrera_id) {
        $sql = "UPDATE alumnos 
                SET nombre = '$nombre', 
                    apellidoP = '$apellidoP', 
                    apellidoM = '$apellidoM', 
                    fecha_nacimiento = '$fecha_nacimiento', 
                    telefono = '$telefono', 
                    email = '$email', 
                    Carrera_carrera_id = '$Carrera_carrera_id'
                WHERE numControl = '$numControl'";
    
        $res = mysqli_query($this->conexion->getConexion(), $sql);
    
        if (!$res) {
            echo "Error al ejecutar la consulta: " . mysqli_error($this->conexion->getConexion());
        }
    
        return $res;
    }    
    public function obtenerTodosLosAlumnos() {
        $sql = "SELECT * FROM alumnos";
        return mysqli_query($this->conexion->getConexion(), $sql);
    }

    
    // ------------------ MÉTODO DE CONSULTAS ------------------
    public function mostrarAlumnos() {
        $sql = "SELECT * FROM alumnos";
        $res = mysqli_query($this->conexion->getConexion(), $sql);

        if (!$res) {
            echo "Error al ejecutar la consulta: " . mysqli_error($this->conexion->getConexion());
        }

        return $res;
    }

    public function obtenerAlumnoPorNumControl($numControl) {
        $sql = "SELECT * FROM alumnos WHERE numControl = '$numControl'";
        $res = mysqli_query($this->conexion->getConexion(), $sql);

        if (!$res) {
            echo "Error al ejecutar la consulta: " . mysqli_error($this->conexion->getConexion());
        }

        return mysqli_fetch_assoc($res);
    }
    public function infoAlumnos() {
        $conexion = $this->conexion->getConexion();
        $consulta = "SELECT * FROM alumnos";
        $resultado = mysqli_query($conexion, $consulta);
    
        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($conexion));
        }
    
        return $resultado;
    }
    // ------------------ MÉTODOS DE TRANSACTORES ------------------
    public function iniciarTransaccion() {
        $conexion = $this->conexion->getConexion();
        mysqli_begin_transaction($conexion);
    }

    public function confirmarTransaccion() {
        $conexion = $this->conexion->getConexion();
        mysqli_commit($conexion);
    }

}

?>
