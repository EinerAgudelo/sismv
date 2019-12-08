<?php 

include "../../config.php";
include_once "../Models/Usuario.php";
include_once "../Models/Session.php";

$userSession = new userSession();
$user = new Usuario();
$userSession->getCurrentUser();


$correo = $userSession->getCurrentUser();


if ($user->rolUser($correo) == true) {
    $rol = 1;

}else{
    $rol = 2;
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio sesion SISMV</title>
	<?php include FOLDER_TEMPLATE . 'head.php';?> 
	<!--====== Javascripts & Jquery ======-->
	<?php include FOLDER_TEMPLATE . 'scripts.php' ?>


<script src="<?= URL_JS?>ActualizarDatos.js"></script>
</head>
<body style="background-color: gray">

	<?php

		include FOLDER_TEMPLATE . 'menu.php'; 
		 ?>


<br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3" >
				<div class="shadow-lg p-3 mb-5 bg-white rounded" style="opacity: .8">

					<center>
						<h2>Bienvenido a <strong><img src="<?=URL_IMG?>logo.svg" alt="" width="40%"></strong> <?php

								$consulta = $user->QueryCorreoToken($correo);
								echo $consulta[0]["nombreUsuario"];
							
						 ?></h2>
						 <br>
						<h4 id="tituloFormularios">Llene los campos para el cambio de contraseña</h4>
						<br>
						<form id="formRestablecimientoPass"> 
						<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $consulta[0]["idUsuario"]; ?>">                           
							<div class="form-group">
								<label>Contraseña</label>
								<div class="input-group">
									<input type="password" class="form-control" id="inputContrasena" name="inputContrasena" 
									placeholder="**********" required>
									<div class="input-group-prepend">
										<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-key icono"></i></div>
									</div>   
								</div>
							</div>
							<div class="form-group">
								<label>Validar contraseña</label>
								<div class="input-group">
									<input type="password" class="form-control" id="inputValidarContrasena" name="inputValidarContrasena" 
									placeholder="**********" required>
									<div class="input-group-prepend">
										<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-key icono"></i></div>
									</div>   
								</div>
							</div>
							<button type="button" class="btn btn-primary" id="btnCambiarContrasena">Guardar</button>				             
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

