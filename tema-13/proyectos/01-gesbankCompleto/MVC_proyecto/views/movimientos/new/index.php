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

        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>

        <legend>Formulario Nuevo movimiento</legend>

        <!-- Formulario Nuevo movimiento -->
        <form action="<?= URL ?>movimientos/create" method="POST">

            <!-- id -->
            <!-- <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>  -->

            <!-- id_cuenta -->
            <div class="mb-3">
                <label class="form-label">Cuenta</label>
                <select class="form-select" name="id_cuenta" id="selectCuenta"
                    value="<?= isset($this->movimiento->id_cuenta) ?>">
                    <option value="" disabled selected>Seleccione una cuenta</option>
                    <?php foreach ($this->cuentas as $cuenta): ?>
                        <option value="<?= $cuenta->id ?>">
                            <?= $cuenta->num_cuenta ?>
                        </option>
                    <?php endforeach; ?>
                    <?php if (isset($this->errores['id_cuenta'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['id_cuenta'] ?>
                        </span>
                    <?php endif; ?>
                </select>
            </div>


            <!-- fecha_hora -->
            <div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha</label>
                <input type="datetime-local" class="form-control" name="fecha_hora"
                    value="<?= isset($this->movimiento->fecha_hora) ? $this->movimiento->fecha_hora : '' ?>">
                <?php if (isset($this->errores['fecha_hora'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['fecha_hora'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- concepto -->
            <div class="mb-3">
                <label for="concepto" class="form-label">Concepto</label>
                <input type="text" class="form-control" name="concepto"
                    value="<?= isset($this->movimiento->concepto) ? $this->movimiento->concepto : '' ?>">
                <?php if (isset($this->errores['concepto'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['concepto'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- tipo -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" name="tipo" id="selectTipo">
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="I">Ingreso</option>
                    <option value="R">Reintegro</option>
                </select>
                <?php if (isset($this->errores['tipo'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['tipo'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- cantidad -->
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="float" class="form-control" name="cantidad"
                    value="<?= isset($this->movimiento->cantidad) ? $this->movimiento->cantidad : '' ?>">
                <?php if (isset($this->errores['cantidad'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['cantidad'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>movimientos" role="button">Cancelar</a>
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