<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <title>Proyecto 4.2 - Gestión Artículos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Tabla Artículos</legend>

        <!-- Menu Principal -->
        <?php include 'views/partials/menu_prin.php' ?>

        <br>
        <!-- Notificación -->
        <?php include 'views/partials/notificacion.php' ?>

        <!-- Muestra datos de la tabla -->
        <table class="table">
            <!-- Encabezado tabla -->
            <thead>
                <tr>
                    <!-- personalizado -->
                    <th>Id</th>
                    <th>Descripción</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Categorias</th>
                    <th class="text-end">Stock</th>
                    <th class="text-end">Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Mostramos cuerpo de la tabla -->
            <tbody>

                <?php foreach ($articulos->getTabla() as $indice => $articulo): ?>
                    <tr>
                        <!-- Formatos distintos para cada  columna -->

                        <!-- Detalles de artículos -->
                        <td>
                            <?= $articulo->getId() ?>
                        </td>
                        <td>
                            <?= $articulo->getDescripcion() ?>
                        </td>
                        <td>
                            <?= $articulo->getModelo() ?>
                        </td>
                        <td>
                            <?= $marcas[$articulo->getMarca()] ?>
                        </td>
                        <td>
                            <?= implode(', ', ArrayArticulos::mostrarCategorias($categorias, $articulo->getCategoria())) ?>
                        </td>
                        <td class="text-end">
                            <?= $articulo->getUnidades() ?>
                        </td>
                        <td class="text-end">
                            <?= number_format($articulo->getPrecio(), 2, ',', '.') ?> €
                        </td>


                        <td>
                            <a href="eliminar.php?id=<?= $indice ?>" title="Eliminar"><i class="bi bi-trash"></i></a>
                            <a href="editar.php?id=<?= $indice ?>" title="Editar"><i class="bi bi-pencil"></i></a>
                            <a href="mostrar.php?id=<?= $indice ?>" title="Mostrar"><i class="bi bi-eye"></i></a>

                        </td>
                    </tr>

                <?php endforeach; ?>


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">Nº Artículos
                        <?= count($articulos->getTabla()) ?>
                    </td>
                </tr>
            </tfoot>
        </table>



        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>