<?php include "../../config.php"; ?>
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
						<h1>Bienvenidos a <strong><img src="<?=URL_IMG?>logo.svg" alt="" width="40%"></strong></h1>
						<h2>Restablecimiento de contraseña</h2>
						<br>
						<form id="formRestablecimientoPass">                            
							<div class="form-group">
								<label>Por favor digite el correo electrónico de su cuenta para enviarle las instrucciones y seguir con el proceso de restablecimiento de contraseña</label>
								<div class="input-group">
									<input type="email" class="form-control" id="inputCorreo" name="inputCorreo" placeholder="ejemplo123@misena.edu.co" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
									<div class="input-group-prepend">
										<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
									</div>                     
								</div>
								<br>
								<button type="button" class="btn btn-dark" name="btnRestablecer" id="btnRestablecer">Enviar</button>
							</div>						             
						</form> 					
						<div id="mensaje"></div>
						<a href="../../index.php">Inicio</a>                  
					</center>
				</div>
			</div>
		</div>
	</div>
</body>

</html>