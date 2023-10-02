<?php
    /*
    
        Modelo: division.php
        Descripción: Divide los valores del formulario
    
    */

    $valor1 = $_POST('valor1');
    $valor2 = $_POST('valor2');

    $operacion = "Dividir";

    $resultado = $valor1 / $valor2;

?>