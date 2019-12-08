<?php

require_once 'Conexion.php';

class DatosSensor extends Conexion {

//    private $idDatosSensor;
//    private $idSensor;
//    private $idTipoDato;
//    private $dato;
//    private $fecha;
    // ***** Array Tipos de datos ***** //
    private $datos;
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
        $this->datos = array();
    }

    // ***** Funtions ***** // 
    public function getDatos() {
        $con = Conexion::conectar();
        //$consulta = "SELECT * FROM SISMV_DB.DATOSSENSOR WHERE IDDATOSSENSOR<=10";
        $consulta = "SELECT * FROM datossensor WHERE idTipoDato = 1 ORDER BY idDatosSensor DESC LIMIT 6";
        $stm = $con->prepare($consulta);
        $stm->execute();

        while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
            $datos["DatosSensor"][] = $resultado;
        }
        //echo json_encode($datos);
        return json_encode($datos);
    }

    public function getDatosHumedad() {
        $con = Conexion::conectar();
        //$consulta = "SELECT * FROM SISMV_DB.DATOSSENSOR WHERE IDDATOSSENSOR<=10";
        $consulta = "SELECT * FROM datossensor WHERE idTipoDato = 2 ORDER BY idDatosSensor DESC LIMIT 6";
        $stm = $con->prepare($consulta);
        $stm->execute();

        while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
            $datos["DatosSensor"][] = $resultado;
        }
        //echo json_encode($datos);
        return json_encode($datos);
    }

    public function getDatosAire() {
        $con = Conexion::conectar();
        //$consulta = "SELECT * FROM SISMV_DB.DATOSSENSOR WHERE IDDATOSSENSOR<=10";
        $consulta = "SELECT * FROM datossensor WHERE idTipoDato = 3 ORDER BY idDatosSensor DESC LIMIT 6";
        $stm = $con->prepare($consulta);
        $stm->execute();

        while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
            $datos["DatosSensor"][] = $resultado;
        }
        //echo json_encode($datos);
        return json_encode($datos);
    }

    public function getDatosCO2() {
        $con = Conexion::conectar();
        //$consulta = "SELECT * FROM SISMV_DB.DATOSSENSOR WHERE IDDATOSSENSOR<=10";
        $consulta = "SELECT * FROM datossensor WHERE idTipoDato = 4 ORDER BY idDatosSensor DESC LIMIT 6";
        $stm = $con->prepare($consulta);
        $stm->execute();

        while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
            $datos["DatosSensor"][] = $resultado;
        }
        //echo json_encode($datos);
        return json_encode($datos);
    }
    

    public function ConsultarDatosSensor($idSensor) {
        $con = Conexion::conectar();
        $consulta = "SELECT * FROM datossensor WHERE idSensor = ?";
        $resultado = $con->prepare($consulta);
        $resultado->execute([$idSensor]);
        $this->datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $this->datos;
        $con = null;
    }

    public function ConsultarDatosTipo($tipoDato) {
        $con = Conexion::conectar();
        $consulta = "SELECT * FROM datossensor WHERE idTipoDato = ?";
        $resultado = $con->prepare($consulta);
        $resultado->execute([$tipoDato]);
        $sensor = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $sensor;
        $con = null;
    }


    public function ReporteEntreFechas($idTipoDato, $fechaInicio, $fechaFin)
    {
        $con = Conexion::conectar();
        //$consulta = "SELECT idSensor, dato, tiposdatos.nombreTipoDato, fecha FROM datossensor INNER JOIN tiposdatos ON datossensor.idTipoDato = tiposdatos.idTipoDato WHERE tiposdatos.idTipoDato = ? AND datossensor.fecha BETWEEN ? AND ?";

        $consulta = "SELECT datossensor.idSensor, sensores.referencia, dato, tiposdatos.nombreTipoDato, fecha FROM datossensor INNER JOIN sensores on sensores.idSensor = datossensor.idSensor INNER JOIN tiposdatos ON datossensor.idTipoDato = tiposdatos.idTipoDato WHERE tiposdatos.idTipoDato = ? AND datossensor.fecha BETWEEN ? AND ?";
        $stm = $con->prepare($consulta);
        $stm->execute([$idTipoDato, $fechaInicio, $fechaFin]);
        $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
       // return json_encode($resultado);
        $con = null;
    }

}

?>