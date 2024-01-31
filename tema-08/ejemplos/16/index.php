<?php

$alumnos = [
    [1, "Juan", "Perez García", "2daw", "El bosque"],
    [2, "Pedro", "Romero García", "2daw", "Ubrique"],
    [3, "María", "Romero García", "1daw", "Ubrique"]
];

$alumnos_csv = fopen("csv/alumnos.csv", "ab");

foreach ($alumnos as $alumno) {
    fputcsv($alumnos_csv, $alumno, ";");
}

fclose($alumnos_csv);

echo "Fichero creado con éxito";

?>