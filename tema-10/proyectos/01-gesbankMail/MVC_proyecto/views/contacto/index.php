<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap -->
    <?php require_once("template/partials/head.php"); ?>
    <title>Página de contacto - Gesbank</title>

</head>

<body>

    <?php require_once "template/partials/menuBar.php"; ?>
    <br><br><br>

    <!-- capa principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <div class="container">
                <h4 class="display-7">Formulario Contacto </h4>
                <p class="lead">Proyecto tema 10 - PHP y MYSQL</p>
            </div>
        </header>

        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>

        <form action="<?= URL ?>contacto/validar" method="POST">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre"
                    value="<?= isset($this->contacto->nombre) ? $this->contacto->nombre : '' ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email"
                    value="<?= isset($this->contacto->email) ? $this->contacto->email : '' ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" name="asunto"
                    value="<?= isset($this->contacto->asunto) ? $this->contacto->asunto : '' ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['asunto'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['asunto'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mb-3 ">
                <label for="mensaje" class="form-label">Mensaje</label>
                <input type="text" class="form-control" name="mensaje"
                    value="<?= isset($this->contacto->mensaje) ? $this->contacto->mensaje : '' ?>">
                <!-- Mostrar posible error -->
                <?php if (isset($this->errores['mensaje'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['mensaje'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- botones de acción -->
            <div class="mb-3">
                <a name="" id="" class="btn btn-secondary" href="<?= URL ?>" role="button">Cancelar</a>
                <button type="button" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <br><br>

    <?php require_once "template/partials/footer.php" ?>

    <?php require_once "template/partials/javascript.php" ?>
</body>

</html>