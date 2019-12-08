<?php
include "../config.php";
include_once "Models/Usuario.php";
include_once "Models/Session.php";
include_once "Models/DatosSensor.php";

$userSession = new userSession();
$user = new Usuario();
$userSession->getCurrentUser();
$correo = $userSession->getCurrentUser();

if (!isset($_SESSION['user'])) {
    header("Location: " . URL_PROYECTO);
}

if ($user->rolUser($correo) == true) {
    $rol = 1;
} else {
    $rol = 2;
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>SISMV | Supervision y medicion de variables</title>
    <?php include FOLDER_TEMPLATE . 'head.php'; ?> 
    <!--====== Javascripts & Jquery ======-->
    <?php include FOLDER_TEMPLATE . 'scripts.php' ?>
    <link rel="stylesheet" href="<?= URL_CSS ?>Chart.min.css"/>
    <script  src="<?= URL_JS ?>IndexAPP.js"></script>
    <script src="<?= URL_JS ?>Chart.min.js"></script>
</head>
<body>
        <!-- Page Preloder 
        <div id="preloder">
                <div class="loader"></div>
            </div>-->
            <!-- Header section -->
            <?php include FOLDER_TEMPLATE . 'menu.php' ?>
            <?php include FOLDER_VIEWS . 'ActualizarDatosModal.php' ?>
            <!-- Header section end-->
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-6">             
                        <canvas id="myChart" width="15" height="8"></canvas>
                    </div>
                    <div class="col-6"> 
                        <canvas id="myChartHumedad" width="15" height="8"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">             
                        <canvas id="myChartAire" width="15" height="8"></canvas>
                    </div>
                    <div class="col-6"> 
                        <canvas id="myChartCO2" width="15" height="8"></canvas>
                    </div>
                </div>
            </div>
            <!-- Hero section end-->

            <!-- Footer section -->
            <?php include FOLDER_TEMPLATE . 'footer.php' ?>
        </body>
        </html>
