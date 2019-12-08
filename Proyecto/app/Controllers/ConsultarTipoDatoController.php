<?php 

require_once '../Models/TipoDato.php';

if (isset($_POST)) {
	//echo "Hola";
	header('Content-Type: text/json; charset=utf-8');
	$tipoDato = new TipoDato();
	$array = $tipoDato->ConsultarTiposDatos();
	echo $array;
}



 ?>