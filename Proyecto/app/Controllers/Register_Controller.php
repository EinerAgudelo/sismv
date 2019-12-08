<?php 
require_once '../../config.php';
require_once '../Models/Usuario.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once  URL_MAILER . 'Exception.php';
require_once  URL_MAILER . 'PHPMailer.php';
require_once  URL_MAILER . 'SMTP.php';

if (isset($_POST)) {
	$user = new Usuario();
	$inputNombre = $_POST['inputNombre'];
	$inputApellidos = $_POST['inputApellidos'];
	$inputTipoDocumento = $_POST['inputTipoDocumento'];
	$inputNumeroDocumento = $_POST['inputNumeroDocumento'];
	$inputCorreo = $_POST['inputCorreo'];
	$inputContrasena = $_POST['inputContrasena'];
	$inputValidarContrasena = $_POST['inputValidarContrasena'];


	if ($inputNombre == "" ||
		$inputApellidos == "" ||
		$inputTipoDocumento == "" ||
		$inputNumeroDocumento == "" ||
		$inputCorreo == "" ||
		$inputContrasena == "" ||
		$inputValidarContrasena == "") {

		$result = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Error!</h3><hr>Tiene que llenar todos los campos<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";	
}else{
	if ($inputContrasena == $inputValidarContrasena) {

		if ($user->registro($inputTipoDocumento,
			$inputNumeroDocumento,
			$inputNombre, 
			$inputApellidos, 
			$inputCorreo, 
			$inputValidarContrasena)==true) {

			$array = $user->queryIdToken($inputCorreo);

			$idUsuario = $array[0]["idUsuario"];

			$token = $array[0]["token"];

			$nombre = $inputNombre . " " . $inputApellidos;

			//$url = 'http://'.$_SERVER["SERVER_NAME"].'/sismv_MVC/Proyecto/app/Views/Activar.php?idUsuario='.$idUsuario.'&token='.$token.'';
			//$url = 'http://'.$_SERVER["SERVER_NAME"].'/sismv_MVC/Proyecto/app/Views/Activar.php';
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/sismv_MVC/Proyecto/app/Controllers/ActivarCuentaController.php?idUsuario='.$idUsuario.'&token='.$token.'';	

			$asunto = "Activación de cuenta - SISMV";
			$cuerpo = "<meta charset='utf-8'>
			<div>Bienvenido a SISMV ". $nombre ." <br>
			Para continuar con el proceso de registro debe de activar su cuenta dando click en el siguiente botón: <br>
			<form><input type='hidden' name='idUsuario' id='idUsuario' value='".$idUsuario."'>
            <input type='hidden' name='token' id='token' value='".$token."'><button type='button' class='btn btn-dark' name='activar' id ='activar'><a href=".$url.">Activar cuenta</a></button></form>
			</div>";

			if ($user->enviarEmail($inputCorreo, $nombre, $asunto, $cuerpo)==true) {

				$result = "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Se ha enviado un correo electronico con las instrucciones para la activacion de su cuenta<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";		

			}else{
				$result = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Error!</h3><hr>Hubo un problema en el registro<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

			}		
		}else{
			$result = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Error!</h3><hr>Hubo un problema en el registro<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		}
	}else{
		$result = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Error!</h3><hr>Las contraseñas no coinciden<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}
	echo $result;
}
}
?>