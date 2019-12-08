<?php 
require_once 'Conexion.php';


class Area extends Conexion
{
	private $idArea;
	private $idSede;
	private $nombreArea;
	private $piso;
	private $estadoArea;

	/**** Array ***/
	private $areas;
	private $sedes;
	private $centros;

	/**** Funciones ****/

	public function RegistrarArea($idSede, $nombreArea, $piso, $estadoArea)
	{
		$con = Conexion::conectar();
		$insert = "INSERT INTO areas (idSede, nombreArea, piso, estadoArea) VALUES (?, ?, ?, ?)";
		$resultado = $con->prepare($insert);
		if($resultado->execute([$idSede, $nombreArea, $piso, $estadoArea])){
			return true;
		}else{
			return false;
		}
		$con = null;
	}

	public function ActualizarArea($idArea, $idSede, $nombreArea, $piso, $estadoArea)
	{
		$con = Conexion::conectar();
		$update = "UPDATE areas SET idSede = ?, nombreArea = ?, piso = ?, estadoArea = ? WHERE idArea = ?";
		$resultado = $con->prepare($update);
		if($resultado->execute([$idSede, $nombreArea, $piso, $estadoArea, $idArea])){
			return true;
		}else{
			return false;
		}
		$con = null;
	}



	public function ConsultarAreas()
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idArea, centros.nombreCentro, sedes.nombreSede, sedes.direccion, nombreArea, piso, estadoArea FROM areas INNER JOIN sedes on sedes.idSede = areas.idSede INNER JOIN centros on centros.idCentro = sedes.idCentro";
		$resultado = $con->query($consulta);
		$this->areas = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->areas);
		$con = null;
	}


	public function ConsultarAreaNombre($nombreArea)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idArea, centros.nombreCentro, sedes.nombreSede, sedes.direccion, nombreArea, piso, estadoArea FROM areas INNER JOIN sedes on sedes.idSede = areas.idSede INNER JOIN centros on centros.idCentro = sedes.idCentro WHERE nombreArea = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$nombreArea]);
		$this->areas = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->areas);
		$con = null;
	}


	public function ConsultarAreaSede($idSede)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idArea, centros.nombreCentro, sedes.nombreSede, sedes.direccion, nombreArea, piso, estadoArea FROM areas INNER JOIN sedes on sedes.idSede = areas.idSede INNER JOIN centros on centros.idCentro = sedes.idCentro WHERE areas.idSede = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idSede]);
		$this->areas = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->areas);
		$con = null;
	}



	public function ConsultarAreaEstado($estadoArea)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idArea, centros.nombreCentro, sedes.nombreSede, sedes.direccion, nombreArea, piso, estadoArea FROM areas INNER JOIN sedes on sedes.idSede = areas.idSede INNER JOIN centros on centros.idCentro = sedes.idCentro WHERE estadoArea = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$estadoArea]);
		$this->areas = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->areas);
		$con = null;
	}




	public function InhabilitarArea($idArea)
	{
		$con = Conexion::conectar();
		$update = "UPDATE areas SET estadoArea = 2 WHERE idArea = ?";
		if ($stm = $con->prepare($update)->execute([$idArea])) {
			return true;
		}
		else{
			return false;
		}
		$con = null;		
	}

	public function ConsultarAreaId($idArea)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idArea, centros.idCentro, centros.nombreCentro, areas.idSede, sedes.nombreSede, sedes.direccion, nombreArea, piso, estadoArea FROM areas INNER JOIN sedes on sedes.idSede = areas.idSede INNER JOIN centros on centros.idCentro = sedes.idCentro WHERE idArea = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idArea]);
		$this->areas = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->areas);
		$con = null;
	}

	public function LlenarSelectCentros()
	{
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM centros";
		$resultado = $con->query($consulta);
		$this->centros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->centros);
		$con = null;
	}

	public function LlenarSelectSedes($idCentro)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM sedes WHERE idCentro = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$idCentro]);
		$this->sedes = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->sedes);
		$con = null;
	}


}


 ?>