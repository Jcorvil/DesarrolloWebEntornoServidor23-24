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
		<?php require_once("views/clientes/partials/header.php") ?>

		<!-- mensajes -->
		<?php require_once("template/partials/notify.php") ?>

		<!-- errores -->
		<?php require_once("template/partials/error.php") ?>

		<!-- Modal -->
		<?php require('template/partials/modalClientes.php'); ?>

		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				Tabla de Clientes
			</div>
			<div class="card-header">
				<!-- menu clientes -->
				<?php require_once("views/clientes/partials/menu.php") ?>
			</div>
			<div class="card-body">

				<!-- Muestra datos de la tabla -->
				<table class="table">
					<!-- Encabezado tabla -->
					<thead>
						<tr>
							<!-- personalizado -->
							<th>Id</th>
							<th>Cliente</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Ciudad</th>
							<th>DNI</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<!-- Mostramos cuerpo de la tabla -->
					<tbody>

						<!-- Objeto clase pdostatement en foreach -->
						<?php foreach ($this->clientes as $cliente): ?>

							<tr>
								<!-- Formatos distintos para cada  columna -->

								<!-- Detalles de clientes -->
								<td>
									<?= $cliente->id ?>
								</td>
								<td>
									<?= $cliente->cliente ?>
								</td>
								<td>
									<?= $cliente->email ?>
								</td>
								<td>
									<?= $cliente->telefono ?>
								</td>
								<td>
									<?= $cliente->ciudad ?>
								</td>
								<td>
									<?= $cliente->dni ?>
								</td>

								<!-- botones de acción -->
								<td>
									<!-- botón eliminar -->
									<a href="<?= URL ?>clientes/delete/<?= $cliente->id ?>" title="Eliminar"
										class="btn btn-danger <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['delete'])) ? 'disabled' : '' ?>"
										onclick="return confirm('Confirmar eliminación del Cliente')">
										<i class="bi bi-trash"></i>
									</a>

									<!-- botón editar -->
									<a href="<?= URL ?>clientes/edit/<?= $cliente->id ?>" title="Editar"
										class="btn btn-primary <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['edit'])) ? 'disabled' : '' ?>">
										<i class="bi bi-pencil"></i>
									</a>

									<!-- botón mostrar -->
									<a href="<?= URL ?>clientes/show/<?= $cliente->id ?>" title="Mostrar"
										class="btn btn-warning <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['show'])) ? 'disabled' : '' ?>">
										<i class="bi bi-card-text"></i>
									</a>
								</td>
							</tr>

						<?php endforeach; ?>


					</tbody>

				</table>

			</div>
			<div class="card-footer">
				<small class="text-muted"> Nº Clientes:
					<?= $this->clientes->rowCount(); ?>
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