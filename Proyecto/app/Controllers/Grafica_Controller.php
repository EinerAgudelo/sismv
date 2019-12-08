<?php

//Declaramos que el tipo de informacion devuelta sera JSON
//Declaramos que el tipo de informacion devuelta sera JSON
header('Content-Type: text/json; charset=utf-8');
require_once "../Models/DatosSensor.php";
$opcion = $_GET["opcion"];
if ($opcion == 1) {
	$DatosSensor=new DatosSensor();
	$Datos=$DatosSensor->getDatosHumedad();
	echo $Datos;
}elseif ($opcion == 2) {
	$DatosSensor=new DatosSensor();
	$Datos=$DatosSensor->getDatosAire();
	echo $Datos;
}elseif ($opcion == 3) {
	$DatosSensor=new DatosSensor();
	$Datos=$DatosSensor->getDatosCO2();
	echo $Datos;
}elseif ($opcion == 4) {
	$DatosSensor=new DatosSensor();
	$Datos=$DatosSensor->getDatos();
	echo $Datos;
}
?>