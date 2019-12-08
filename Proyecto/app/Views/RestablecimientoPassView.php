<?php 

include "../../config.php";
include_once "../Models/Usuario.php";
include_once "../Models/Session.php";

$userSession = new userSession();
$user = new Usuario();
$userSession->getCurrentUser();


$sesion = $userSession->getCurrentUser();



if ($user->rolUser($sesion) == true) {
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
	<script src="<?= URL_JS?>index.js"></script>
	
</head>
<body style="background-color: gray">
	
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	<!-- Header section -->
	<header class="header-section">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark site-navbar">
			<a class="navbar-brand site-logo" href="../../index.php">
				<!--h2><span>SI</span>SMV</h2><p>Sistema de informacion para la supervision y medicion de variables</p-->
					<img src="<?=URL_IMG?>logoNav.svg" alt="" width="50%">
				</a>
				<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavId">
				<!-- Main menu -->
				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="https://suomaya.co/">Suomaya</a>
					</li> 
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end-->
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3" >
				<div class="shadow-lg p-3 mb-5 bg-white rounded" style="opacity: .8">

					<center>
						<h3>Bienvenido a <strong><img src="<?=URL_IMG?>logo.svg" alt="" width="40%"></strong> <?php
						//$user = new Usuario();
						
						if (isset($_GET["correoUsuario"])) {
							$correo = $_GET["correoUsuario"];
							if ($correo == "") {
								header("Location: ../../index.php");
							}else{
								$consulta = $user->QueryCorreoToken($correo);
								echo $consulta[0]["nombreUsuario"];
							}
						 ?></h3>
						 <br>

						 <?php 
						 if($consulta[0]["estadoUsuario"] == "activo"){
						 /*}else{
						 	echo "2";
						 }*/?>

						<h4 id="tituloFormularios">Llene los campos para el restablecimiento de su contraseña</h4>
						<br>
						<form id="formRestablecimientoPass"> 

						<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $consulta[0]["idUsuario"]; ?>">
						<input type="hidden" name="token" id="token" value="<?php echo $consulta[0]["token"]; ?>">                            
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
							<button type="button" class="btn btn-primary" id="btnRestablecerContrasena">Guardar</button>				             
						</form> 
						<?php 
						}else{
						?>

						<h2 id="tituloFormularios">Llene los campos para asignar su contraseña
						y activar su cuenta</h2>
						<br>
						<form id="formAsignarPass"> 
						<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $consulta[0]["idUsuario"]; ?>">

						<input type="hidden" name="token" id="token" value="<?php echo $consulta[0]["token"]; ?>">                           
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
							<button type="button" class="btn btn-primary" id="btnAsignarContrasena">Guardar</button>				             
						</form> 
						<?php
						}
					}
					else{
						header("Location: ../../index.php");
					}
					?>					
						<div id="mensaje"></div>
						<a href="../../index.php">Inicio</a>                       
					</center>
				</div>
			</div>
		</div>
	</div>
	
</body>

</html>