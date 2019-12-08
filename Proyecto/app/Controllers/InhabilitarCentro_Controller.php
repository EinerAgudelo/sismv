<?php 

require_once '../Models/Centro.php';
$centro = new Centro();


if (isset($_POST)) {
	$id = $_POST['idCentro'];
	if ($centro->inhabilitarCentro($id) == true) {
		echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Centro ";
		echo "inhabilitado correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
	else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al inhabilitar el centro";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
}



//echo $resultado;
//echo "Hola ";




?>