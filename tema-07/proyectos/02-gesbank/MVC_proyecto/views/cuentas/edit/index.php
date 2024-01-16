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

        <legend>Formulario Editar cuenta</legend>

        <!-- Formulario Editar cuenta -->
        <form action="<?= URL ?>cuentas/update/<?= $this->id ?>" method="POST">

            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Nº de la cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?= $this->cuentas->num_cuenta ?>" readonly>
            </div>
            <!-- id_cliente -->
            <div class="mb-3">
                <label class="form-label">Cliente</label>
                <select class="form-select" name="id_cliente" id="selectCliente">
                    <option value="" disabled selected>Seleccione un Cliente</option>
                    <?php foreach ($this->clientes as $cliente => $nombreCompleto): ?>
                        <option value="<?= $cliente ?>">
                            <?= $nombreCompleto ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- fecha_alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de alta</label>
                <input type="datetime-local" class="form-control" name="fecha_alta"
                    value="<?= $this->cuentas->fecha_alta ?>" readonly>
            </div>
            <!-- fecha_ul_mov -->
            <!-- <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha último movimiento</label>
                <input type="datetime-local" class="form-control" name="fecha_ul_mov"
                    value="<?= $this->cuentas->fecha_ul_mov ?>">
            </div> -->
            <!-- num_movtos -->
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Nº de movimientos totales</label>
                <input type="text" class="form-control" name="num_movtos" value="<?= $this->cuentas->num_movtos ?>" readonly>
            </div>
            <!-- saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" value="<?= $this->cuentas->saldo ?>" readonly>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>cuentas" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Restaurar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>

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