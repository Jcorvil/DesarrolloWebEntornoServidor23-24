<!doctype html>
<html lang="es"> 

<head>
    <?php require_once("template/partials/head.php") ?>
    <title><?= $this->title ?></title>
</head>
<body>
    <!-- menu con autentificación -->
    <?php require_once("template/partials/menuAut.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br>

    <div class="row justify-content-center">
            
            <div class="col-md-8">
            <!-- mensaje -->
            <?php require_once("template/partials/notify.php") ?>
            <!-- error -->
            <?php require_once("template/partials/error.php") ?>
                <div class="card">
                    <div class="card-header">Pefil <?= $_SESSION['name_user'] ?></div>
                    <div class="card-header">
                        <?php require_once("views/perfil/partials/menu.php") ?>
                    </div>
                    <div class="card-body">
                        <form>
                        
                            <!-- campo tipo perfil -->
                            <br>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Perfil</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" value="<?= $_SESSION['name_rol']; ?>" disabled>
                                </div>
                            </div>            

                            <!-- campo name -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Nombre Usuario</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name" value="<?= $this->user->name; ?>" disabled>
                                </div>
                            </div>

                            <!-- campo email -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" value="<?= $this->user->email; ?>" disabled>
                                </div>
                            </div>
                            
                            <!-- botones acción -->
                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <a class="btn btn-secondary" href="<?=URL?>alumno" role="button">Salir</a>
                                </div>
                            </div>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- /.container -->
    
    <?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>
	
</body>

</html>