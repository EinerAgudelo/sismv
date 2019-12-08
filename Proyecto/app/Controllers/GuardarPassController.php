<?php 

require_once '../Models/Usuario.php';

$user = new Usuario();

$opcion = $_POST["opcion"];
$idUsuario = $_POST["idUsuario"];
$token = $_POST["token"];
$inputContrasena = $_POST["inputContrasena"];
$inputValidarContrasena = $_POST["inputValidarContrasena"];


/*echo $idUsuario;
echo $inputContrasena;
echo $inputValidarContrasena;*/
if ($opcion == 1) {
	if ($inputContrasena == "" ||
	$inputValidarContrasena == "") {
		echo "error1";
	}else{
		if($inputContrasena == $inputValidarContrasena){
			//echo $idUsuario;
			if ($user->CambiarContrasena($idUsuario, $inputContrasena) == true) {
				echo "Exito";
			}
		}
		else{
			echo "error2";
		}
	}
} elseif ($opcion == 2) {
	if ($inputContrasena == "" ||
	$inputValidarContrasena == "") {
		echo "error1";
	}else{
		if($inputContrasena == $inputValidarContrasena){
			
			if ($user->CambiarContrasena($idUsuario, $inputContrasena) == true) {
				if ($user->ActivarCuenta($idUsuario, $token)) {
				echo "Exito";
				} else{
					echo "error2";
				}
			}
		}
		else{
			echo "error2";
		}
	}
}

 ?>