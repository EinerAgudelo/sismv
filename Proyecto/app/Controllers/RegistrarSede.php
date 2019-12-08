<?php 

require_once '../Models/Sede.php';
$sede = new Sede();

if (isset($_POST)) {
	$nombreSede = $_POST['nombreSede'];
	$idCentro = $_POST['idCentro'];
	$direccion = $_POST['direccion'];	
	$telefono = $_POST['telefono'];	
	$estadoSede = $_POST['estadoSede'];

	if ($idCentro == "" || $estadoSede == "") {	
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar todos los campos";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
	}else{
		if ($sede->RegistrarSede($idCentro, $nombreSede, $direccion, $telefono, $estadoSede) == true) {
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Sede ";
			echo "registrada correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 	echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
		else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al registrar la sede";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
	}
}

 ?>