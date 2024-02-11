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

        <legend>Importación</legend>

        <!-- Importación -->
        <form action="<?= URL ?>clientes/import" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="archivo_csv" class="form-label">Seleccione el archivo CSV</label>
                <input type="file" class="form-control" id="archivo_csv" name="archivo_csv" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-primary">Importar</button>
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