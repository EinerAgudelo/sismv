<?php 

/*
require_once "../Models/Usuario.php"; 

if (isset($_POST)) {
	$usuario = new Usuario();
	$estado = $_POST["inputEstado"];
	$resultado = $usuario -> queryUsers_estado($estado);
	echo json_encode($resultado);
}*/


require_once "../Models/Conexion.php";
//header('Content-Type: text/json; charset=utf-8');
$inputEstado = $_POST['inputEstado'];
if ($inputEstado == 0 || $inputEstado == "") {
	echo "error1";
}else{
	$con = Conexion::conectar();
	$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE estadoUsuario = ?";
	$stm = $con->prepare($consulta);
	$stm->execute([$inputEstado]);
	//echo $inputEstado;
	//$total = $resultado->fetch(PDO::FETCH_ASSOC);
	$total = 0;

		while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
		$data["data"][] = $resultado;
		$total = $total + 1;
		}
		if($total > 0){
		echo json_encode($data);
	}else {
		echo "error2";
	}
}



//echo "Hola";

$con = null;


?>