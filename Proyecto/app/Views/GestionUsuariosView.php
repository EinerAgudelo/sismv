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
	<script src="<?= URL_JS?>Lista.js"></script>
    <script  src="<?= URL_JS?>ActualizarDatos.js"></script>
</head>
<body>
	<!-- Page Preloder 
	<div id="preloder">
		<div class="loader"></div>
	</div>-->
	<!-- Header section -->
	<?php include FOLDER_TEMPLATE . 'menu.php' ?>
	<!-- Header section end-->
	<!-- Hero section end-->
	<br>



<?php include FOLDER_VIEWS . 'ActualizarDatosModal.php' ?>


  <!-- Modal -->
  <div class="modal fade" id="ModalUpdateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Actualizar datos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="formUpdateUser" >
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nombres</label>
                    <input type="text" class="form-control" id="inputNombreUpdate" name="inputNombreUpdate" >
                </div>
                <div class="form-group col-md-6">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" id="inputApellidosUpdate" name="inputApellidosUpdate" >
                </div>
            </div>   

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Tipo de documento</label>
                    <select id="inputTipoDocumentoUpdate" name="inputTipoDocumentoUpdate" class="form-control" >
                        <option = value=1>CC</option>
                        <option = value=2>TI</option>
                        <option = value=3>CE</option>
                        <option = value=4>TP</option>
                        <option = value=5>Otro</option>
                    </select>
                </div>

                <div class="form-group col-md-8">
                    <label>Número de documento</label>
                    <div class="input-group">
                        <input type="number" id="inputNumeroDocumentoUpdate" name="inputNumeroDocumentoUpdate" class="form-control" >
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                        </div> 
                    </div>
                </div> 
            </div>       

            <div class="form-group">
                <label>Correo electrónico</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="inputCorreoUpdate" name="inputCorreoUpdate" placeholder="ejemplo123@misena.edu.co" onkeyup="validarEmail(this)">
                    <div class="input-group-prepend" disabled>
                        <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select class="form-control" id="inputEstadoUpdate" name="inputEstadoUpdate">
                    <option value=1>Activo</option>
                    <option value=2 selected>Inactivo</option>
                </select>
            </div>
            <div class="form-group">
                <label>Rol / Cargo</label>
                <select class="form-control" id="inputRolUpdate" name="inputRolUpdate">
                    <option value=1>Administrador</option>
                    <option value=2 selected>Usuario cliente</option>
                </select>
            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">cancelar</button>
                        <button type="button" class="btn btn-primary" id="btnUpdateUser" name="btnUpdateUser" data-dismiss="modal">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="container">
      <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#RegistrarUsuarios" aria-expanded="false" aria-controls="RegistrarUsuarios" id="btnFormRegistrarUsers">
       Registrar Usuario
   </button>
   <br>
   <hr>
   <br>

   <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarNombre" aria-expanded="false" aria-controls="ConsultarNombre" id="bntFormConsultarNombre">
       Consultar por Nombre
   </button>

   <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarApellido" aria-expanded="false" aria-controls="ConsultarApellido" id="bntFormConsultarNombre">
       Consultar por Apellido
   </button>

  	<!--button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarDocumento" aria-expanded="false" aria-controls="ConsultarNombre" id="bntFormConsultarNombre">
                Consultar por Documento
            </button-->

            <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarCorreo" aria-expanded="false" aria-controls="ConsultarCorreo" id="bntFormConsultarNombre">
            	Consultar por Correo
            </button>

            <button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarEstado" aria-expanded="false" aria-controls="ConsultarEstado" id="bntFormConsultarNombre">
            	Consultar por Estado
            </button>   
            <button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarRol" aria-expanded="false" aria-controls="ConsultarRol" id="bntFormConsultarRol">
            	Consultar por Rol
            </button>
            <br>
            <br>
            <button class="btn btn-dark " name='btnConsultarTodos' id="btnConsultarTodos">
                Consultar Todo
            </button>
            <br>
            <hr>       

            <div class="collapse show" id="RegistrarUsuarios">
            	<div class="card card-body">
            		<form id="formRegister" >
            			<div class="form-row">
            				<div class="form-group col-md-6">
            					<label>Nombres</label>
            					<input type="text" class="form-control" id="inputNombre" name="inputNombre" >
            				</div>
            				<div class="form-group col-md-6">
            					<label>Apellidos</label>
            					<input type="text" class="form-control" id="inputApellidos" name="inputApellidos" >
            				</div>
            			</div>   

            			<div class="form-row">
            				<div class="form-group col-md-4">
            					<label>Tipo de documento</label>
            					<select id="inputTipoDocumento" name="inputTipoDocumento" class="form-control" >
            						<option = value=1>CC</option>
                                    <option = value=2>TI</option>
                                    <option = value=3>CE</option>
                                    <option = value=4>TP</option>
                                    <option = value=5>Otro</option>
            					</select>
            				</div>

            				<div class="form-group col-md-8">
            					<label>Número de documento</label>
            					<div class="input-group">
            						<input type="number" id="inputNumeroDocumento" name="inputNumeroDocumento" class="form-control" >
            						<div class="input-group-prepend">
            							<div class="input-group-text"><i class="fas fa-id-card"></i></div>
            						</div> 
            					</div>
            				</div> 
            			</div>       

            			<div class="form-group">
            				<label>Correo electrónico</label>
            				<div class="input-group">
            					<input type="email" class="form-control" id="inputCorreo" name="inputCorreo" placeholder="ejemplo123@misena.edu.co" onkeyup="validarEmail(this)">
            					<div class="input-group-prepend">
            						<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
            					</div> 
            				</div>
            			</div> 
            			<div class="form-group">
            				<label>Estado</label>
            				<select class="form-control" id="inputEstado" name="inputEstado">
            					<option value=1>Activo</option>
            					<option value=2 selected>Inactivo</option>
            				</select>
            			</div>
            			<div class="form-group">
            				<label>Rol / Cargo</label>
            				<select class="form-control" id="inputRol" name="inputRol">
            					<option value=1>Administrador</option>
            					<option value=2 selected>Usuario cliente</option>
            				</select>
            			</div>
            			<button type="button" class="btn btn-dark" name="btnRegistrarUsuarios" id="btnRegistrarUsuarios">
            				Registrar
            			</button>
            		</form>
            	</div>
            </div>

            <!-- ////////////////// Consultar Nombre /////////////////////////////////////////////////      -->

            <div class="collapse show" id="ConsultarNombre">
            	<div class="card card-body">
            		<form id="formConsultarNombre" >
            			<div class="form-row">
            				<div class="form-group col-md-6">
            					<label>Nombres</label>
            					<input type="text" class="form-control" id="inputConsultaNombre" name="inputConsultaNombre" >
            				</div>

            			</div>
            			<button type="button" class="btn btn-dark" name="btnConsultarNombre" id="btnConsultarNombre">
            				Consultar
            			</button>
            		</form>
            	</div>
            </div>

            <!-- ////////////////// Consultar Apellido /////////////////////////////////////////////////      -->

            <div class="collapse show" id="ConsultarApellido">
            	<div class="card card-body">
            		<form id="formConsultarApellido" >
            			<div class="form-row">
            				<div class="form-group col-md-6">
            					<label>Apellidos</label>
            					<input type="text" class="form-control" id="inputConsultaApellido" name="inputConsultaApellido" >
            				</div>
            				
            			</div>
            			<button type="button" class="btn btn-dark" name="btnConsultarApellido" id="btnConsultarApellido">
            				Consultar
            			</button>
            		</form>


            	</div>
            </div>


            <!-- ////////////////// Consultar Correo /////////////////////////////////////////////////      -->

            <div class="collapse show" id="ConsultarCorreo">
            	<div class="card card-body">
            		<form id="formConsultarCorreo" >
            			<label>Correo: </label>
            			<div class="form-row">
            				<div class="form-group col-md-6">
            					<input type="email" class="form-control" id="inputConsultaCorreo" placeholder="ejemplo123@misena.edu.co" name="inputConsultaCorreo" onkeyup="validarEmail(this)">
                                <!--span id="emailOK"></span-->
            				</div>
            			</div>
            			<button type="button" class="btn btn-dark" name="btnConsultarCorreo" id="btnConsultarCorreo">Consultar
            			</button>
            		</form>
            	</div>
            </div>



            <!-- ////////////////// Consultar Estado /////////////////////////////////////////////////      -->

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

         <!-- ////////////////// Consultar ROL /////////////////////////////////////////////////      -->

         <div class="collapse show" id="ConsultarRol">
             <div class="card card-body">
              <form id="formConsultarRol" >
               <div class="form-group">
                <label>Rol</label>
                <select class="form-control" id="inputConsultaRol" name="inputConsultaRol">
                 <option value=1>Administrador</option>
                 <option value=2 selected>Cliente</option>
             </select>
         </div>
         <button type="button" class="btn btn-dark" name="btnConsultarRol" id="btnConsultarRol">
            Consultar
        </button>
    </form>
</div>
</div>
<br>

<div id="mensaje"></div>

<br>


<div class="col-lg-12">
    <div class="table-responsive">        
        <table id="tableUser" class="table table-striped">
         <thead class="thead-dark">
          <tr>
           <th>ID</th>
           <th>Tipo de documento</th>
           <th>N° de documento</th>
           <th>Nombres</th>
           <th>Apellidos</th>
           <th>Correo</th>
           <th>Estado</th>
           <th>Rol</th>
           <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="tbodyUsers">

        </tbody>
        </table>
    </div>
</div>
</div>

<?php include FOLDER_TEMPLATE . 'footer.php' ?>



<!--====== Javascripts & Jquery ======-->
	<!--script src="bootstrap/js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/owl.carousel.min.js"></script>
	<script src="bootstrap/js/main.js"></script-->

	</body>
	</html>