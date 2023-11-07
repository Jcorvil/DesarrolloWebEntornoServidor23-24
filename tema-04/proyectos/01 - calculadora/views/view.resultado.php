<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <title>Proyecto 4.1 Calculadora POO</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Calculadora POO</legend>


        <form action="calcular.php" method="POST">

            <!-- Valor1 -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Valor 1</label>
                <input type="number" class="form-control" name="valor1" step="0.01" value="<?= $calcular->getValor1()?>" disabled>
            </div>
            <!-- Valor2 -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Valor 2</label>
                <input type="number" class="form-control" name="valor2" step="0.01" placeholder="0" value="<?= $calcular->getValor2()?>" disabled>
            </div>
            <!-- Operación -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Resultado</label>
                <input type="number" class="form-control" name="resultado" step="0.01" placeholder="0" value="<?= $calcular->getResultado()?>" disabled>
            </div>


            <!-- botones de acción -->
            <a type="button" class="btn btn-primary" role="button" href="index.php" >Volver</a>

        </form>



        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>