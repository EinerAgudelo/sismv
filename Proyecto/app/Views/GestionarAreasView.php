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
header("Location: ".URL_PROYECTO."app/");
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>SISMV | Supervisión y medición de variables</title>
<?php include FOLDER_TEMPLATE . 'head.php';?> 
<!--====== Javascripts & Jquery ======-->
<?php include FOLDER_TEMPLATE . 'scripts.php' ?>
<script  src="<?= URL_JS?>ActualizarDatos.js"></script>
<script  src="<?= URL_JS?>GestionarAreas.js"></script>
</head>
<body>  


<?php include FOLDER_TEMPLATE . 'menu.php' ?>

<br>
<?php include FOLDER_VIEWS . 'ActualizarDatosModal.php' ?>



<!-- ****************************** Modal ****************************** -->


<div class="modal fade" id="ModalUpdateArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Actualizar datos del área</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formUpdateArea" >  

					<div class="form-group">
						<label>ID</label>
						<div class="input-group">
							<input type="text" class="form-control" id="inputIdAreaUpdate" name="inputIdAreaUpdate" disabled>
							<div class="input-group-prepend" >
								<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
							</div> 
						</div>
					</div>
					<div class="form-group">
						<label>Nombre del área</label>
						<div class="input-group">
							<input type="text" class="form-control" id="inputNombreAreaUpdate" name="inputNombreAreaUpdate">
							<div class="input-group-prepend" >
								<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-building"></i></div>
							</div> 
						</div>
					</div>



					<div class="form-row">
						<div class="form-group col-md-6" id="divSelectCentroArea">
							<label>Centro donde se ubica la sede</label>
							<select class="form-control" id="selectCentroArea" >
								
							</select>
						</div>

						<div class="form-group col-md-6" id="divSelectSedeArea">
							<label>Sede donde se ubica el área</label>
							<select class="form-control" id="selectSedeArea">
								
							</select>

						</div>
					</div>

					<div class="form-group">
						<label>Piso donde se ubica el área</label>
						<div class="input-group">
							<input type="text" class="form-control" id="inputPisoAreaUpdate" name="inputPisoAreaUpdate">
							<div class="input-group-prepend" >
								<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-level-up-alt"></i></div>
							</div> 
						</div>
					</div>
					
					<div class="form-group">
						<label>Estado</label>
						<select class="form-control" id="inputEstadoUpdateArea" name="inputEstadoUpdateArea">
							<option value="activo">Activo</option>
							<option value="inactivo" selected>Inactivo</option>
						</select>
					</div>
					<div id="mensajeModal"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">cancelar</button>
						<button type="button" class="btn btn-primary" id="btnUpdateArea" name="btnUpdateArea" >Guardar cambios</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<!-- ****************************** Buttons Collapses ****************************** -->


<div class="container">

	<!-- ****************************** Buttons Collapses Registrar ****************************** -->


	<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#RegistrarArea" aria-expanded="false" aria-controls="RegistrarArea" id="btnFormRegistrarArea">
		Registrar Area
	</button>

	<br>

	<hr>

	<br>

	<!-- ****************************** Buttons Collapses consultar por Nombre ****************************** -->

	<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarNombre" aria-expanded="false" aria-controls="ConsultarNombre" id="bntFormConsultarNombre">
		Consultar por Nombre
	</button>


	<!-- ****************************** Buttons Collapses consultar por centro y sede ****************************** -->


	<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarSede" aria-expanded="false" aria-controls="ConsultarSede" id="bntFormConsultarCentro">
		Consultar por centro y sede
	</button>


	<!-- ****************************** Buttons Collapses consultar por Estado ****************************** -->

	<button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarEstado" aria-expanded="false" aria-controls="ConsultarEstado" id="bntFormConsultarEstado">
		Consultar por Estado
	</button>

	<br>
	<br>
	<button class='btn btn-dark' name='btnConsultarTodos' id="btnConsultarTodos">
		Consultar Todo
	</button>
	<br>
	<hr>

	<!-- ****************************** Collapses ****************************** -->



	<!-- ****************************** Formulario registrar area ****************************** -->


	<div class="collapse show" id="RegistrarArea">
		<div class="card card-body">
			<form id="formRegistrarArea">   

				<div class="form-group">
					<label>Nombre del area</label>
					<div class="input-group">
						<input type="text" class="form-control" id="inputNombreArea" name="inputNombreArea">
						<div class="input-group-prepend" >
							<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-building"></i></div>
						</div> 
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6" id="divSelectCentroAreaRegistro">

					</div>

					<div class="form-group col-md-6" id="divSelectSedeAreaRegistro">


					</div>
				</div>

				<div class="form-group">
					<label>Piso donde se ubica el area</label>
					<div class="input-group">
						<input type="text" class="form-control" id="inputPisoArea" name="inputPisoAreaUpdate">
						<div class="input-group-prepend" >
							<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-level-up-alt"></i></div>
						</div> 
					</div>
				</div>

				<div class="form-group">
					<label>Estado</label>
					<select class="form-control" id="inputEstadoArea" name="inputEstadoUpdateArea">
						<option value=1>Activo</option>
						<option value=2 selected>Inactivo</option>
					</select>
				</div>



				<button type="button" class="btn btn-dark" name="btnRegistrarArea" id="btnRegistrarArea">
					Registrar
				</button>
			</form>
		</div>
	</div>

	<!-- ****************************** Formulario Consultar por Nombre ************************** -->

	<div class="collapse show" id="ConsultarNombre">
		<div class="card card-body">
			<form id="consultarNombreArea">
				<div class="form-group">
					<label>Nombre del area</label>
					<div class="input-group">
						<input type="text" class="form-control" id="inputConsultarNombreArea" name="inputConsultarNombreArea">
						<div class="input-group-prepend" >
							<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
						</div> 
					</div>
					<br>
					<button type="button" class="btn btn-dark" name="btnConsultarNombreArea" id="btnConsultarNombreArea">
						Consultar
					</button>
				</div>
			</form>
		</div>
	</div>



	<!-- ****************************** Formulario Consultar por sede ************************** -->

	<div class="collapse show" id="ConsultarSede">
		<div class="card card-body">
			<form id="consultarSedeArea">
				<div class="form-group">

					<div class="form-row">
						<div class="form-group col-md-6" id="divSelectCentroAreaConsulta">

						</div>

						<div class="form-group col-md-6" id="divSelectSedeAreaConsulta">


						</div>
					</div>

					<br>
					<button type="button" class="btn btn-dark" name="btnConsultarSedeArea" id="btnConsultarSedeArea">
						Consultar
					</button>
				</div>
			</form>
		</div>
	</div>




	<!-- ****************************** Formulario Consultar por Estado ************************** -->



	<div class="collapse show" id="ConsultarEstado">
		<div class="card card-body">
			<form id="formConsultarEstado" >
				<div class="form-group">
					<label>Estado</label>
					<select class="form-control" id="inputConsultarEstado" name="inputConsultarEstado">
						<option value="activo">Activo</option>
						<option value="inactivo" selected>Inactivo</option>
					</select>
				</div>
				<button type="button" class="btn btn-dark" name="btnConsultarEstado" id="btnConsultarEstado">
					Consultar
				</button>
			</form>
		</div>
	</div>


	<!-- ****************************** Alerta ****************************** -->


	<div id="mensajeArea"></div>



	<!-- ****************************** Tabla ****************************** -->


	<div class="table-responsive">        
		<table id="tableArea" class="table table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>ID Area</th>
					<th>Nombre Centro</th>
					<th>Nombre Sede</th>
					<th>Dirección Sede</th>
					<th>Nombre Area</th>
					<th>Piso</th>
					<th>Estado</th>   
					<th>Acciones</th>   
				</tr>
			</thead>
			<tbody id="tbodyArea">

			</tbody>
		</table>
	</div>
</div>


<?php include FOLDER_TEMPLATE . 'footer.php' ?>


</body>
</html>