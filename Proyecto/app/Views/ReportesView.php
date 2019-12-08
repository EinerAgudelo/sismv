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
  }

  ?>


  
  <!DOCTYPE html>
  <html lang="zxx">
  <head>
  	<title>SISMV | Supervisión y medición de variables</title>
  	<?php include FOLDER_TEMPLATE . 'head.php';?> 
  	<!--====== Javascripts & Jquery ======-->
  	<?php include FOLDER_TEMPLATE . 'scripts.php' ?>
    <script src="<?= URL_JS?>ActualizarDatos.js"></script>
    <script src="<?= URL_JS?>Reportes.js"></script>
    <script src="<?= URL_JS?>moment.js"></script>
    <script src="<?= URL_JS?>bootstrap-datepicker.min.js"></script>
    <script src="<?= URL_JS?>tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=URL_CSS ?>bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?=URL_CSS ?>tempusdominus-bootstrap-4.min.css">
    <script type="text/javascript">
      $(function () {
        $('#datetimepicker7').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('#datetimepicker8').datetimepicker({
          useCurrent: false,
          format: 'YYYY-MM-DD HH:mm:ss'
        });
        $("#datetimepicker7").on("change.datetimepicker", function (e) {
          $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker8").on("change.datetimepicker", function (e) {
          $('#datetimepicker7').datetimepicker('maxDate', e.date);
        });
      });
    </script>
    

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
    <div class="container">

      <form id="formConsultarDatosSensor" >  
        <div class="col-8"> 

          <div class="form-group">
            <label>Tipo de dato / Medición</label>
            <div class="input-group" id="selectTipoDato">

              <div class="input-group-prepend">
                <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
              </div> 
            </div>
          </div>
          <!--div class="container"-->
          
          <div class="form-group">
            <label>Fecha inicio</label>
            <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7" id="inputFechaInicio">
              <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label>Fecha fin</label>
            <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8" id="inputFechaFin">
              <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>

          <!--/div-->
          <button type="button" class="btn btn-dark" name="btnObtenerDatos" id="btnObtenerDatos">
            Consultar
          </button>
        </div>
        <div class="col"><img src=""></div>
      </form>
      <br>

      <div class="col-5">

        <form action="../Controllers/ReporteController.php" method="POST">
          <input type="hidden" name="inputTipoDatoReporte" id="inputTipoDatoReporte">
          <input type="hidden" name="datetimepicker7Reporte" id="datetimepicker7Reporte">
          <input type="hidden" name="datetimepicker8Reporte" id="datetimepicker8Reporte">
          <button type="submit" class="btn btn-dark" name="btnObtenerReporte" id="btnObtenerReporte">
            Generar reporte
          </button>
        </form>
      </div>

      <br>

      <div id="mensajeReporte"></div>

      <br>


  <div class="table-responsive">        
    <table id="tableReport" class="table table-striped table-bordered">
        <thead id="theadDatos" class="thead-dark">
         
        </thead>
        <tbody id="tbodyDatos">

       </tbody>
    </table>
  </div>

 </div>

 <?php include FOLDER_TEMPLATE . 'footer.php' ?>


</body>
</html>