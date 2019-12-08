<?php 

require_once "../Models/Usuario.php";

$user = new Usuario();

$idUsuario = $_GET["idUsuario"];
if ($consulta = $user->queryUsers_Id($idUsuario)) {
	//$consulta = $user->queryUsers_Id($idUsuario);
	$correo = $consulta[0]["correoUsuario"];
	header("Location: http://localhost/sismv_MVC/Proyecto/app/Views/RestablecimientoPassView.php?correoUsuario=".$correo."");
	//echo $correo;
}else {
	//header("Location: http://localhost/sismv_MVC/Proyecto/app/Views/IndexAlerts.php");
	echo "error";
}



 ?>