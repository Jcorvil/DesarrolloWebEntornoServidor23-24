<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/plantilla/head.html' ?>
    <title>Proyecto 2.2 - Lanzamiento de proyectiles</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- Cabecera Documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff"></i>
            <span class="fs-4">Proyecto 2.2 - Lanzamiento de proyectiles</span>
            <i class="bi bi-rocket-takeoff"></i>
        </header>

        <form>

            <!-- Valores -->
            <table class="table">
                <tbody>
                    <tr>
                        <th>Valores Iniciales:</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Velocidad Inicial:</td>
                        <td>
                            <?= $velocidad ?> m/s
                        </td>
                    </tr>
                    <tr>
                        <td>Ángulo de inclinación:</td>
                        <td>
                            <?= $angulo ?> º
                        </td>
                    </tr>
                    <tr>
                        <th>Resultados:</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Ángulo radianes:</td>
                        <td>
                            <?= $anguloRadianes ?> radianes
                        </td>
                    </tr>
                    <tr>
                        <td>Velocidad inicial X:</td>
                        <td>
                            <?= $velInicialX ?> m/s
                        </td>
                    </tr>
                    <tr>
                        <td>Velocidad inicial Y:</td>
                        <td>
                            <?= $velInicialY ?> m/s
                        </td>
                    </tr>
                    <tr>
                        <td>Alcance Máximo del Proyectil: </td>
                        <td>
                            <?= $alcanceMax ?> m
                        </td>
                    </tr>
                    <tr>
                        <td>Tiempo de Vuelo del proyectil:</td>
                        <td>
                            <?= $tiempoVuelo ?> s
                        </td>
                    </tr>
                    <tr>
                        <td>Altura máxima del proyectil:</td>
                        <td>
                            <?= $alturaMax ?> m
                        </td>
                    </tr>
                </tbody>
            </table>


            <!-- Botones de acción -->

            <div class="btn-group" role="group">
                <a class="btn btn-primary" href="index.php" role="button">Volver</a>
            </div>


        </form>

        <!-- Pie del codumento -->

        <!-- Pie del codumento -->
        <?php include 'views/plantilla/footer.html' ?>
    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/plantilla/javascript.html' ?>
</body>

</html>