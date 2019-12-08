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
	$inputCorreo = $_POST['inputCorreo'];
	if ($array = $user->QueryCorreoToken($inputCorreo)) {
		//echo "hola mundo";
		//$array = $user->queryCorreoToken($inputCorreo);

			$correo = $array[0]["correoUsuario"];

			$idUsuario = $array[0]["idUsuario"];

			$token = $array[0]["token"];

			$nombre = $array[0]["nombreUsuario"] . " " . $array[0]["apellidoUsuario"];
			//echo $nombre." y ".$correo;

			//$url = 'http://'.$_SERVER["SERVER_NAME"].'/sismv_MVC/Proyecto/app/Views/activar.php';
			//<script src='http://localhost/sismv_MVC/Proyecto/assets/js/index.js'></script>   iba en el cuerpo
			$asunto = "Restablecimiento de contraseña - SISMV";

			$url = 'http://'.$_SERVER["SERVER_NAME"].'/sismv_MVC/Proyecto/app/Controllers/RestablecerPassController.php?idUsuario='.$idUsuario.'&token='.$token.'';


			$cuerpo = "<meta charset='utf-8'>
			<div>Bienvenido a SISMV ". $nombre ." <br>
			Para continuar con el proceso de restablecimiento de contraseña debe dar click en el siguiente botón: <br>
			<form><input type='hidden' name='idUsuario' id='idUsuario' value='".$idUsuario."'>
            <input type='hidden' name='token' id='token' value='".$token."'><button type='button' class='btn btn-dark' name='activar' id ='activar'><a href=".$url.">Dale click</a></button></form>
			</div>";


			
			if ($user->enviarEmail($inputCorreo, $nombre, $asunto, $cuerpo)==true) {

				$result = "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Se ha enviado un correo electronico con las instrucciones para el restablecimiento de contraseña de su cuenta<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";		

			}else{
				$result = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Error!</h3><hr>Hubo un problema en el envio<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

			}
	}
	else{
		$result = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Error!</h3><hr>Correo invalido o no registrado a ninguna cuenta<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}
	echo $result;
}
?>