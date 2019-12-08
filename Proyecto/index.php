<?php include "config.php"; ?>
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
      <a class="navbar-brand site-logo" href="index.php">
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
        <div class="shadow-lg p-3 mb-5 bg-white rounded" style="opacity: .7">

          <center>
            <h1>Bienvenidos a <strong><img src="<?=URL_IMG?>logo.svg" alt="" width="40%"></strong></h1>
            <br>


            <!-- *****************  buttons Collapse *****************  -->
            
            <button class="btn btn-primary btn-lg " type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="btnFormLogear">
              Entrar
            </button>
            <button class="btn btn-primary btn-lg " type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" id="btnFormRegistrar">
              Registrarse
            </button>
          </center>
          <br>

          <!-- ***************** Collapse Login *****************  -->
          <div class="collapse show" id="collapseExample">
            <div class="card card-body">
              <form method="post" action="login.php">                            
                <div class="form-group">
                  <label>Correo electronico</label>
                  <div class="input-group">
                    <input type="email" class="form-control" id="inputUsuario" name="inputUsuario" placeholder="ejemplo123@misena.edu.co" required>
                    <div class="input-group-prepend">
                     <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
                   </div> 
                 </div>
               </div>
               <div class="form-group">
                <label>Contraseña</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="**********" required>
                  <div class="input-group-prepend">
                   <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-key icono"></i></div>
                 </div>   

               </div>
             </div>
             <button type="button" class="btn btn-dark" name="btnInicio" id="btnInicio">Iniciar</button>
             <a href="app/Views/RestablecerPassView.php">Olvide mi contraseña</a>
           </form>
         </div>
       </div>


       <!-- ***************** Collapse Register *****************  -->
       <div class="collapse show" id="collapseExample2">
        <div class="card card-body">
          <form id="formRegister" >
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nombres</label>
                <input type="text" class="form-control" id="inputNombre" name="inputNombre" required>
              </div>
              <div class="form-group col-md-6">
                <label>Apellidos</label>
                <input type="text" class="form-control" id="inputApellidos" name="inputApellidos" required>
              </div>
            </div>   

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Tipo de documento</label>
                <select id="inputTipoDocumento" name="inputTipoDocumento" class="form-control" required>
                  <option = value=1>CC</option>
                  <option = value=2>TI</option>
                  <option = value=3>CE</option>
                  <option = value=4>TP</option>
                  <option = value=5>Otro</option>
                </select>
              </div>

              <div class="form-group col-md-8">
                <label>Numero de documento</label>
                <div class="input-group">
                  <input type="number" id="inputNumeroDocumento" name="inputNumeroDocumento" class="form-control" maxlength="5" required>
                  <div class="input-group-prepend">
                   <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                 </div> 
               </div>
             </div> 
           </div>       

           <div class="form-group">
            <label>Correo electronico</label>
            <div class="input-group">
              <input type="email" class="form-control" id="inputCorreo" name="inputCorreo" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
              <div class="input-group-prepend">
               <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
             </div> 
           </div>
         </div>
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
     <button type="button" class="btn btn-dark" name="btnRegistrar" id="btnRegistrar">Registrar</button>
   </form>
 </div>
</div>
<div id="mensaje"></div>



<br>
</div>
</div>
</div>
</div>
</body>

</html>