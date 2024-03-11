<!doctype html>
<html lang="es">

<!-- head -->

<head>
	<?php require_once("template/partials/head.php") ?>
	<title>
		<?= $this->title ?>
	</title>
</head>

<body>
	<!-- Menú Principal -->
	<?php require_once("template/partials/menuAut.php") ?>
	<br><br><br>

	<!-- Page Content -->
	<div class="container">
		<!-- cabecera  -->
		<?php require_once("views/users/partials/header.php") ?>

		<!-- mensajes -->
		<?php require_once("template/partials/notify.php") ?>

		<!-- errores -->
		<?php require_once("template/partials/error.php") ?>

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				Tabla de Usuarios
			</div>
			<div class="card-header">
				<!-- menu users -->
				<?php require_once("views/users/partials/menu.php") ?>
			</div>
			<div class="card-body">

				<!-- Muestra datos de la tabla -->
				<table class="table">
					<!-- Encabezado tabla -->
					<thead>
						<tr>
							<!-- personalizado -->
							<th>Id</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Rol</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<!-- Mostramos cuerpo de la tabla -->
					<tbody>

						<!-- Objeto clase pdostatement en foreach -->
						<?php foreach ($this->users as $user): ?>

							<tr>
								<!-- Formatos distintos para cada  columna -->

								<!-- Detalles de users -->
								<td>
									<?= $user->id ?>
								</td>
								<td>
									<?= $user->name ?>
								</td>
								<td>
									<?= $user->email ?>
								</td>
								<td>
									<?= $this->model->userRol($user->id)->name ?>
								</td>

								<!-- botones de acción -->
								<td>
									<!-- botón eliminar -->
									<a href="<?= URL ?>users/delete/<?= $user->id ?>" title="Eliminar"
										class="btn btn-danger <?= (!in_array($_SESSION['id_rol'], $GLOBALS['user']['delete'])) ? 'disabled' : '' ?>"
										onclick="return confirm('Confirmar eliminación del user')">
										<i class="bi bi-trash"></i>
									</a>

									<!-- botón editar -->
									<a href="<?= URL ?>users/edit/<?= $user->id ?>" title="Editar"
										class="btn btn-primary <?= (!in_array($_SESSION['id_rol'], $GLOBALS['user']['edit'])) ? 'disabled' : '' ?>">
										<i class="bi bi-pencil"></i>
									</a>

									<!-- botón mostrar -->
									<a href="<?= URL ?>users/show/<?= $user->id ?>" title="Mostrar"
										class="btn btn-warning <?= (!in_array($_SESSION['id_rol'], $GLOBALS['user']['show'])) ? 'disabled' : '' ?>">
										<i class="bi bi-card-text"></i>
									</a>
								</td>
							</tr>

						<?php endforeach; ?>


					</tbody>

				</table>

			</div>
			<div class="card-footer">
				<small class="text-muted"> Nº users:
					<?= $this->users->rowCount(); ?>
				</small>
			</div>
		</div>
	</div>
	<br><br><br>

	<!-- /.container -->

	<?php require_once("template/partials/footer.php") ?>
	<?php require_once("template/partials/javascript.php") ?>

</body>

</html>