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
	<script src="<?= URL_JS?>Sensores.js"></script>
  <script src="<?= URL_JS?>ActualizarDatos.js"></script>
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
  <div class="modal fade" id="ModalUpdateSensor" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Actualizar datos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formUpdate" >  

            <input type="hidden" id="inputIdSensorUpdate" name="inputIdSensorUpdate">

            <div class="form-row">
              <div class="form-group col-md-6" id="divSelectCentrosUpdate">

                <!--label>Centro</label-->

              </div>
              <div class="form-group col-md-6" id="divSelectSedesUpdate">

                <!--label>Sedes</label-->

              </div>
            </div>

            <div class="form-row">

              <div class="form-group col-md-6" id="divSelectAreaUpdate">

                <!--label>Sedes</label-->

              </div>
            </div>

            <div class="form-group">
              <label>Referencia</label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputReferenciaUpdate" name="inputReferenciaUpdate">
                <div class="input-group-prepend">
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
          </div>
          <div id="mensajeModalUpdateSensor"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">cancelar</button>
            <button type="button" class="btn btn-primary" id="btnUpdateSensor" name="btnUpdateSensor">Guardar cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- ////////////////// Buttons collapses /////////////////////////////////////////////////      -->



  <div class="container">
    <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#RegistrarSensor" aria-expanded="false" aria-controls="RegistrarSensor" id="btnFormRegistrarSensor">
     Registrar Sensor
   </button>
   <br>
   <hr>
   <br>

   <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarReferencia" aria-expanded="false" aria-controls="ConsultarReferencia" id="bntFormConsultarReferencia">
     Consultar por la referencia
   </button>

   <button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarEstado" aria-expanded="false" aria-controls="ConsultarEstado" id="bntFormConsultarEstado">
     Consultar por Estado
   </button>

   <button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarCentros" aria-expanded="false" aria-controls="ConsultarCentros" id="bntFormConsultarCentros">
     Consultar por centro
   </button>

   <button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarSedes" aria-expanded="false" aria-controls="ConsultarSedes" id="bntFormConsultarSedes">
     Consultar por sede
   </button>

   <button class="btn btn-dark " type="button" data-toggle="collapse" data-target="#ConsultarAreas" aria-expanded="false" aria-controls="ConsultarAreas" id="bntFormConsultarAreas">
     Consultar por área
   </button>
   <br>
   <br>
   <button class='btn btn-dark' name='btnConsultarTodos' id="btnConsultarTodos">
     Consultar Todo
   </button>
   <br>
   <hr>       

   <!-- ////////////////// Registrar /////////////////////////////////////////////////      -->


   <div class="collapse show" id="RegistrarSensor">
     <div class="card card-body">
      <form id="formRegistrarSensor" >   

        <div class="form-group">
          <label>Referencia</label>
          <div class="input-group">
            <input type="text" class="form-control" id="inputReferencia" name="inputReferencia">
            <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
            </div> 
          </div>
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select class="form-control" id="inputEstado" name="inputEstado">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
          </select>
        </div>

        <div class="form-group">
          <label>En este formulario debe registrar la ubicación del sensor</label>
        </div>


        <div class="form-row">
          <div class="form-group col-md-6" id="divSelectCentrosRegister">

            <!--label>Centro</label-->

          </div>
          <div class="form-group col-md-6" id="divSelectSedesRegister">

            <!--label>Sedes</label-->

          </div>

          <div class="form-group col-md-6" id="divSelectAreaRegister">

            <!--label>Sedes</label-->

          </div>

        </div>




        <button type="button" class="btn btn-dark" name="btnRegistrarSensor" id="btnRegistrarSensor">
          Registrar
        </button>
      </form>
    </div>
  </div>


  <!-- ////////////////// Consultar Referencia /////////////////////////////////////////////////      -->

  <div class="collapse show" id="ConsultarReferencia">
   <div class="card card-body">
    <form id="formConsultarReferencia" >
     <div class="form-row">
      <div class="form-group col-md-6">
       <label>Referencia</label>
       <input type="text" class="form-control" id="inputConsultaReferencia" name="inputConsultaReferencia" >
     </div>

   </div>
   <button type="button" class="btn btn-dark" name="btnConsultaReferencia" id="btnConsultaReferencia">
    Consultar
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
     <option value="0" selected></option>
     <option value=1>Activo</option>
     <option value=2>Inactivo</option>
   </select>
 </div>
 <button type="button" class="btn btn-dark" name="btnConsultarEstado" id="btnConsultarEstado">
  Consultar
</button>
</form>
</div>
</div>


<!-- ////////////////// Consultar Centro /////////////////////////////////////////////////      -->

<div class="collapse show" id="ConsultarCentros">
 <div class="card card-body">
  <form id="formConsultarCentros" >
   <div class="form-group" id="divSelectCentrosConsulta">

 </div>
 <button type="button" class="btn btn-dark" name="btnConsultarCentro" id="btnConsultarCentro">
  Consultar
</button>
</form>
</div>
</div>

<!-- ////////////////// Consultar Sedes /////////////////////////////////////////////////      -->

<div class="collapse show" id="ConsultarSedes">
 <div class="card card-body">
  <form id="formConsultarSedes" >
   <div class="form-group" >
    <div class="col" id="divSelectSedesConsulta"></div>
    <div class="col" id="divSelectSedesConsultaSedes"></div>
 </div>
 <button type="button" class="btn btn-dark" name="btnConsultarSede" id="btnConsultarSede" disabled>
  Consultar
</button>
</form>
</div>
</div>

<!-- ////////////////// Consultar Area /////////////////////////////////////////////////      -->

<div class="collapse show" id="ConsultarAreas">
 <div class="card card-body">
  <form id="formConsultarAreas" >
   <div class="form-group" >
    <div class="col" id="divSelectAreasConsulta"></div>
    <div class="col" id="divSelectAreasConsultaSedes"></div>
    <div class="col" id="divSelectAreasConsultaAreas"></div>

 </div>
 <button type="button" class="btn btn-dark" name="btnConsultarArea" id="btnConsultarArea" disabled>
  Consultar
</button>
</form>
</div>
</div>




<br>

<div id="mensajeSensor"></div>

<br>

<div class="table-responsive">        
  <table id="tableSen" class="table table-striped table-bordered">
    <thead class="thead-dark">
      <tr>
       <th >Centro de formación</th>
       <th>Sede</th>
       <th>Piso</th>
       <th>Área</th>
       <th>Referencia</th>
       <th>Estado</th>
       <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="tbodySensores">

    </tbody>
  </table>
</div>
</div>

<?php include FOLDER_TEMPLATE . 'footer.php' ?>


</body>
</html>