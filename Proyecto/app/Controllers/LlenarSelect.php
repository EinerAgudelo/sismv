<?php 


require_once '../Models/Area.php';
$area = new Area();

if (isset($_POST["opcion"])) {
	$opcion = $_POST["opcion"];
	if ($opcion == 1) {
		if ($resultado = $area->LlenarSelectCentros()) {
			//echo "Bien centros";
			header('Content-Type: text/json; charset=utf-8');
			echo $resultado;
		}else{
			echo "Mal centros";
		}
	}elseif ($opcion == 2) {
		$idCentro = $_POST["idCentro"];
		if ($resultado = $area->LlenarSelectSedes($idCentro)) {
			header('Content-Type: text/json; charset=utf-8');
			echo $resultado;
		}else{
			echo "Mal sedes";
		}
	}
}



?>