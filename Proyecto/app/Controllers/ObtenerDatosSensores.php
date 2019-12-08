<?php 


require_once '../Models/DatosSensor.php';
header('Content-Type: text/json; charset=utf-8');
if (isset($_POST)) {

	//$tiempoConcurrente = $_POST["tiempoConcurrente"];
	$datosSensor = new DatosSensor();
 	$idTipoDato = $_POST['idTipoDato'];
 	$fechaInicio = $_POST['fechaInicio'];
 	$fechaFin = $_POST['fechaFin'];
	
	$consulta = $datosSensor->ReporteEntreFechas($idTipoDato, $fechaInicio, $fechaFin);
   
 	echo json_encode($consulta);
 	//echo $consulta;
 	//echo $tiempoConcurrente;

 } ?>