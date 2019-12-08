<?php 

require_once '../Models/Sede.php';

if (isset($_POST)) {
	//echo "Hola";
	header('Content-Type: text/json; charset=utf-8');
	$centro = new Sede();
	$data = $centro->ConsultarCentros();
	echo $data;
}

 ?>