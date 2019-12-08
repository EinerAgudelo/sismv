<?php 

require_once '../Models/Centro.php';
$centro = new Centro();


if (isset($_POST)) {
	$id = $_POST['idCentro'];
	$nombreCentro = $_POST['nombreCentro'];
	$acronimoCentro = $_POST['acronimoCentro'];
	$estadoCentro = $_POST['estadoCentro'];
	if ($centro->ActualizarCentro($id, $nombreCentro, $acronimoCentro, $estadoCentro) == true) {
		echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Centro ";
		echo "actualizado correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
	else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al actualizar el centro";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
}



//echo $resultado;
//echo "Hola ";




?>