<?php

/*
    Clase conexión mediante mysqli
*/

class Conexion
{
    public $db;

    public function __construct()
    {
        try {

            $this->db = new mysqli("localhost", "root", "", "fp");
            if ($this->db->connect_errno) {
                throw new Exception('ERROR');
            }
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<br>";
            echo "CÓDIGO DE ERROR: " . $e->getCode();
            echo "<br>";
            echo "FICHERO: " . $e->getFile();
            echo "<br>";
            echo "LÍNEA: " . $e->getLine();
            echo "<br>";
            exit();
        }
    }

}

?>