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

        <legend>Formulario Nuevo user</legend>

        <!-- Formulario Nuevo user -->
        <form action="<?= URL ?>users/validate" method="POST">

            <!-- id -->
            <!-- <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>  -->

            <!-- campo name -->
            <div class="mb-3 row">
                <label for="num_cuenta" class="form-label">Nombre</label>
                <div class="col-md-6">
                    <input id="name" type="text"
                        class="form-control <?= (isset($this->errores['name'])) ? 'is-invalid' : null ?>" name="name"
                        value="<?= isset($this->user->name) ? $this->user->name : '' ?>" required autocomplete="name"
                        autofocus>
                    <?php if (isset($this->errores['name'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['name'] ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- campo email -->
            <div class="mb-3 row">
                <label for="num_cuenta" class="form-label">Email</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                        class="form-control <?= (isset($this->errores['email'])) ? 'is-invalid' : null ?>" name="email"
                        value="<?= isset($this->user->email) ? $this->user->email : '' ?>" required autocomplete="email"
                        autofocus>
                    <?php if (isset($this->errores['email'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['email'] ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- campo password -->
            <div class="mb-3 row">
                <label for="num_cuenta" class="form-label">Contraseña</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                        class="form-control <?= (isset($this->errores['password'])) ? 'is-invalid' : null ?>"
                        name="password" value="<?= isset($this->user->password) ? $this->user->password : '' ?>"
                        required autocomplete="new-password">
                    <?php if (isset($this->errores['password'])): ?>
                        <span class="form-text text-danger" role="alert">
                            <?= $this->errores['password'] ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- password confirm -->
            <div class="mb-3 row">
                <label for="num_cuenta" class="form-label">Confirmación Contraseña</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password-confirm" required
                        autocomplete="new-password">
                </div>
            </div>

            <!-- campo rol -->
            <div class="mb-3 row">
                <label for="rol" class="form-label">Rol</label>
                <div class="col-md-6">
                    <select id="rol" class="form-select" name="rol" required>
                        <option value="" selected disabled>Seleccione un rol</option>
                        <?php foreach ($this->roles as $rol): ?>
                            <option value="<?= $rol->id ?>">
                                <?= $rol->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>users" role="button">Cancelar</a>
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