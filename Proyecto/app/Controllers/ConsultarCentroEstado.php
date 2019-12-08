<?php 

require_once '../Models/Centro.php';
header('Content-Type: text/json; charset=utf-8');

$centro = new Centro();
$estadoCentro = $_POST["estadoCentro"];
$consulta = $centro->ConsultarCentroEstado($estadoCentro);
echo $consulta;

 ?>