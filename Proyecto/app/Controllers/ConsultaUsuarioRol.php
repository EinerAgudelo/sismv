<?php 



require_once "../Models/Conexion.php";
//header('Content-Type: text/json; charset=utf-8');
$inputRol = $_POST['inputRol'];
$con = Conexion::conectar();
$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE rol = ?";
$stm = $con->prepare($consulta);
$stm->execute([$inputRol]);
//echo $inputEstado;

while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
	$data["data"][] = $resultado;
}

echo json_encode($data);
//echo "Hola";

$con = null; ?>