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
        <?php include 'views/clientes/partials/header.php' ?>

        <legend>Formulario Nuevo Cliente</legend>

        <!-- Formulario Nuevo Cliente -->
        <form action="<?= URL ?>clientes/create" method="POST">

            <!-- id -->
            <!-- <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>  -->
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= isset($this->cliente->nombre) ?>">
                <?php if (isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos"
                    value="<?= isset($this->cliente->apellidos) ?>">
                <?php if (isset($this->errores['apellidos'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['apellidos'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= isset($this->cliente->email) ?>">
                <?php if (isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="telefono" value="<?= isset($this->cliente->telefono) ?>">
                <?php if (isset($this->errores['telefono'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['telefono'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Ciudad -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= isset($this->cliente->ciudad) ?>">
                <?php if (isset($this->errores['ciudad'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['ciudad'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" minlength="9" maxlength="9" pattern=".{9}"
                    value="<?= isset($this->cliente->dni) ? $this->cliente->dni : '' ?>">
                <?php if (isset($this->errores['dni'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['dni'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>clientes" role="button">Cancelar</a>
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