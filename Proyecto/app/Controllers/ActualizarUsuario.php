<?php 

require_once '../Models/Usuario.php';

if (isset($_POST["correoUsuario"])) {

	$nombreUsuario = $_POST["nombreUsuario"];
	$tipo_documento = $_POST["tipo_documento"];
	$numero_documento = $_POST["numero_documento"];
	$apellidoUsuario = $_POST["apellidoUsuario"];
	$correoUsuario = $_POST["correoUsuario"];
	$estadoUsuario = $_POST["estadoUsuario"];
	$rol = $_POST["rol"];

	$user = new Usuario();
	
	//echo $correoUsuario;
	//echo $user->inhabilitarUsuario($id);
	if($user->UpdateUser($nombreUsuario, 
		$apellidoUsuario,
		$tipo_documento,
		$numero_documento,
		$correoUsuario,
		$estadoUsuario,
		$rol)){
		echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Usuario ";
		echo "actualizado correctamente <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		 echo " <span aria-hidden='true'>&times;</span></button></div>";;
	}else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Hubo problemas al actualizar el Usuario";
		echo " <button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
		echo " <span aria-hidden='true'>&times;</span></button></div>";
	}
}




 ?>