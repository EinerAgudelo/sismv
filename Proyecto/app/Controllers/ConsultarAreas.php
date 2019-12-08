<?php 

require_once '../Models/Area.php';

$area = new Area();
if (isset($_POST["idArea"])) {
	$idArea = $_POST["idArea"];
	if ($consulta = $area->ConsultarAreaId($idArea)) {
		header('Content-Type: text/json; charset=utf-8');
		echo $consulta;
	}else{
		echo "Mal";
	}
}elseif (isset($_POST["nombreArea"])) {
	$nombreArea = $_POST["nombreArea"];
	if ($consulta = $area->ConsultarAreaNombre($nombreArea)) {
		header('Content-Type: text/json; charset=utf-8');
		echo $consulta;
	}else{
		echo "Mal";
	}
}elseif (isset($_POST["sedeArea"])) {
	$sedeArea = $_POST["sedeArea"];
	if ($consulta = $area->ConsultarAreaSede($sedeArea)) {
		header('Content-Type: text/json; charset=utf-8');
		echo $consulta;
	}else{
		echo "Mal";
	}
}elseif (isset($_POST["estadoArea"])) {
	$estadoArea = $_POST["estadoArea"];
	if ($consulta = $area->ConsultarAreaEstado($estadoArea)) {
		header('Content-Type: text/json; charset=utf-8');
		echo $consulta;
	}else{
		echo "Mal";
	}
}
else{
	if ($consulta = $area->ConsultarAreas()) {
		header('Content-Type: text/json; charset=utf-8');
		echo $consulta;
	}else {
		echo "Mal";
	}
}
	
	//echo $consulta;





?>