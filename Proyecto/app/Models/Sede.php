<?php

require_once 'Conexion.php';

 class Sede extends Conexion
 {
 	private $idSede;
 	private $idCentro;
	private $nombreSede;
	private $direccion;
	private $telefono;
	private $estadoSede;

	// ***** Array Tipos de datos ***** //
	private $sedes;
	private $centros;


	// ***** Funtions ***** // 
	
	public function RegistrarSede($idCentro, $nombreSede, $direccion, $telefono, $estadoSede){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM sedes WHERE nombreSede = ?";
		$insert = "INSERT INTO sedes (idCentro, nombreSede, direccion, telefono, estadoSede) VALUES ( ?, ?, ?, ?, ?)";
		
		$stm = $con->prepare($consulta);
		$stm->execute([$nombreSede]);
		$resultadoConsulta = $stm->fetch();
		if ($resultadoConsulta >= 1) {
			return false;
		}else{
			$resultado = $con->prepare($insert);

			if ($resultado->execute([$idCentro, $nombreSede, $direccion, $telefono, $estadoSede])) {
				return true;
			}else{
				return false;
			}
		}
		$con = null;
	}
	
	public function ConsultarSede(){
		$con = Conexion::conectar();
		$consulta = "SELECT idSede, nombreSede, sedes.idCentro, centros.nombreCentro, direccion, telefono, estadoSede FROM sedes INNER JOIN centros ON centros.idCentro = sedes.idCentro WHERE idSede != 0";
		$stm = $con->prepare($consulta);
		$stm->execute([]);
		$this->sedes = $stm->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}

	public function ConsultarSedeId($idSede){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM sedes WHERE idSede = ?";
		$stm = $con->prepare($consulta);
		$stm->execute([$idSede]);
		$this->sedes = $stm->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}

	public function ConsultarCentros(){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM centros";
		$stm = $con->prepare($consulta);
		$stm->execute([]);
		//$stm = $con->query($consulta);
		$this->centros = $stm->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		//return $this->centros;
		$con = null;
	}
	
	public function ConsultarSedeNombre($nombreSede){
		$con = Conexion::conectar();
		$consulta = "SELECT idSede, nombreSede, sedes.idCentro, centros.nombreCentro, direccion, telefono, estadoSede FROM sedes INNER JOIN centros ON centros.idCentro = sedes.idCentro WHERE nombreSede = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$nombreSede]);
		$this->sedes = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}

	public function ConsultarSedeDireccion($direccion){
		$con = Conexion::conectar();
		$consulta = "SELECT idSede, nombreSede, sedes.idCentro, centros.nombreCentro, direccion, telefono, estadoSede FROM sedes INNER JOIN centros ON centros.idCentro = sedes.idCentro WHERE direccion = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$direccion]);
		$this->sedes = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}

	/*public function ConsultarSedeCentro($nombreCentro){
		$con = Conexion::conectar();
		$consulta = "SELECT idSede, nombreSede, sedes.idCentro, centros.nombreCentro, direccion, telefono, estadoSede FROM sedes INNER JOIN centros ON centros.idCentro = sedes.idCentro WHERE sedes.idCentro = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$nombreCentro]);
		$this->sedes = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}*/



	public function ConsultarSedeCentroId($idCentro){
		$con = Conexion::conectar();
		$consulta = "SELECT idSede, nombreSede, sedes.idCentro, centros.nombreCentro, direccion, telefono, estadoSede FROM sedes INNER JOIN centros ON centros.idCentro = sedes.idCentro WHERE sedes.idCentro = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idCentro]);
		$this->sedes = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}

	public function ConsultarSedeEstado($estado){
		$con = Conexion::conectar();
		$consulta = "SELECT idSede, nombreSede, sedes.idCentro, centros.nombreCentro, direccion, telefono, estadoSede FROM sedes INNER JOIN centros ON centros.idCentro = sedes.idCentro WHERE estadoSede = ? ";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$estado]);
		$this->centros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		$con = null;
	}

	public function ActualizarSede($idSede, $idCentro, $nombreSede, $direccion, $telefono, $estadoSede)
	{
		$con = Conexion::conectar();
		$update = "UPDATE sedes SET idCentro = ?, nombreSede = ?, direccion = ?, telefono = ?, estadoSede = ? WHERE idSede = ?";
		if ($result = $con->prepare($update)->execute([$idCentro, $nombreSede, $direccion, $telefono, $estadoSede, $idSede])) {
			return true;
		}else{
			return false;
		}	
		$con = null;
	}

	public function inhabilitarSede($idSede)
	{
		$con = Conexion::conectar();
		$update = "UPDATE sedes SET estadoSede = 2 WHERE idSede = ?";
		if ($result = $con->prepare($update)->execute([$idSede])) {
			return true;
		}else{
			return false;
		}	
		$con=null;
	}
 	
 } ?>