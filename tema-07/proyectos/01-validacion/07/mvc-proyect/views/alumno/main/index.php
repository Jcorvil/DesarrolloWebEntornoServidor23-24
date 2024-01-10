<!doctype html>
<html lang="es">

<!-- head -->
<head>
	<?php require_once("template/partials/head.php") ?>
	<title><?= $this->title ?></title>
<head>


<body>
	<!-- Menú Principal -->
	<?php require_once("template/partials/menu.php") ?>
	<br><br><br>

	<!-- Page Content -->
	<div class="container">
		<!-- cabecera  -->
		<?php require_once("views/alumno/partials/header.php") ?>

		<!-- mensajes -->
		<?php require_once("template/partials/notify.php") ?>

		<!-- errores -->
		<?php require_once("template/partials/error.php") ?>



		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				Tabla de Alumnos
			</div>
			<div class="card-header">
				<!-- menu alumnos -->
				<?php require_once("views/alumno/partials/menu.php") ?>
			</div>
			<div class="card-body">

				<!-- Muestra datos de la tabla -->
				<table class="table">
					<!-- Encabezado tabla -->
					<thead>
						<tr>
							<!-- personalizado -->
							<th>Id</th>
							<th>Alumno</th>
							<th class="text-end">Edad</th>
							<th>DNI</th>
							<th>Población</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Curso</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<!-- Mostramos cuerpo de la tabla -->
					<tbody>

						<!-- Objeto clase pdostatement en foreach -->
						<?php foreach ($this->alumnos as $alumno): ?>
							<tr>
								<!-- Formatos distintos para cada  columna -->

								<!-- Detalles de alumnos -->
								<td>
									<?= $alumno->id ?>
								</td>
								<td>
									<?= $alumno->alumno ?>
								</td>
								<td class="text-end">
									<?= $alumno->edad ?>
								</td>
								<td>
									<?= $alumno->dni ?>
								</td>
								<td>
									<?= $alumno->poblacion ?>
								</td>
								<td>
									<?= $alumno->email ?>
								</td>
								<td>
									<?= $alumno->telefono ?>
								</td>
								<td>
									<?= $alumno->curso ?>
								</td>

								<!-- botones de acción -->
								<td>
									<!-- botón  eliminar -->
									<a href="<?= URL ?>alumno/delete/<?= $alumno->id ?>" title="Eliminar">
										<i class="bi bi-trash-fill"></i></a>

									<!-- botón  editar -->
									<a href="<?= URL ?>alumno/edit/<?= $alumno->id ?>" title="Editar">
										<i class="bi bi-pencil-square"></i></a>

									<!-- botón  mostrar -->
									<a href="<?= URL ?>alumno/show/<?= $alumno->id ?> ?>" title="Mostrar">
										<i class="bi bi-card-text"></i></a>

								</td>
							</tr>

						<?php endforeach; ?>


					</tbody>
					
				</table>

			</div>
			<div class="card-footer">
				<small class="text-muted"> Nº Alumnos: 
					<?= $this->alumnos->rowCount(); ?>
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