<?php

    /*

        Clase conexión mediante mysqli

    */

    class Conexion {
        // objeto de la clase mysqli
        public $db;

        public function __construct() {

            try {

                $this->db = new mysqli("localhost","root","", "fp");
                if($this->db->connect_errno){
                    throw new Exception('ERROR');
                }

            } catch(Exception $e) {

                echo "ERROR: ". $e->getMessage();
                echo "<BR>";
                echo "CÓDIGO: ". $e->getCode();
                echo "<BR>";
                echo "FICHERO: ". $e->getFile();
                echo "<BR>";
                echo "LÍNEA: ". $e->getLine();
                echo "<BR>";
                exit();

            }
        }
    }

?>