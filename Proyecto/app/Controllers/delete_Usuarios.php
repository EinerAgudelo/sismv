<?php 


require_once '../Models/Usuario.php';

if (isset($_GET["id"])) {
	$user = new Usuario();
	$id = $_GET["id"];
	//echo $id;
	echo $user->inhabilitarUsuario($id);
}




 ?>