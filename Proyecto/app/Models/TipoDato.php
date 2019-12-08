<?php 
require_once 'Conexion.php';

class TipoDato extends Conexion
{
	private $idTipoDato;
	private $nombreTipoDato;

	// ***** Array Tipos de datos ***** //
	private $tiposDatos;


	// ***** Funtions ***** // 
	
	
	public function RegistrarTipoDato($nombre){
		$con = Conexion::conectar();
		$insert = "INSERT INTO tiposdatos VALUES (null, ?)";
		$resultado = $con->prepare($insert);
		
		if ($resultado->execute([$nombre])) {
			return true;
		}else{
			return false;
		}
		$con = null;
	}
	
	public function ConsultarTiposDatos(){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM tiposdatos";
		$resultado = $con->query($consulta);
		$this->tiposDatos = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->tiposDatos);
		$con = null;
	}
	
	public function ConsultarTiposDatosNombre($nombre){
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM tiposdatos WHERE nombreTipoDato = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$nombre]);
		$tipoDato = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $tipoDato;
		$con = null;
	}



}


?>