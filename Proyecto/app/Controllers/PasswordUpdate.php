<?php 

include_once "../Models/Usuario.php";


$usuario = new Usuario();

$user = $_POST["user"];
//echo $user;
$inputConfirmacion = $_POST["inputConfirmacion"];
if ($usuario->userExist($user, $inputConfirmacion) == true) {

	//header("Location: http://localhost/sismv_MVC/Proyecto/app/Views/RestablecimientoPassView.php?correoUsuario=".$user."");
	echo "1";
}else {
	//header("Location: http://localhost/sismv_MVC/Proyecto/app/Views/IndexAlerts.php");
	echo "2";
}


 ?>