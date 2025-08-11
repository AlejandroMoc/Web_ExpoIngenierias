<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MiAdmin</title>
	<link rel="icon" href="../src/img/icon_admin.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/admin_common.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body id="cuerpazo">
	<!-- Barra de navegación lista -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="" class="material-icons">person</a>
				<a id="navbarIcon" href="admin_assign" class="material-icons">rate_review</a>
				<a id="navbarIcon" href="admin_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_admin.svg">
			<a href="">Página de Inicio</a>
			<a href="admin_start.php"><span class="material-icons">home</span>MiAdmin</a>
		</div>
	</navbar>

	<div class="input-group mb-3" id="buscador">
		<input type="text" class="form-control" placeholder="Buscar...">
		<span class="input-group-text material-icons">tune</span>
	</div>
	<div id="proyectosCalif">
		<a href="admin_graph.php">Proyectos Calificados</a>
		<progress id="file" max="100" value="70"> 70% </progress>
	</div>
	<div class="accordion bloqueDesplegable" id="desplegableGeneral">
		<div class="accordion-item">
			<h2 class="accordion-header">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					E S T U D I A N T E S
				</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
				<div class="accordion-body">
					<?php

					include '../src/php/database.php';
					$pdo = Database::connect();
					$sql = 'SELECT * FROM estudiante';

					echo '<div id="divAgregar">';
					echo '<a class="material-icons" href="admin_create.php?id=Estudiante">add_circle</a>';
					echo '<a href="admin_create.php?id=Estudiante">Añadir Estudiante</a>';
					echo '</div>';
					echo '<div id="listaUsuarios">';
					foreach ($pdo->query($sql) as $row) {

						echo '<div id="renglonListaUsuarios">';
						echo '<div id="matricula">';
						echo '<span>' . $row['id_estudiante'] . '</span>';
						echo '</div>';
						echo '<div id="nombre">';
						echo '<span>' . $row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . '</span>';
						echo '</div>';
						echo '<span>' . $row['correo'] . '</span>';
						echo '<div class="botonesRenglonListaUsuarios">';
						echo '<a class="material-icons" href="admin_read.php?id=' . $row['id_estudiante'] . '">visibility</a>';
						echo '<a class="material-icons" href="admin_edit.php?id=' . $row['id_estudiante'] . '">edit</a>';
						echo '<a class="material-icons" href="admin_delete.php?id=' . $row['id_estudiante'] . '">delete</a>';
						echo '</div>';
						echo '</div>';

					}
					echo '</div>';
					?>
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					J U E C E S
				</button>
			</h2>
			<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
				<div class="accordion-body">
					<?php
					$sql = 'SELECT * FROM juez';

					echo '<div id="divAgregar">';
					echo '<a class="material-icons" href="admin_create.php?id=Juez">add_circle</a>';
					echo '<a href="admin_create.php?id=Juez">Añadir Juez</a>';
					echo '</div>';
					echo '<div id="listaUsuarios">';
					foreach ($pdo->query($sql) as $row) {
						echo '<div id="renglonListaUsuarios">';
						echo '<div id="matricula">';
						echo '<span>' . $row['id_juez'] . '</span>';
						echo '</div>';
						echo '<div id="nombre">';
						echo '<span>' . $row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . '</span>';
						echo '</div>';
						echo '<span>' . $row['correo'] . '</span>';
						//echo '<span>'. 'Edición: ' . $row['id_edicion'] .'</span>';
						echo '<div class="botonesRenglonListaUsuarios">';
						echo '<a class="material-icons" href="admin_read.php?id=' . $row['id_juez'] . '">visibility</a>';
						echo '<a class="material-icons" href="admin_edit.php?id=' . $row['id_juez'] . '">edit</a>';
						echo '<a class="material-icons" href="admin_delete.php?id=' . $row['id_juez'] . '">delete</a>';
						echo '</div>';
						echo '</div>';

					}
					echo '</div>';
					?>
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					P R O F E S O R E S
				</button>
			</h2>
			<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#desplegableGeneral">
				<div class="accordion-body">
					<?php
					$sql = 'SELECT * FROM profesor';

					echo '<div id="divAgregar">';
					echo '<a class="material-icons" href="admin_create.php?id=Profesor">add_circle</a>';
					echo '<a href="admin_create.php?id=Profesor">Añadir Profesor</a>';
					echo '</div>';
					echo '<div id="listaUsuarios">';
					foreach ($pdo->query($sql) as $row) {

						echo '<div id="renglonListaUsuarios">';
						echo '<div id="matricula">';
						echo '<span>' . $row['id_profesor'] . '</span>';
						echo '</div>';
						echo '<div id="nombre">';
						echo '<span>' . $row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . '</span>';
						echo '</div>';
						echo '<span>' . $row['correo'] . '</span>';
						//echo '<span>'. 'Edición: ' . $row['id_edicion'] .'</span>';
						echo '<div class="botonesRenglonListaUsuarios">';
						echo '<a class="material-icons" href="admin_read.php?id=' . $row['id_profesor'] . '">visibility</a>';
						echo '<a class="material-icons" href="admin_edit.php?id=' . $row['id_profesor'] . '">edit</a>';
						echo '<a class="material-icons" href="admin_delete.php?id=' . $row['id_profesor'] . '">delete</a>';
						echo '</div>';
						echo '</div>';

					}
					echo '</div>';
					Database::disconnect();
					?>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
		crossorigin="anonymous"></script>
</body>

</html>