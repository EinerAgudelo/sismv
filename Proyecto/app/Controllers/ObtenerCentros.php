<?php 

require_once '../Models/Centro.php';
header('Content-Type: text/json; charset=utf-8');

//header('Content-Type: text/json; charset=utf-8');
$centro = new Centro();
$consulta = $centro->ConsultarCentros();
//echo json_encode($consulta);
echo $consulta;

/*
require_once "../Models/Conexion.php";

//header('Content-Type: text/json; charset=utf-8');
$con = Conexion::conectar();
$consulta = "SELECT * FROM centros";
$stm = $con->prepare($consulta);
$stm->execute();
while ($resultado = $stm->fetch(PDO::FETCH_ASSOC)) {
	$data["data"][] = $resultado;
}

echo json_encode($data);
//echo $data;

$con = null;
*/

?>