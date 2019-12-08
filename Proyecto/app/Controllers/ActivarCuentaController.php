<?php 
require_once "../Models/Usuario.php";

$user = new Usuario();

$idUsuario = $_GET["idUsuario"];
$token = $_GET["token"];

$mensaje = 0;
if ($user->ActivarCuenta($idUsuario, $token)) {
	$mensaje = 1;
}else {
	$mensaje = 2;
}
include "../Views/Activar.php";
 ?>