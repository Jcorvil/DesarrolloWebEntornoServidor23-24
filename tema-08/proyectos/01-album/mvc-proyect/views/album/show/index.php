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
        <?php include 'views/album/partials/header.php' ?>

        <legend>Formulario Mostrar Album</legend>

        <!-- Formulario Mostrar album -->
        <form action="<?= URL ?>album/update/<?= $this->id ?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="number" class="form-control" name="id" value="<?= $this->album->id ?>" disabled>
            </div>

            <!-- titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" value="<?= $this->album->titulo ?>" disabled>
            </div>
            <!-- descripcion -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $this->album->descripcion ?>"
                    disabled>
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="autor" class="form-control" name="autor" value="<?= $this->album->autor ?>" disabled>
            </div>
            <!-- fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="text" class="form-control" name="fecha" value="<?= $this->album->fecha ?>" disabled>
            </div>
            <!-- categoria -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" name="categoria" value="<?= $this->album->categoria ?>"
                    disabled>
            </div>
            <!-- etiquetas -->
            <div class="mb-3">
                <label for="etiquetas" class="form-label">Etiquetas</label>
                <input type="text" class="form-control" name="etiquetas" value="<?= $this->album->etiquetas ?>"
                    disabled>
            </div>
            <!-- carpeta -->
            <div class="mb-3">
                <label for="carpeta" class="form-label">Carpeta</label>
                <input type="text" class="form-control" name="carpeta" value="<?= $this->album->carpeta ?>" disabled>
            </div>

            <hr>
            <hr>
            <!-- Mostrar imágenes del álbum -->
            <label for="imagenes" class="form-label">Imágenes del álbum</label>
            <div class="row">
                <?php
                // Ruta de la carpeta del álbum
                $rutaCarpetaAlbum = 'images/' . $this->album->carpeta;

                // Obtener la lista de archivos en la carpeta del álbum
                $archivos = scandir($rutaCarpetaAlbum);

                // Filtrar la lista de archivos para obtener solo los archivos de imagen
                $imagenesAlbum = array_filter($archivos, function ($archivo) {
                    // Verificar si el archivo es una imagen
                    $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    return in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                });

                // Mostrar las imágenes
                foreach ($imagenesAlbum as $imagen):
                    ?>
                    <div class="col-md-3">
                        <img src="<?= URL . $rutaCarpetaAlbum . '/' . $imagen ?>" class="img-fluid mb-2">
                        <!-- Botón ver imagen -->
                        <a href="<?= URL . $rutaCarpetaAlbum . '/' . $imagen ?>" target="_blank"
                            class="btn btn-primary btn-sm">Ver</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr>
            <hr>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Volver</a>

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