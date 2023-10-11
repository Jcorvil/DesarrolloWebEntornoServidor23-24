<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <!-- Incluir head -->
    <title>Mostrar Fecha</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calendar-date"></i></i>Mostrar Fecha
            <span class="fs-6"></span>
        </header>

        <legend>Mostrar Fecha</legend>

        <?php
        $numMes = date('m');

        switch ($numMes) {
            case '01':
                $nombreMes = 'Enero';
                break;
            case '02':
                $nombreMes = 'Febrero';
                break;
            case '03':
                $nombreMes = 'Marzo';
                break;
            case '04':
                $nombreMes = 'Abril';
                break;
            case '05':
                $nombreMes = 'Mayo';
                break;
            case '06':
                $nombreMes = 'Junio';
                break;
            case '07':
                $nombreMes = 'Julio';
                break;
            case '08':
                $nombreMes = 'Agosto';
                break;
            case '09':
                $nombreMes = 'Septiembre';
                break;
            case '10':
                $nombreMes = 'Octubre';
                break;
            case '11':
                $nombreMes = 'Noviembre';
                break;
            case '12':
                $nombreMes = 'Diciembre';
                break;
        }

        echo "Actualmente estamos en el mes de " . $nombreMes;

        ?>


        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>