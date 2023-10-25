<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <!-- Incluir head -->
    <title>Tabla Artículos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <?php
        include 'views/partials/menu.php';
        ?>


        <legend>Tabla Artículos</legend>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Modelo</th>
                    <th>Categoría</th>
                    <th>Unidades</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($articulos as $articulo): ?>
                    <tr>
                        <td><?= $articulo['id'] ?></td>
                        <td><?= $articulo['descripcion'] ?></td>
                        <td><?= $articulo['modelo'] ?></td>
                        <td><?= $categorias[$articulo['categoria']] ?></td>
                        <td><?= $articulo['unidades'] ?></td>
                        <td><?= number_format($articulo['precio'], 2, ',', '.' )?> €</td>
                        <td>
                            <a href="eliminar.php?id=<?= $articulo['id'] ?>" title="Eliminar"><i
                                    class="bi bi-trash"></i></a>
                            <a href="editar.php?id=<?= $articulo['id'] ?>" title="Editar"><i class="bi bi-pencil"></i></a>
                            <a href="mostrar.php?id=<?= $articulo['id'] ?>" title="Mostrar"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>

        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>