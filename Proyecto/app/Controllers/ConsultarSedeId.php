<?php 

require_once '../Models/Sede.php';
header('Content-Type: text/json; charset=utf-8');

$sede = new Sede();
$idSede = $_POST["idSede"];
$consulta = $sede->ConsultarSedeId($idSede);
echo $consulta;

 ?>