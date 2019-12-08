<?php

class Conexion {

    public static function conectar() {
        try {
            $con = new PDO('mysql:host=localhost;dbname=sismv_db', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>