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

        <table class="table">
            <thead>
                <tr>
                    <!--<?php foreach (array_keys($libros[0]) as $clave): ?>
                        <th>
                            <?= $clave ?>
                        </th>
                    <?php endforeach; ?> -->

                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Precio</th>
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
                    </tr>
                <?php endforeach; ?>


                
                <!--
                    <td><?= $libro['id']?></td>
                    <td><?= $libro['titulo']?></td>
                    <td><?= $libro['autor']?></td>
                    <td><?= $libro['genero']?></td>
                    <td><?= $libro['precio']?></td>
                -->

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Nº Libros <?= count($libros) ?></td>
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