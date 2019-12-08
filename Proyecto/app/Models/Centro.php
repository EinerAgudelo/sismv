<?php

require_once 'Conexion.php';

 class Centro extends Conexion
 {
 	private $idCentro;
	private $nombreCentro;
	private $acronimoCentro;
	private $estadoCentro;

	// ***** Array Tipos de datos ***** //
	private $centros;


	// ***** Funtions ***** // 
	
	public function RegistrarCentro($nombreCentro, $acronimoCentro, $estadoCentro){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM centros WHERE nombreCentro = ?";
		$insert = "INSERT INTO centros (nombreCentro, acronimoCentro, estadoCentro) VALUES ( ?, ?, ?)";
		
		$stm = $con->prepare($consulta);
		$stm->execute([$nombreCentro]);
		$resultadoConsulta = $stm->fetch();
		if ($resultadoConsulta >= 1) {
			return false;
		}else{
			$resultado = $con->prepare($insert);

			if ($resultado->execute([$nombreCentro, $acronimoCentro, $estadoCentro])) {
				return true;
			}else{
				return false;
			}
		}
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
	
	public function ConsultarCentroNombre($nombreCentro){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM centros WHERE nombreCentro = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$nombreCentro]);
		$this->centros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		$con = null;
	}

	public function ConsultarCentroId($idCentro){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM centros WHERE idCentro = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idCentro]);
		$this->centros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		$con = null;
	}

	public function ConsultarCentroAcronimo($acronimoCentro){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM centros WHERE acronimoCentro = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$acronimoCentro]);
		$this->centros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		$con = null;
	}

	public function ConsultarCentroEstado($estado){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM centros WHERE estadoCentro = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$estado]);
		$this->centros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		$con = null;
	}

	public function ActualizarCentro($idCentro, $nombreCentro, $acronimoCentro, $estadoCentro)
	{
		$con = Conexion::conectar();
		$update = "UPDATE centros SET nombreCentro = ?, acronimoCentro = ?, estadoCentro = ? WHERE idCentro = ?";
		if ($result = $con->prepare($update)->execute([$nombreCentro, $acronimoCentro, $estadoCentro, $idCentro])) {
			return true;
		}else{
			return false;
		}	
		$con = null;
	}

	public function inhabilitarCentro($idCentro)
	{
		$con = Conexion::conectar();
		$update = "UPDATE centros SET estadoCentro = 2 WHERE idCentro = ?";
		if ($result = $con->prepare($update)->execute([$idCentro])) {
			return true;
		}else{
			return false;
		}	
		$con=null;
	}
 	
 } ?>