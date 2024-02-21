<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php") ?>
    <title>Contacto</title>
</head>

<body>
    <!-- Menú Principal -->
    <?php require_once("template/partials/menuBar.php") ?>
    <br><br><br>

    <!-- Capa principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <div class="container">
                <h4 class="display-7">Formulario Contacto </h4>
                <p class="lead">Proyecto tema 10 - PHP y MYSQL</p>
            </div>
        </header>

        <!-- mensajes -->
        <?php require_once("template/partials/notify.php") ?>

        <!-- error -->
        <?php include 'template/partials/error.php' ?>

        <legend>Formulario de Contacto</legend>

        <!-- Formulario de Contacto -->
        <form action="<?= URL ?>contacto/validar" method="POST">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre"
                    value="<?= isset($this->contacto->nombre) ? $this->contacto->nombre : '' ?>">
                <?php if (isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email"
                    value="<?= isset($this->contacto->email) ? $this->contacto->email : '' ?>">
                <?php if (isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Asunto -->
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" name="asunto"
                    value="<?= isset($this->contacto->asunto) ? $this->contacto->asunto : '' ?>">
                <?php if (isset($this->errores['asunto'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['asunto'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Mensaje -->
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" name="mensaje" rows="4"
                    value="<?= isset($this->contacto->mensaje) ? $this->contacto->mensaje : '' ?>">
                <?php if (isset($this->errores['mensaje'])): ?>
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->errores['mensaje'] ?>
                                    </span>
                <?php endif; ?>
            </textarea>
            </div>

            <!-- Botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>index" role="button">Cancelar</a>
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