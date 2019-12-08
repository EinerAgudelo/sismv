<?php 

require_once '../Models/Sede.php';
$sede = new Sede();


if (isset($_POST)) {
	$idSede = $_POST['idSede'];
	$nombreSede = $_POST['nombreSede'];
	$direccion = $_POST['direccion'];
	$idCentro = $_POST['idCentro'];
	$telefono = $_POST['telefono'];
	$estadoSede = $_POST['estadoSede'];
	if ($sede->ActualizarSede($idSede, $idCentro, $nombreSede, $direccion, $telefono, $estadoSede) == true) {
		echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Sede ";
		echo "actualizada correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
	else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al actualizar la sede";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
}



//echo $resultado;
//echo "Hola ";




?>