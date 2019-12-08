<?php

include "../../config.php";
include_once "../Models/Usuario.php";
include_once "../Models/Session.php";

$userSession = new userSession();
$user = new Usuario();
$userSession->getCurrentUser();

if(!isset($_SESSION['user'])){
	header("Location: ".URL_PROYECTO);
}

$correo = $userSession->getCurrentUser();


if ($user->rolUser($correo) == true) {
	$rol = 1;

}else{
	$rol = 2;
	//header("Location: ".URL_PROYECTO."app/");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio sesión SISMV</title>
	<?php include FOLDER_TEMPLATE . 'head.php';?> 
	<!--====== Javascripts & Jquery ======-->
	<?php include FOLDER_TEMPLATE . 'scripts.php' ?>

	<script src="<?= URL_JS?>ActualizarDatos.js"></script>
</head>
<body style="background-color: gray">
	<?php include FOLDER_TEMPLATE . 'menu.php' ?>
	<!-- Header section end-->
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3" >
				<div class="shadow-lg p-3 mb-5 bg-white rounded" style="opacity: .8">

					<center>
						<h2>Confirmación para cambio <br> de contraseña</h2>
						<br>
						<form id="formRestablecimientoPass">                            
							<div class="form-group">
								<label>Ingrese su contraseña actual</label>
								<div class="input-group col-md-6">
									<input type="password" class="form-control" id="inputConfirmacion" name="inputConfirmacion" placeholder="*********" required>
									<div class="input-group-prepend">
										<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
									</div>                     
								</div>
								<input type="hidden" name="user" id="user" value="<?php echo $correo?>">
								<br>
								<button type="button" class="btn btn-dark" name="btnConfirmacion" id="btnConfirmacion">Enviar</button>
							</div>						             
						</form> 					
						<div id="mensaje"></div>
						<a href="../index.php">Inicio</a>                  
					</center>
				</div>
			</div>
		</div>
	</div>
</body>

</html>