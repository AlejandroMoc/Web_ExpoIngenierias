<?php
session_start();
$id = null;
$id = $_REQUEST['id'];
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ($id == null) {
	header("Location: indexProf.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MiProfesor</title>
	<link rel="icon" href="../src/img/miniicon.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/dani.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!-- Barra de navegación -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<a href="readProf.php?id=<?php echo $id; ?>"><span class="material-symbols-outlined">person</span></a>
		</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_prof.svg">
			<h2 style="color: #FFFFFF">MiProfesor &nbsp &nbsp</h2>
		</div>
	</navbar>

	<br>
	<h1 align="center" style="color: #082460">Proyectos</h1>
	<br>

	<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
		<div class="accordion-body">
			<center>
				<table style="background-color: #4B73C1; width: 70%;">
					<tr style="background-color: #ffffff; color:#082460;">
						<th>ID</th>
						<th>Nombre</th>
						<th>Categoría</th>
						<th>Estado</th>
						<th>Líder</th>
						<th>Detalles</th>
					</tr>
					<?php

					include 'database.php';
					$pdo = Database::connect();
					$sql = 'SELECT estudiante.nombre AS est, estudiante.apellido_paterno, estudiante.apellido_materno, proyecto.id_proyecto, proyecto.nombre, categoria.nombre As cat, status.status 
                          FROM estudiante, proyecto, categoria,status  
                          WHERE proyecto.lider = estudiante.id_estudiante 
                            And proyecto.id_categoria = categoria.id_categoria AND status.id_proyecto = proyecto.id_proyecto AND status.status !="Corregir" AND status.status !="Rechazado" AND status.status !="Aceptado" AND status.id_profesor="' . $id . '"';

					foreach ($pdo->query($sql) as $row) {

						echo '<tr  style="border:0px; border-radius:1px; ">';
						echo '<td align="center" class="proyectoV">' . $row['id_proyecto'] . '<br></br> </td>';
						echo '<td align="center" class="proyectoV">' . $row['nombre'] . '<br></br>  </td>';
						echo '<td align="center" class="proyectoV">' . $row['cat'] . '<br></br>  </td>';
						echo '<td align="center" class="proyectoV">' . $row['status'] . '<br></br> </td>';
						echo '<td align="center" class="proyectoV">' . $row['est'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . '<br></br> </td>';
						echo '<td align="center" width=250>';
						echo '<a class="material-icons" href="vistaProf.php?id=' . $row['id_proyecto'] . '" style="color: white; text-decoration:none;">visibility</a>';
						echo '</td>';
						echo '</tr>';
					}
					Database::disconnect();


					?>

				</table>
			</center>
		</div>
	</div>

</body>

</html>