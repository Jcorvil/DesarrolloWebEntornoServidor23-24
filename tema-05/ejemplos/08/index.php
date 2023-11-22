<?php
/*
    Conexión mediante PDO
 */

$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'fp3';

#Conexion

try {
    $dsn = "mysql:host=$server;dbname=$database";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e){
    echo "BASE DE DATOS: ";
    echo "<hr>";
    echo "Mensaje: ". $e->getMessage(). '<br>';
    echo "Código: ". $e->getCode(). '<br>';
    echo "Fichero: ". $e->getFile(). '<br>';
    echo "Línea: ". $e->getLine(). '<br>';
    echo "Trace: ". $e->getTraceAsString(). '<br>';
    exit();

}


?>