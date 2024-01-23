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

        <legend>Formulario Mostrar cuenta</legend>

        <!-- Formulario Mostrar cuenta -->
        <form action="<?= URL ?>cuentas/update/<?= $this->id ?>" method="POST">

            <!-- id oculto -->
            <input type="number" class="form-control" name="id" value="<?= $this->cuenta->id ?>" disabled>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Nº de la cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?= $this->cuenta->num_cuenta ?>"
                    disabled>
            </div>
            <!-- id_cliente -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Id cliente</label>
                <input type="text" class="form-control" name="id_cliente" value="<?= $this->cuenta->id_cliente ?>"
                    disabled>
            </div>
            <!-- fecha_alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de alta</label>
                <input type="datetime-local" class="form-control" name="fecha_alta"
                    value="<?= $this->cuenta->fecha_alta ?>" disabled>
            </div>
            <!-- fecha_ul_mov -->
            <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha último movimiento</label>
                <input type="datetime-local" class="form-control" name="fecha_ul_mov"
                    value="<?= $this->cuenta->fecha_ul_mov ?>"  disabled>
            </div>
            <!-- num_movtos -->
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Nº de movimientos totales</label>
                <input type="text" class="form-control" name="num_movtos" value="<?= $this->cuenta->num_movtos ?>"
                    disabled>
            </div>
            <!-- saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" value="<?= $this->cuenta->saldo ?>" disabled>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Volver</a>

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