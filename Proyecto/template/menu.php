<!-- Page Preloder -->
<div id="preloder">
	<div class="loader"></div>
</div>

<!-- Header section -->

<header class="header-section">
	<nav class="navbar navbar-expand-md navbar-dark bg-dark site-navbar">
		<a class="navbar-brand site-logo" href="<?= URL_PROYECTO?>app/">
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
							<a class="nav-link" href="<?= URL_PROYECTO?>app/">Inicio</a>
						</li>
						<?php if ($rol == 1) {
							
						?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Gestionar
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?= URL_PROYECTO?>app/Views/GestionarCentrosView.php">Centros</a>
								<a class="dropdown-item" href="<?= URL_PROYECTO?>app/Views/GestionarSedesView.php">Sedes</a>
								<a class="dropdown-item" href="<?= URL_PROYECTO?>app/Views/GestionarAreasView.php">Areas</a>
								<a class="dropdown-item" href="<?= URL_PROYECTO?>app/Views/GestionarSensoresView.php">Sensores</a>
								<a class="dropdown-item" href="<?= URL_PROYECTO?>app/Views/GestionUsuariosView.php">Usuarios</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= URL_PROYECTO?>app/Views/ReportesView.php">Reportes</a>
						</li>
					<?php
					 }elseif ($rol == 2){
					 ?> 
					 	<li class="nav-item">
							<a class="nav-link" href="<?= URL_PROYECTO?>app/Views/ReportesView.php">Sensores</a>
						</li>  
					<?php
					 } 
					 ?>						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php 
							if ($correo == "") {
								header("Location: ../../index.php");
							}else{
								$consulta = $user->QueryCorreoToken($correo);
								echo $consulta[0]["nombreUsuario"];
							} ?>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalActualizarDatos" id="profile">Mis datos</a>
								<a class="dropdown-item" href="<?= URL_PROYECTO?>app/Views/ConfirmacionPassUpdate.php" >Cambiar Contraseña</a>								
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= URL_PROYECTO?>app/Controllers/Logout_Controller.php"><i class="fas fa-power-off"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=URL_IMG?>manualInteractivo.swf"><i class="fas fa-question-circle"></i></a>
						</li>                                                              
					</ul>
				</div>
			</nav>
		</header>
