<!doctype html>
<html lang="es"> 
<head>
    <?php require_once("template/partials/head.php") ?>
    <title><?= $this->title ?></title>
</head>

<body>
    <!-- menu aut -->
    <?php require_once("template/partials/menuAut.php") ?>
    
    <!-- Page Content -->
    <div class="container">
	<br><br><br>

    <div class="row justify-content-center">
            
            <div class="col-md-8">
            <?php require_once("template/partials/notify.php") ?>
            <?php require_once("template/partials/error.php") ?>
                <div class="card">
                    <div class="card-header">Editar Perfil <?= $_SESSION['name_user']?></div>
                    <div class="card-body">
                        <form method="POST" action="<?=URL?>perfil/valperfil">
                            
                            <!-- campo name -->
                            
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Nombre Usuario</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control <?= (isset($this->errores['name']))? 'is-invalid': null ?>" name="name" value="<?= $this->user->name; ?>" required autofocus>
                                
                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->errores['name'] ??= null ?>
                                    </span>
                                </div>
                               
                            </div>

                            <!-- campo email -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-end">Email</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control <?= (isset($this->errores['email']))? 'is-invalid': null ?>" name="email" value="<?= $this->user->email; ?>" required autocomplete="email" autofocus>

                                    <span class="form-text text-danger" role="alert">
                                        <?= $this->errores['email'] ??= null ?>
                                    </span>

                                </div>
                                
                            </div>
                            
                            <!-- botones acción -->
                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <a class="btn btn-secondary" href="<?=URL?>perfil" role="button">Cancelar</a>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
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