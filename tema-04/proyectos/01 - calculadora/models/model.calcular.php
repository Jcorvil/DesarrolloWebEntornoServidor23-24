<?php

/*
    modelo: model.sumar.php
    permite la operación suma
*/

#Cargo valores del formulario

$valor1 = $_POST['valor1'];
$valor2 = $_POST['valor2'];
$operacion = $_POST['operacion'];


#Creo el objeto calculadora
$calcular = new Calculadora($valor1, $valor2, $operacion);

switch ($operacion) {
    case 'sumar':
        $calcular->suma();
        break;
    case 'restar':
        $calcular->resta();
        break;
    case 'multiplicar':
        $calcular->multiplicacion();
        break;
    case 'dividir':
        $calcular->division();
        break;
    case 'potencia':
        $calcular->potencia();
        break;
    default:
        echo 'Operación no válida';
        break;
}

?>