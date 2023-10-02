<?php
    /*
    
        Modelo: potencia.php
        Descripción: muestra el resultado de la potencia de un número
    
    */

    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];

    $operacion = "Potencia";

    $resultado = pow($valor1, $valor2);

?>