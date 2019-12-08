<?php 

require_once "../Models/Conexion.php";


$con = Conexion::conectar();
$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios";
$stm = $con->prepare($consulta);
$stm->execute();
while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
	$data["data"][] = $resultado;
}

echo json_encode($data);

$con = null;

?>