<?php
require '../src/php/database.php';
$id = null;

// Assign the ID value if possible
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ($id == null) {
	header("Location: prof_start.php");
} else {
	// Connect to the database
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// SQL query to get project, leader, and associated professor data
	$sql = "SELECT estudiante.nombre AS nombrelider,  estudiante.apellido_paterno, estudiante.apellido_materno, proyecto.id_proyecto, proyecto.link_archivo, proyecto.nombre, status.id_profesor  FROM proyecto,status, estudiante where proyecto.id_proyecto=status.id_proyecto AND proyecto.lider = estudiante.id_estudiante AND proyecto.id_proyecto=?";

	// Prepare and execute SQL query with the project id as a parameter
	$q = $pdo->prepare($sql);
	$q->execute(array($id));

	// Fetch the query results into an associative array
	$data = $q->fetch(PDO::FETCH_ASSOC);

	// Assign the project id to the $idP variable
	$idP = $data['id_proyecto'];

	// SQL query to get the names of the project members
	$sql2 = 'SELECT  estudiante.nombre AS nom, estudiante.apellido_paterno AS APM from estudiante, miembrosProyecto WHERE  estudiante.id_estudiante = miembrosProyecto.id_estudiante AND miembrosProyecto.id_proyecto="' . $idP . '"';

	// Disconnect from the database
	Database::disconnect();
}

// Start the PHP session and store the ID in the 'color' session variable
session_start();
$_SESSION['color'] = $data['id_profesor'];
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

	<title>MiProfesor</title>
	<link rel="icon" href="../src/img/icon_prof.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/prof_common.css">
	<link rel="stylesheet" href="css/prof_view.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!-- Barra de navegación lista Prof -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">

			<div id="navbar_icon_container">
				<a id="navbar_icon" href="prof_read.php?id=<?php echo $color; ?>" class="material-icons">person</a>
				<!-- <a id="navbar_icon" href="" class="material-icons">rate_review</a> -->
				<a id="navbar_icon" href="prof_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbar_blue">
			<img src="../src/img/logo_expo_prof.svg">
			<a href="prof_start.php?id=<?php echo $color; ?>"><span class="material-icons">home</span>MiProfesor</a>
		</div>
	</navbar>

	<h2 style="color: #082460">
		&nbsp &nbsp Detalles del proyecto
	</h2>
	<center>
		<table width="60%" style=border:0;>

			<tr>
				<th class="title_table">
					Nombre del proyecto
				</th>
				<th><?php echo $data['nombre']; ?></th>
			</tr>

			<tr>
				<th class="title_table">
					Clave del proyecto
				</th>
				<th><?php echo $data['id_proyecto']; ?></th>
			</tr>

			<tr>
				<th class="title_table">
					Lider del Proyecto
				</th>
				<th><?php echo $data['nombrelider'] . " " . $data['apellido_paterno'] . " " . $data['apellido_materno']; ?>
				</th>
			</tr>

			<tr>
				<th class="title_table">
					Miembros del equipo
				</th>
				<th>
					<?php
					foreach ($pdo->query($sql2) as $row) {
						echo $row['nom'] . " " . $row['APM'] . ', ';
					}
					Database::disconnect();
					?>
				</th>
			</tr>
		</table>

	</center>

	<h2 style="color: #082460">
		&nbsp &nbsp Archivos de proyecto
	</h2>

	<center>
		<div class="prof_button_action_td" style="width: 15%;">
			<button onclick="openWindow()" class="prof_button_action" id="prof_button_action">Visualizar</button>
		</div>

		<script>
			function openWindow() {
				window.open("<?php echo $data['link_archivo']; ?>");
			}
		</script>
	</center>

	<h2 style="color: #082460">
		&nbsp &nbsp Realizar comentarios al proyecto
	</h2>
	<label for="comentarios"></label>

	<center>
		<table>
			<th align="center" class="prof_button_action_td" style="width: 100%;"><a style="text-decoration:none"
					href="prof_feedback.php?id=<?php echo $data['id_proyecto']; ?>">
					<button align="center" class="prof_button_action" id="prof_button_action">Comentar</button>
				</a>
			</th>
		</table>
	</center>

</body>

<center>
	<table>
		<tr>
			<th align="center" class="botonbordeA" style="width: 23.33%;">
				<form action="prof_accept.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<button class="botonfinalA" id="botonfinalA" type="submit"><strong>Aprobar</strong></button>
				</form>
			</th>
			<td style="width: 7%;"> </td>

			<th align="center" class="botonbordeC" style="width: 23.33%;">
				<form action="prof_edit.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<button class="button_accept" id="button_accept" type="submit"><strong>Corregir</strong></button>
				</form>
			</th>
			<td style="width: 7%;"> </td>

			<th align="center" class="button_border_reject" style="width: 23.33%;"><a style="text-decoration:none"
					href="prof_reject.php?id=<?php echo $data['id_proyecto']; ?>">
					<button align="center" class="button_reject" id="button_reject">
						<strong>Rechazado</strong>
					</button>
				</a>
			</th>

		</tr>
	</table>
</center>

</html>