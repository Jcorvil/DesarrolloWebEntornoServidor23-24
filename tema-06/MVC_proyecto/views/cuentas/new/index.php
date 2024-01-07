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
    <?php require_once("template/partials/menu.php") ?>
    <br><br><br>

    <!-- Capa principal -->
    <div class="container">

        <!-- header -->
        <?php include 'views/cuentas/partials/header.php' ?>

        <legend>Formulario Nueva Cuenta</legend>

        <!-- Formulario Nueva Cuenta -->
        <form action="<?= URL ?>cuentas/create" method="POST">

            <!-- id -->
            <!-- <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>  -->
            <!-- numero_cuenta -->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Nº de la cuenta</label>
                <input type="text" class="form-control" name="num_cuenta">
            </div>
            <!-- cliente -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <input type="number" class="form-control" name="id_cliente">
            </div>


            <!-- fecha_alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de alta</label>
                <input type="datetime-local" class="form-control" name="fecha_alta">
            </div>
            <!-- fecha_ul_mov -->
            <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha último movimiento</label>
                <input type="datetime-local" class="form-control" name="fecha_ul_mov">
            </div>
            <!-- num_movtos -->
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Nº de movimientos totales</label>
                <input type="text" class="form-control" name="num_movtos">
            </div>
            <!-- saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo">
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

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