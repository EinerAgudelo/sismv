<?php 

require_once '../Models/Centro.php';
header('Content-Type: text/json; charset=utf-8');

$centro = new Centro();
$acronimoCentro = $_POST["inputConsultaAcronimo"];
$consulta = $centro->ConsultarCentroAcronimo($acronimoCentro);
echo $consulta;
 ?>