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
	<?php require_once("template/partials/menu.php") ?>
	<br><br><br>

	<!-- Page Content -->
	<div class="container">
		<!-- cabecera  -->
		<?php require_once("views/clientes/partials/header.php") ?>

		<!-- mensajes -->
		<?php require_once("template/partials/notify.php") ?>

		<!-- errores -->
		<?php require_once("template/partials/error.php") ?>



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
							<th>Nombre</th>
							<th>Apellidos</th>
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
									<?= $cliente->nombre ?>
								</td>
								<td>
									<?= $cliente->apellidos ?>
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
										onclick="return confirm('Confirme la eliminación del cliente')">
										<i class="bi bi-trash-fill"></i>
									</a>

									<!-- botón editar -->
									<a href="<?= URL ?>clientes/edit/<?= $cliente->id ?>" title="Editar">
										<i class="bi bi-pencil-square"></i></a>

									<!-- botón mostrar -->
									<a href="<?= URL ?>clientes/show/<?= $cliente->id ?> ?>" title="Mostrar">
										<i class="bi bi-card-text"></i></a>

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