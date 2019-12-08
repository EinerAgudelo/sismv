<?php 

require_once '../Models/Sede.php';

if (isset($_POST)) {
	
	header('Content-Type: text/json; charset=utf-8');
	$sede = new Sede();
	$nombreSede = $_POST['nombreSede'];
	if($data = $sede->ConsultarSedeNombre($nombreSede)){
		//echo "Bien";
		//echo json_encode($data);
		echo $data;
	}else{
		echo "Mal";
	}
	
	//echo json_encode($data);
	//echo $data;
}

 ?>