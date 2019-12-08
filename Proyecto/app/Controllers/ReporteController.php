<?php 
include "../../config.php";
require_once('../../assets/tcpdf/tcpdf.php');
require_once '../Models/DatosSensor.php';

/*// Aumentar el límite de memoria
define('WP_MEMORY_LIMIT', '512M');
 
// Aumentar el límite de memoria en la administración
define( 'WP_MAX_MEMORY_LIMIT', '256M' );*/
if(isset($_POST["btnObtenerReporte"])){

    if ($_POST['inputTipoDatoReporte'] == "" ||
        $_POST['datetimepicker7Reporte'] == "" ||
        $_POST['datetimepicker8Reporte'] == "" ) {
        header("Location: ../Views/ReportesView.php");
}else{

    $datosSensor = new DatosSensor();
    $idTipoDato = $_POST['inputTipoDatoReporte'];
    $fechaInicio = $_POST['datetimepicker7Reporte'];
    $fechaFin = $_POST['datetimepicker8Reporte'];

   /*$fechaConcurrente = $_SERVER["REQUEST_TIME"];
    if ( $fechaInicio >= $fechaConcurrente ||
        $fechaFin >= $fechaConcurrente ) {
        echo "Las fechas deben ser menores a la fecha concurrente";
    }else{*/

        if ($consulta = $datosSensor->ReporteEntreFechas($idTipoDato, $fechaInicio, $fechaFin)) {
            ob_start();
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

            error_reporting(E_ALL & ~E_NOTICE);
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Einer Julian Agudelo Acosta');
            $pdf->SetTitle('Datos Sensor');

            $pdf->setPrintHeader(false); 
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(15, 15, 15, false); 
            $pdf->SetAutoPageBreak(true, 20); 
            $pdf->SetFont('Helvetica', '', 10);
            $pdf->addPage();

            $content = '';

            $content .= '    
            <div class="row">
            <div class="col-md-12">
            <div>
            <img src="'.URL_IMG.'logo.png" width="150px">     
            </div>
            <h1 style="text-align:center;">Datos Sensor</h1>
            <br>
            <p>A continuación puede evidenciar los datos obtenidos de las fechas que usted solicitó de dicho sensor las cuales son desde '.$fechaInicio.' hasta '. $fechaFin.' en la cual termina, con sus respectivas variables recolectadas en sus distintas fechas y horas: </p>

            <table border="1" cellpadding="5" border-radius="10px">
            <thead class="thead-dark">
            <tr>
            <th class="col">IdSensor / Referencia</th>
            <th class="col">Medición</th>
            <th class="col">Tipo de dato</th>
            <th class="col">Fecha</th>

            </tr>
            </thead>
            ';

            $content .= '
            <tbody id="tbodyDatos">';


            foreach ($consulta as $row) {
                $content .= '<tr>
                <td class="col">'.$row['idSensor'].' / '.$row['referencia'].'</td>
                <td class="col">'.$row['dato'].'</td>
                <td class="col">'.$row['nombreTipoDato'].'</td>
                <td class="col">'.$row['fecha'].'</td>
                </tr>';
            }


            $content .='</tbody>';

            $content .= '</table>';

            $content .= '    
            <hr>
            <footer class="footer-section">
            <div class="container">
            <div class="row">
            <div class="col-lg-4 col-sm-8">        
            <div class="col">
            <p>Este sistema fue desarrollado para supervisar y monitorear variables tales como <br> temperatura, humedad, calidad de aire, dióxido de carbono entre otras.</p>    
            </div>
            </div>    
            </div>
            </div>
            </footer>
            <div class="row padding">
            <div class="col-md-12" style="text-align:center;">
            <span>Pdf Creator </span><a >By SISMV</a>
            </div>
            </div>
            '    
            ;

            $pdf->writeHTML($content, true, 0, true, 0);

            $pdf->lastPage();
            ob_clean();
            $pdf->output('Reporte.pdf', 'I');
        }
        else {
            echo "Error al generar el reporte";
        }    
    }
}

?>