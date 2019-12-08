<?php 

require_once '../Models/Sede.php';

if (isset($_POST)) {
	
	header('Content-Type: text/json; charset=utf-8');
	$sede = new Sede();
	$estado = $_POST['estado'];
	if($data = $sede->ConsultarSedeEstado($estado)){
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