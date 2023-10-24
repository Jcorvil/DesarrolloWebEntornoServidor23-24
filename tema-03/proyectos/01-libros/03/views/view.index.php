<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <!-- Incluir head -->
    <title>Tabla de Libros</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-book"></i>Tabla de Libros
            <span class="fs-6"></span>
        </header>



        <legend>Tabla de Libros</legend>

        <!--Menu principal-->
        <?php
        include 'views/partials/menu_prin.php';
        ?>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <?php foreach ($libro as $key): ?>
                            <td>
                                <?= $key ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <a href="eliminar.php?id=<?= $libro['id'] ?>"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Nº Libros
                        <?= count($libros) ?>
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>