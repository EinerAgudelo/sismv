<?php 

require_once '../Models/Centro.php';
header('Content-Type: text/json; charset=utf-8');

$centro = new Centro();
$nombreCentro = $_POST["nombreCentro"];
$consulta = $centro->ConsultarCentroNombre($nombreCentro);
echo $consulta;

 ?>