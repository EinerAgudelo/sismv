<?php 


require_once '../Models/Usuario.php';
require_once "../Models/Session.php";



$userSession = new userSession();
$user = new Usuario();
$correo = $userSession->getCurrentUser();

if ($consulta = $user->ConsultarMisDatos($correo)) {
	//while($consulta){
		$data["data"][] = $consulta;
	//}
	echo json_encode($data, true);
}else {
	echo "Error al traer sus datos";
}

 ?>