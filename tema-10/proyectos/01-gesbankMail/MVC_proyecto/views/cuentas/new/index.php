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
        <?php include 'views/cuentas/partials/header.php' ?>

        <legend>Formulario Nueva Cuenta</legend>

        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>

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
                <input type="text" class="form-control" name="num_cuenta" maxlength="20" minlength="20"
                    value="<?= isset($this->cuenta->num_cuenta) ? $this->cuenta->num_cuenta : '' ?>">
                <?php if (isset($this->errores['num_cuenta'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['num_cuenta'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- cliente -->
            <div class="mb-3">
                <label class="form-label">Nombre cliente</label>
                <select class="form-select" name="id_cliente" id="selectCliente"
                    value="<?= isset($this->cuenta->id_cliente) ?>">
                    <option value="" disabled selected>Seleccione un Cliente</option>
                    <?php foreach ($this->clientes as $cliente => $nombreCompleto): ?>
                        <option value="<?= $cliente ?>">
                            <?= $nombreCompleto ?>
                        </option>
                    <?php endforeach; ?>
                    <?php if (isset($this->errores['id_cliente'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['id_cliente'] ?>
                        </span>
                    <?php endif; ?>
                </select>
            </div>


            <!-- fecha_alta -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de alta</label>
                <input type="datetime-local" class="form-control" name="fecha_alta"
                    value="<?= isset($this->cuenta->fecha_alta) ? $this->cuenta->fecha_alta : '' ?>">
                <?php if (isset($this->errores['fecha_alta'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['fecha_alta'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- fecha_ul_mov -->
            <!-- <div class="mb-3">
                <label for="fecha_ul_mov" class="form-label">Fecha último movimiento</label>
                <input type="datetime-local" class="form-control" name="fecha_ul_mov">
            </div> -->
            <!-- num_movtos -->
            <div class="mb-3">
                <label for="num_movtos" class="form-label">Nº de movimientos totales</label>
                <input type="text" class="form-control" name="num_movtos"
                    value="<?= isset($this->cuenta->num_movtos) ? $this->cuenta->num_movtos : '' ?>">
                <?php if (isset($this->errores['num_movtos'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['num_movtos'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo"
                    value="<?= isset($this->cuenta->saldo) ? $this->cuenta->saldo : '' ?>">
                <?php if (isset($this->errores['saldo'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['saldo'] ?>
                    </span>
                <?php endif; ?>
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