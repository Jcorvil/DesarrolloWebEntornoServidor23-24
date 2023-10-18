<?php

include 'libs/crud_funciones.php';
include 'models/model.index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    agregarLibro($libros);
}

?>