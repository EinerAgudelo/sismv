<?php 


require_once '../Models/Sensor.php';
//header('Content-Type: text/json; charset=utf-8');
$opcion = $_POST["opcion"];
$sensor = new Sensor();
if ($opcion == 1) {
	header('Content-Type: text/json; charset=utf-8');
	$consulta = $sensor->ConsultarSensores();
	echo $consulta;
}
else if ($opcion == 2) {
	header('Content-Type: text/json; charset=utf-8');
	$consulta = $sensor->ConsultarCentros();
	echo $consulta;
}
else if ($opcion == 3) {
	$idCentro = $_POST["idCentro"];
	if ($idCentro == 0) {
		echo "0";
	}
	else{
		header('Content-Type: text/json; charset=utf-8');
		$consulta = $sensor->ConsultarSedes($idCentro);
		echo $consulta;
	}
}
else if ($opcion == 4) {
	$idSede = $_POST["idSede"];
	if ($idSede == 0) {
		echo "0";
	}
	else{
		header('Content-Type: text/json; charset=utf-8');
		$consulta = $sensor->ConsultarAreas($idSede);
		echo $consulta;
	}
}
else if ($opcion == 5) {
	$idArea = $_POST["idArea"];
	$referencia = $_POST["referencia"];
	$estadoSensor = $_POST["estadoSensor"];
	if ($idArea == "" || $idArea == "0" ||
		$referencia == "" ||
		$estadoSensor == "" ||
		$estadoSensor == "0" ) {
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar todos los campos";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
	else{
		if ($sensor->RegistrarSensor($referencia, $estadoSensor, $idArea) == true) {
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Sensor ";
			echo "registrado correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
		else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al registrar el sensor";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
	}
}
else if ($opcion == 6) {
	$idSensor = $_POST['idSensor'];
	header('Content-Type: text/json; charset=utf-8');
	$consulta = $sensor->ConsultarSensoresId($idSensor);
	echo $consulta;
}
else if ($opcion == 7) {
	$idSensor = $_POST['idSensor'];
	$referencia = $_POST['referencia'];
	$estadoSensor = $_POST['estadoSensor'];
	$idArea = $_POST['idArea'];
	$idCentro = $_POST['idCentro'];
	$idSede = $_POST['idSede'];

	if ($idArea == "" || $idArea == 0 || 
		$idSede == "" || $idSede == 0 ||
		$idCentro == "" || $idCentro == 0) {
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe llenar todos los campos para ubicar el sensor";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
	}else{

		if ($referencia == "" ||
			$estadoSensor == "") {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar todos los campos";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}else{
			if ($sensor->ActualizarSensor($idSensor, $referencia, $estadoSensor, $idArea) == true) {

				echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Sensor ";
				echo "actualizado correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
				 echo " <span aria-hidden='true'>&times;</span></button></div>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo 	problemas al actualizar el sensor";
				echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
				echo " <span aria-hidden='true'>&times;</span></button></div>";
			}
		}
	}
} 
else if($opcion == 8) {
	$referencia = $_POST["referencia"];
	if ($referencia == "") {
			echo "error";
	}
	else{
		if ($consulta = $sensor->ConsultarSensoresReferencia($referencia)) {
			header('Content-Type: text/json; charset=utf-8');
			echo $consulta;
		}
		else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>La referencia digitada no existe";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
	}
}
else if ($opcion == 9) {
	$estado = $_POST['estado'];
	if ($estado == 0 || $estado == "") {
		echo "error";
	}else{
		header('Content-Type: text/json; charset=utf-8');
		$consulta = $sensor->ConsultarSensoresEstado($estado);
		echo $consulta;
	}
}
else if ($opcion == 10) {
	$idSensor = $_POST['idSensor'];
	if ($idSensor == 0 || $idSensor == "") {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr> Hubo un problema al inhabilitar el sensor";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
	}else{
		if ($sensor->InhabilitarSensor($idSensor)) {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>El sensor se	inhabilito";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		} else {
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>El sensor se inhabilito";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
	}
}
else if ($opcion == 11) {
	$idCentro = $_POST["idCentro"];
	if ($idCentro == 0 || $idCentro == "") {
		//echo $idCentro;
		echo "error";
	}
	else{
		if ($consulta = $sensor->ConsultarSensoresCentros($idCentro)) {
			header('Content-Type: text/json; charset=utf-8');
			echo $consulta;
		}
		else{
			echo "error";
		}
	}
}
else if ($opcion == 12) {
	$idCentro = $_POST["idCentro"];
	$idSede= $_POST["idSede"];
	if ($idCentro == 0 || $idCentro == "" ||
	$idSede == 0 || $idSede == "") {
		echo "error";
	}
	else{
		//echo $idCentro . "  &  " . $idSedes ;
		if ($consulta = $sensor->ConsultarSensoresSedes($idSede)) {
			header('Content-Type: text/json; charset=utf-8');
			echo $consulta;
		}
		else{
			echo "error";
		}
	}
}

else if ($opcion == 13) {
	$idCentro = $_POST["idCentro"];
	$idSede= $_POST["idSede"];
	$idArea= $_POST["idArea"];
	if ($idCentro == 0 || $idCentro == "" ||
	$idSede == 0 || $idSede == ""||
	$idArea == 0 || $idArea == "") {
		echo "error";
	}
	else{
		//echo $idCentro . "  &  " . $idSedes ;
		if ($consulta = $sensor->ConsultarSensoresAreas($idArea)) {
			header('Content-Type: text/json; charset=utf-8');
			echo $consulta;
		}
		else{
			echo "error";
		}
	}
}

?>