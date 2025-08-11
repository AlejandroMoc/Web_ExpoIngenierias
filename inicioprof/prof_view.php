<?php

require '../src/php/database.php';

$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ($id == null) {
	header("Location: prof_start.php");
} else {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT estudiante.nombre AS nombrelider,  estudiante.apellido_paterno, estudiante.apellido_materno, proyecto.id_proyecto, proyecto.link_archivo, proyecto.nombre, status.id_profesor  FROM proyecto,status, estudiante where proyecto.id_proyecto=status.id_proyecto AND proyecto.lider = estudiante.id_estudiante AND proyecto.id_proyecto=?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$idP = $data['id_proyecto'];
	$sql2 = 'SELECT  estudiante.nombre AS nom, estudiante.apellido_paterno AS APM from estudiante, miembrosProyecto WHERE  estudiante.id_estudiante = miembrosProyecto.id_estudiante AND miembrosProyecto.id_proyecto="' . $idP . '"';

	Database::disconnect();
}
session_start();
$_SESSION['color'] = $data['id_profesor'];
?>

<!DOCTYPE html>
<html lang="es">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MiProfesor</title>
	<link rel="icon" href="../src/img/icon_prof.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/prof_common.css">

	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<body>
	<!-- Barra de navegación checar -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<a href="prof_read.php?id=<?php echo $data['id_profesor']; ?>"><span
					class="material-icons">person</span></a>
		</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_prof.svg">
			<a href="prof_start.php?id=<?php echo $data['id_profesor']; ?>"><span class="material-icons">home</span>MiProfesor</a>
		</div>
	</navbar>

	<br>

	<h2 style="color: #082460">
		&nbsp &nbsp Detalles del proyecto
	</h2>
	<center>
		<table width="60%" style=border:0;>

			<tr>
				<th class="titulotabla">
					Nombre del proyecto
				</th>
				<th><?php echo $data['nombre']; ?></th>

			</tr>

			<tr>
				<th class="titulotabla">
					Clave del proyecto
				</th>
				<th><?php echo $data['id_proyecto']; ?></th>

			</tr>
			<tr>
				<th class="titulotabla">
					Lider del Proyecto
				</th>
				<th><?php echo $data['nombrelider'] . " " . $data['apellido_paterno'] . " " . $data['apellido_materno']; ?>
				</th>

			</tr>
			<tr>
				<th class="titulotabla">
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
		<div class="botonbordeV" style="width: 15%;"><button onclick="openWindow()" class="botonfinalV"
				id="botonfinalV">Visualizar</button></div>

		<script>
			function openWindow() {
				window.open("<?php echo $data['link_archivo']; ?>");
			}

		</script>
	</center>
	<br>
	<br>
	<h2 style="color: #082460">
		&nbsp &nbsp Realizar comentarios al proyecto
	</h2>
	<label for="comentarios"></label>
	<center>
		<table>
			<th align="center" class="botonbordeV" style="width: 100%;"><a style="text-decoration:none"
					href="prof_feedback.php?id=<?php echo $data['id_proyecto']; ?>">
					<button align="center" class="botonfinalV" id="botonfinalV">Comentar</button>
				</a></th>
		</table>
</body>
</center>
<br>
<br>
<br>
<br>

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
					<button class="botonfinalC" id="botonfinalC" type="submit"><strong>Corregir</strong></button>
				</form>
			</th>
			<td style="width: 7%;"> </td>

			<th align="center" class="botonbordeR" style="width: 23.33%;"><a style="text-decoration:none"
					href="prof_reject.php?id=<?php echo $data['id_proyecto']; ?>">
					<button align="center" class="botonfinalR" id="botonfinalR"><strong>Rechazado</strong></button>
				</a></th>

		</tr>
	</table>
</center>

<br>
</body>

</html>