<!DOCTYPE html>

<head>
    <h1>Información del alumno</h1>
</head>

<body>

    <?php
        $nombre = "Jorge";
        $apellidos = " Coronil Villalba";
        $poblacion = "Ubrique";
        $edad = "26";
        $ciclo = "2ºDAW";
        $curso = "23/24";
        $modulo = "DWES";
    ?>
    <table border="2">
        <tr>
            <td><b>Campo</b></td>
            <td><b>Valor</b></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $nombre?></td>
        </tr>
        <tr>
            <td>Apellidos</td>
            <td><?php echo $apellidos?></td>
        </tr>
        <tr>
            <td>Población</td>
            <td><?php echo $poblacion?></td>
        </tr>
        <tr>
            <td>Edad</td>
            <td><?php echo $edad?></td>
        </tr>
        <tr>
            <td>Ciclo</td>
            <td><?php echo $ciclo?></td>
        </tr>
        <tr>
            <td>Curso</td>
            <td><?php echo $curso?></td>
        </tr>
        <tr>
            <td>Módulo</td>
            <td><?php echo $modulo?></td>
        </tr>
    </table>

</body>

</html>