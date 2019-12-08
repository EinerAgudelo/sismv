<?php
require_once '../Models/Area.php';

if (isset($_POST["idArea"])) {
	$area = new Area();
	$idArea = $_POST["idArea"];
	if($area->InhabilitarArea($idArea)){
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>El area se	inhabilito correctamente";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Error!</h3><hr>Hubo un problema al inhabilitar el registro";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
}

 ?>