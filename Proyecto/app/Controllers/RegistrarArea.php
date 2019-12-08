<?php 

require_once '../Models/Area.php';
$area = new Area();

$opcion = $_POST["opcion"];
if ($opcion == 1) {
	$idSede = $_POST['idSede'];
	$nombreArea = $_POST['nombreArea'];
	$piso = $_POST['piso'];
	$estadoArea = $_POST['estadoArea'];

	if ($idSede == "" || 
		$nombreArea == "" ||
		$piso == "" ||
		$estadoArea == "" ) {	
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar todos los campos";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
	}else{
		if ($area->RegistrarArea($idSede, $nombreArea, $piso, $estadoArea) == true) {
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Area ";
			echo "registrada correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 	echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
		else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al registrar el area";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
	}
}
elseif ($opcion == 2) {
	$idArea = $_POST['idArea'];
	$idSede = $_POST['idSede'];
	$nombreArea = $_POST['nombreArea'];
	$piso = $_POST['piso'];
	$estadoArea = $_POST['estadoArea'];

	if ($idSede == "" || 
		$nombreArea == "" ||
		$piso == "" ||
		$estadoArea == "" ) {	
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar todos los campos";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
	}else{
		if ($area->ActualizarArea($idArea, $idSede, $nombreArea, $piso, $estadoArea) == true) {
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Area ";
			echo "actualizada correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 	echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
		else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al actualizar el area";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
	}
	
}


 ?>