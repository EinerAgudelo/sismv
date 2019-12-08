<?php 
require_once 'Conexion.php';

class Sensor extends Conexion
{
	private $idSensor;
	private $referencia;

	// ***** Array Tipos de datos ***** //
	private $sensores;
	private $centros;
	private $sedes;
	private $areas;


	// ***** Funtions ***** // 
	
	public function RegistrarSensor($referencia, $estado, $idArea){
		$con = Conexion::conectar();
		//$consulta = "SELECT * FROM sensores WHERE referencia = ?";
		$insert = "INSERT INTO sensores (referencia, estadoSensor, idArea) VALUES ( ?, ?, ?)";
		
		//$stm = $con->prepare($consulta);
		//$stm->execute([$referencia]);
		//$resultadoConsulta = $stm->fetch();
		//if ($resultadoConsulta >= 1) {
			//return false;
		//}else{
			$resultado = $con->prepare($insert);

			if ($resultado->execute([$referencia, $estado, $idArea])) {
				return true;
			}else{
				return false;
			}
		//}
		$con = null;
	}
	
	public function ConsultarSensores(){
		$con = Conexion::conectar();
		$consulta = "CALL sp_Consulta_Tabla";
		$resultado = $con->query($consulta);
		$this->sensores = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sensores);
		$con = null;
	}

	public function ConsultarCentros()
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idCentro, nombreCentro, acronimoCentro FROM centros WHERE estadoCentro = 1";
		$resultado = $con->query($consulta);
		$this->centros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		$con = null;
	}

	public function ConsultarSedes($idCentro)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idSede, nombreSede, direccion, idCentro FROM sedes WHERE idCentro = ? AND estadoSede = 1";
		$stm = $con->prepare($consulta);
		$stm->execute([$idCentro]);
		$this->sedes = $stm->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}

	public function ConsultarAreas($idSede)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idArea, nombreArea, piso, idSede FROM areas WHERE idSede = ? AND estadoArea = 1";
		$stm = $con->prepare($consulta);
		$stm->execute([$idSede]);
		$this->areas = $stm->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->areas);
		$con = null;
	}
	
	public function ConsultarSensoresReferencia($referencia){
		$con = Conexion::conectar();
		$consulta = "CALL sp_Consulta_Referencia(?)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$referencia]);
		$this->sensores = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sensores);
		//return $this->sensores;
		$con = null;
	}

	public function ConsultarSensoresEstado($estado){
		$con = Conexion::conectar();
		$consulta = "CALL sp_Consulta_Estado_Sensor(?)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$estado]);
		$this->sensores = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sensores);
		//return $this->sensores;
		$con = null;
	}

	public function ConsultarSensoresId($id){
		$con = Conexion::conectar();
		$consulta = "CALL sp_Consulta_Sensor_Id(?)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$id]);
		$this->sensores = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sensores);
		$con = null;
	}

	public function ConsultarSensoresCentros($idCentro){
		$con = Conexion::conectar();
		$consulta = "CALL sp_Consulta_Sensor_Centro(?)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idCentro]);
		$this->sensores = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sensores);
		$con = null;
	}

	public function ConsultarSensoresSedes($idSede){
		$con = Conexion::conectar();
		$consulta = "CALL sp_Consulta_Sensor_Sedes(?)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idSede]);
		$this->sensores = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sensores);
		$con = null;
	}

	public function ConsultarSensoresAreas($idArea){
		$con = Conexion::conectar();
		$consulta = "CALL sp_Consulta_Sensor_Areas(?)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idArea]);
		$this->sensores = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sensores);
		$con = null;
	}



	public function ActualizarSensor($id, $referencia, $estadoSensor, $idArea)
	{
		$con = Conexion::conectar();
		$update = "UPDATE sensores SET referencia = ?, estadoSensor = ?, idArea = ? WHERE idSensor = ?";
		$result = $con->prepare($update);
		if ($result->execute([$referencia, $estadoSensor, $idArea, $id])) {
			return true;
		}else{
			return false;
		}	
		$con = null;
	}

	public function InhabilitarSensor($id)
	{
		$con = Conexion::conectar();
		$update = "UPDATE sensores SET estadoSensor = 2 WHERE idSensor = ?";
		if ($result = $con->prepare($update)->execute([$id])) {
			return true;
		}else{
			return false;
		}	
		$con=null;
	}

}


?>