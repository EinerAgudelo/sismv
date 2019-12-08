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
  <script  src="<?= URL_JS?>GestionarCentros.js"></script>
</head>
<body>  


	<?php include FOLDER_TEMPLATE . 'menu.php' ?>

	<br>
  <?php include FOLDER_VIEWS . 'ActualizarDatosModal.php' ?>





  <!-- Modal -->
  <div class="modal fade" id="ModalUpdateCentro" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Actualizar datos del centro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formUpdate" >  

            <div class="form-group">
              <label>ID</label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputIdCentroUpdate" name="inputIdCentroUpdate" disabled>
                <div class="input-group-prepend" >
                  <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
                </div> 
              </div>
            </div>
            <div class="form-group">
              <label>Nombre del centro de formación </label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputNombreUpdate" name="inputNombreUpdate">
                <div class="input-group-prepend">
                  <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-building"></i></div>
                </div> 
              </div>
            </div>

            <div class="form-group">
              <label>Acrónimo</label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputAcronimoUpdate" name="inputAcronimoUpdate">
                <div class="input-group-prepend">
                  <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
                </div> 
              </div>
            </div>


            <div class="form-group">
              <label>Estado</label>
              <select class="form-control" id="inputEstadoUpdate" name="inputEstadoUpdate">
                <option value="activo">Activo</option>
                <option value="inactivo" selected>Inactivo</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">cancelar</button>
              <button type="button" class="btn btn-primary" id="btnUpdateCentro" name="btnUpdateCentro" data-dismiss="modal">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>







    <div class="container">
      <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#RegistrarCentro" aria-expanded="false" aria-controls="RegistrarCentro" id="btnFormRegistrarCentro">
       Registrar Centro
     </button>

     <br>

     <hr>

     <br>

     <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarNombre" aria-expanded="false" aria-controls="ConsultarNombre" id="bntFormConsultarNombre">
       Consultar por Nombre
     </button>


     <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#ConsultarAcronimo" aria-expanded="false" aria-controls="ConsultarAcronimo" id="bntFormConsultarAcronimo">
       Consultar por acrónimo
     </button>


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

     <!-- ////////////////// Registro de centro /////////////////////////////////////////////////      -->      

     <div class="collapse show" id="RegistrarCentro">
       <div class="card card-body">
        <form id="formRegistrarCentro" >   

            <div class="form-group">
              <label>Nombre del centro de formación </label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputNombre" name="inputNombre">
                <div class="input-group-prepend">
                  <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-building"></i></div>
                </div> 
              </div>
            </div>

            <div class="form-group">
              <label>Acrónimo</label>
              <div class="input-group">
                <input type="text" class="form-control" id="inputAcronimo" name="inputAcronimo">
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

          <button type="button" class="btn btn-dark" name="btnRegistrarCentro" id="btnRegistrarCentro">
            Registrar
          </button>
        </form>
      </div>
    </div>


    <!-- ////////////////// Consultar Nombre   /////////////////////////////////////////////////      -->

    <div class="collapse show" id="ConsultarNombre">
     <div class="card card-body">
      <form id="formConsultarReferencia" >
       <div class="form-row">
        <div class="form-group col-md-6">
         <label>Nombre del centro de formación</label>
         <input type="text" class="form-control" id="inputConsultaNombre" name="inputConsultaNombre" >
       </div>

     </div>
     <button type="button" class="btn btn-dark" name="btnConsultaNombre" id="btnConsultaNombre">
      Consultar
    </button>
  </form>
</div>
</div>


<!-- ////////////////// Consultar Acronimo /////////////////////////////////////////////////      -->

    <div class="collapse show" id="ConsultarAcronimo">
     <div class="card card-body">
      <form id="formConsultarReferencia" >
       <div class="form-row">
        <div class="form-group col-md-6">
         <label>Acrónimo del centro de formación</label>
         <input type="text" class="form-control" id="inputConsultaAcronimo" name="inputConsultaAcronimo" >
       </div>

     </div>
     <button type="button" class="btn btn-dark" name="btnConsultaAcronimo" id="btnConsultaAcronimo">
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


<br>

<div id="mensajeCentro"></div>

<br>


<div class="table-responsive">        
  <table id="tableCen" class="table table-striped table-bordered">
   <thead class="thead-dark">
    <tr>
     <th>ID</th>
     <th>Nombre</th>
     <th>Acrónimo</th>
     <th>Estado</th>
     <th>Acciones</th>
   </tr>
  </thead>
  <tbody id="tbodyCentro">

  </tbody>
  </table>
</div>

</div>

<?php include FOLDER_TEMPLATE . 'footer.php' ?>


</body>
</html>