<?php

    /*
    
        Modelo: calcular.php
        Descripción: Realiza todos los cálculos necesarios para el lanzamiento de proyectiles
    
    */

    $velocidad = $_POST['valor1'];
    $angulo = $_POST['valor2'];
    $gravedad = 9.8;

    $anguloRadianes = deg2rad($angulo);
    $velInicialX = $velocidad * cos($anguloRadianes); 
    $velInicialY = $velocidad * sin($anguloRadianes);
    $alcanceMax = (pow($velocidad, 2) * sin(2 * $anguloRadianes) / $gravedad);
    $tiempoVuelo = (2 * ($velInicialY / $gravedad));
    $alturaMax = (pow($velocidad, 2) * pow(sin($anguloRadianes), 2)) / (2 * $gravedad);

?>