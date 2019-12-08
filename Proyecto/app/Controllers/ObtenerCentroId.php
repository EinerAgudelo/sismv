<?php 

require_once '../Models/Centro.php';
header('Content-Type: text/json; charset=utf-8');

$centro = new Centro();
$idCentro = $_POST["idCentro"];
$consulta = $centro->ConsultarCentroId($idCentro);
echo $consulta;

//echo $idCentro;

 ?>