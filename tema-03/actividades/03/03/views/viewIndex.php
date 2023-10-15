<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <!-- Incluir head -->
    <title>Días de la semana</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calendar-date"></i></i>Días de la semana
            <span class="fs-6"></span>
        </header>

        <legend>Días de la semana</legend>


        <?php

        $diaActual = date('w');
        $diasSemana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        for ($i = 0; $i <= $diaActual; $i++) {
            $diasSemana[$i];
            echo "<br>";
        }

        ?>


        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>