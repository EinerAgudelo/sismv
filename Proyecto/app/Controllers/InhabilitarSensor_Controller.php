<?php 
require_once '../Models/Sensor.php';

if (isset($_POST["idSensor"])) {
	$sensor = new Sensor();
	$idSensor = $_POST["idSensor"];
	//echo $idSensor;
	if($sensor->inhabilitarSensor($idSensor)){
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>El sensor se	inhabilito";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
} ?>