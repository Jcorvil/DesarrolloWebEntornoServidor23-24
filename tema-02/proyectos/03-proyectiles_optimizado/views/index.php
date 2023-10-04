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

        <legend>Formulario proyectiles</legend>
        <form method="POST" action="calcular.php">

            <!-- Valores -->
            <div class="mb-3">
                <label class="form-label">Velocidad Inicial</label>
                <input type="number" name="valor1" class="form-control" placeholder="0" aria-describedby="helpId"
                    step="0.01">
                <small id="helpId" class="text-muted">Velocidad en m/s</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Ángulo de lanzamiento</label>
                <input type="number" name="valor2" class="form-control" placeholder="0" aria-describedby="helpId"
                    step="0.01">
                <small id="helpId" class="text-muted">Ángulo en grados</small>
            </div>

            <!-- Botones de acción -->

            <div>
                <button type="reset" class="btn btn-secondary">Borrar</button>
                <button type="submit" class="btn btn-primary ">Calcular</button>

            </div>


        </form>

        <!-- Pie del codumento -->
        <?php include 'views/plantilla/footer.html' ?>
    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/plantilla/javascript.html' ?>
</body>

</html>