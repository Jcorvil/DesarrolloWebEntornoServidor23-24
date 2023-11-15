<?php
/*
 *  127.0.0.1:3306
 *  Conexión localhost con usuario root a la base de datos fp
 *  conexión mysqlcli_connect()
 *
 *  conexion objeto mysql
 *  array objetos de la clase Alumno
 */

$server = 'localhost';
$user = 'root';
$pass = '';
$bd = 'fp';

$conexion = new mysqli($server, $user, $pass, $bd);

if ($conexion->connect_errno) {
    echo 'ERROR DE CONEXIÓN Nº: ' . $conexion->connect_errno;
    echo "<br>";
    echo 'ERROR DE CONEXIÓN: ' . $conexion->connect_error;
    exit();
}

echo 'Conexión establecida con éxito';

//Creo una variable con el comando SQL
$sql = 'select * from alumnos order by id';

//Objeto de la clase mysql_result
$result = $conexion->query($sql);


echo "<br>";
echo 'Número de registros: ' . $result->num_rows;
echo "<br>";
echo 'Número de columnas: ' . $result->field_count;
echo "<br>";

//Obtengo un array indexado
$alumno = $result->fetch_object();

//Array indexado, el indice se corresponde con el orden
//de cada columna en la tabla de alumnos


while ($alumno = $result->fetch_object()) {
    echo "Nombre: " . $alumno->nombre;
    echo "<br>";
    echo "Apellidos: " . $alumno->apellidos;
    echo "<br>";
    echo "<br>";
}

?>