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
        <?php include 'views/users/partials/header.php' ?>

        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>

        <legend>Formulario Editar Usuario</legend>

        <!-- Formulario Editar user -->
        <form action="<?= URL ?>users/update/<?= isset($this->id) ? $this->id : '' ?>" method="POST">

            <!-- id oculto -->
            <input type="number" class="form-control" name="id"
                value="<?= isset($this->user) && isset($this->user->id) ? $this->user->id : '' ?>" hidden>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name"
                    value="<?= isset($this->user) && isset($this->user->name) ? $this->user->name : '' ?>">
                <?php if (isset($this->errores['name'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['name'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email"
                    value="<?= isset($this->user) && isset($this->user->email) ? $this->user->email : '' ?>">
                <?php if (isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Nueva Contraseña">
                <?php if (isset($this->errores['password'])): ?>
                    <span class="form-text text-danger" role="alert">
                        <?= $this->errores['password'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="password_confirm" placeholder="Confirme la Contraseña">
            </div>

            <!-- campo rol -->
            <div class="mb-3 row">
                <label for="rol" class="form-label">Rol</label>
                <div class="col-md-6">
                    <select id="rol" class="form-select" name="rol" required>
                        <option value="" selected disabled>Seleccione un rol</option>
                        <?php if (isset($this->roles)): ?>
                            <?php foreach ($this->roles as $rol): ?>
                                <option value="<?= $rol->id ?>">
                                    <?= $rol->name ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>users" role="button">Cancelar</a>
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