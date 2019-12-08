<?php include "../../config.php"; 
?>
<!DOCTYPE html>
<html>
<head>
 <title>Inicio sesion SISMV</title>
 <?php include FOLDER_TEMPLATE . 'head.php';?> 
 <!--====== Javascripts & Jquery ======-->
 <?php include FOLDER_TEMPLATE . 'scripts.php' ?>
 <script src="<?= URL_JS?>ActivarCuenta.js"></script>
</head>
<body style="background-color: gray">
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
  <!-- Header section -->
  <header class="header-section">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark site-navbar">
      <a class="navbar-brand site-logo" href="index.php">
        <!--h2><span>SI</span>SMV</h2><p>Sistema de informacion para la supervision y medicion de variables</p-->
          <img src="<?=URL_IMG?>logoNav.svg" alt="" width="30%">
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
            <h2>Bienvenidos a <strong><img src="<?=URL_IMG?>logo.svg" alt="" width="40%"></strong></h2>
            <br>
            <div id="mensaje"><?php 
            if (isset($mensaje)) {
                if ($mensaje == 1) {
                  ?>
                  <div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3><hr>Se ha activado su cuenta correctamente<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
                  <?php
                }elseif ($mensaje == 2) {
                ?>
                  <div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>¡Error!</h3><hr>Hubo un problema al activar su cuenta<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
                  <?php
               }
             } ?>
            </div>
          </center>
          <br>
          <a href="../../index.php">Volver al inicio</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>