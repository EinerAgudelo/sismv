<?php 

include "../Models/Conexion.php";
include_once "../Models/DatosSensor.php";

    <head>
        <meta charset="UTF-8" />
        <title>Personas</title>
    </head>
    <body>
        <?php
            foreach ($datos as $dato) {
                echo $dato["nombre"]."<br/>";
            }
        ?>
    </body>

?>