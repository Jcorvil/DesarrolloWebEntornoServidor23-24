<?php
    /*
    *  127.0.0.1:3306
    *  Conexión localhost con usuario root a la base de datos fp
    *  conexión mysqlcli_connect()
    */

    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $bd = 'fp';

    $conexion = mysqli_connect($server, $user, $pass, $bd);

    if (mysqli_connect_errno()) {
        echo 'ERROR DE CONEXIÓN Nº: '. mysqli_connect_errno();
        echo "<br>";
        echo 'ERROR DE CONEXIÓN: '. mysqli_connect_error();
        exit();
    }

    echo 'Conexión establecida con éxito';

?>