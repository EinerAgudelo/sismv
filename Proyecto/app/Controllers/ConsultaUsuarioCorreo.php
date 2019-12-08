<?php 
require_once "../Models/Conexion.php";
//header('Content-Type: text/json; charset=utf-8');
$inputCorreo = $_POST['inputCorreo'];

if ($inputCorreo == "") {
	echo "error1";
}else{
$con = Conexion::conectar();
$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE correoUsuario = ?";
$stm = $con->prepare($consulta);
$stm->execute([$inputCorreo]);
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
	$con = null;
}

?>