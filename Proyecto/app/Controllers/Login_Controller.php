<?php
include_once '../Models/Usuario.php';
include_once '../Models/Session.php';

//$userSession = new userSession();
$user = new Usuario(); 


if (isset($_POST['inputUsuario'], $_POST['inputPassword']) ) {
	$inputUsuario=$_POST['inputUsuario'];
	$inputPassword=$_POST['inputPassword'];
	if ($_POST['inputUsuario'] == "" || $_POST['inputPassword']=="") {
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe de llenar todos los campos";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
	}elseif($user->estadoUsuario($inputUsuario)==true){
		if($user->userExist($inputUsuario, $inputPassword) == true){
			$userSession = new userSession();
			$userSession->setCurrentUser($inputUsuario);
			echo "1";
		}else{
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Correo y/o contraseña erroneos";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
		}
	}else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Tienes que activar la cuenta";
			echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
}


?>