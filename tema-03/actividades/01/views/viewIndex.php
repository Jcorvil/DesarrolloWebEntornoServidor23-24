<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <!-- Incluir head -->
    <title>Formulario Acceso</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>Formulario Acceso
            <span class="fs-6"></span>
        </header>

        <legend>Formulario Acceso</legend>
        <form method="POST" action="acceso.php">

            <!-- Valores para los campos -->
            <form>
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="usuario">
                    <div id="usuarioHelp" class="form-text">Entre 8 y 15 caracteres</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email">
                    <div id="emailHelp" class="form-text">Introduzca email válido ejemplo@ejemplo.com</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="password">
                    <div id="passwordHelp" class="form-text">Introduzca una contraseña segura</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Repita la contraseña</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="passwordConfirm">
                    <div id="passwordConfirmationHelp" class="form-text">Introduzca la misma contraseña que arriba</div>
                </div>

                <!--Perfiles-->
                <select class="form-select" aria-label="Default select example" name="perfil">
                    <option selected disabled>Seleccionar Perfil</option>
                    <option value="administrador">Administrador</option>
                    <option value="editor">Editor</option>
                    <option value="usuario">Usuario</option>
                </select>

                <br>

                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-danger">Borrar</button>

            </form>

            <!-- Pié del documento -->
            <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>