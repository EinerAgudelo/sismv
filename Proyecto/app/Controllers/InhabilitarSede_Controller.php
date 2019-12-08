<?php 

require_once '../Models/Sede.php';
$sede = new Sede();


if (isset($_POST)) {
	$idSede = $_POST['idSede'];
	if ($sede->inhabilitarSede($idSede) == true) {
		echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Sede ";
		echo "inhabilitada correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
	else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al inhabilitar la sede";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
}



//echo $resultado;
//echo "Hola ";




?>