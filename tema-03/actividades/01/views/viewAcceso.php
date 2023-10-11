<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir head -->
    <title>Formulario Acceso</title>
    <?php include 'views/layouts/head.html' ?>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator">Formulario Acceso</i>
            <span class="fs-6"></span>
        </header>


        <legend>Datos de acceso</legend>
        
        <?php if ($perfil == 'admin' or $perfil == 'editor'): ?>

        <?php endif ?>
        
        <table class="table">
            <tbody>

                <tr>
                    <th>Nombre Usuario</th>
                    <td>
                        <?= $usuario ?>
                    </td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>
                        <?= $email ?>
                    </td>
                </tr>
                <tr>
                    <th>Contraseña</th>
                    <td>
                        <?= $password ?>
                    </td>
                </tr>
                <tr>
                    <th>Tipo de usuario</th>
                    <td>
                        <?= $perfil ?>
                    </td>
                </tr>


        </table>
        
        <a class="btn btn-primary" href="index.php" role="button">Volver</a>


        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>