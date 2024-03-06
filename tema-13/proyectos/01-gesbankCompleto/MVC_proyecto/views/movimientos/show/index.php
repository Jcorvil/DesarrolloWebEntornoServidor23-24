<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php") ?>
    <title>
        <?= $this->title ?>
    </title>
</head>

<body>
    <!-- Menú Principal -->
    <?php require_once("template/partials/menuAut.php") ?>
    <br><br><br>

    <!-- Capa principal -->
    <div class="container">

        <!-- header -->
        <?php include 'views/movimientos/partials/header.php' ?>

        <legend>Formulario Mostrar movimiento</legend>

        <!-- Formulario Mostrar movimiento -->
        <form action="<?= URL ?>movimientos/update/<?= $this->id ?>" method="POST">

            <!-- Nº Cuenta -->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Nº Cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?= $this->movimiento->num_cuenta ?>"
                    disabled>
            </div>
            <!-- fecha_hora -->
            <div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha</label>
                <input type="text" class="form-control" name="fecha_hora" value="<?= $this->movimiento->fecha_hora ?>"
                    disabled>
            </div>
            <!-- concepto -->
            <div class="mb-3">
                <label for="concepto" class="form-label">Concepto</label>
                <input type="text" class="form-control" name="concepto" value="<?= $this->movimiento->concepto ?>"
                    disabled>
            </div>
            <!-- tipo -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" name="tipo" value="<?= $this->movimiento->tipo ?>" disabled>
            </div>
            <!-- cantidad -->
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="float" class="form-control" name="cantidad"
                    value="<?= $this->movimiento->cantidad . ' €' ?>" disabled>
            </div>
            <!-- saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">saldo</label>
                <input type="float" class="form-control" name="saldo" value="<?= $this->movimiento->saldo . ' €' ?>"
                    disabled>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>movimientos" role="button">Volver</a>

        </form>

        <br>
        <br>
        <br>

        <!-- Pié del documento -->
        <?php include 'template/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'template/partials/javascript.php' ?>
</body>

</html>