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
	$sql = "SELECT * FROM profesor where id_profesor = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>MiProfesor</title>
	<link rel="icon" href="../src/img/icon_prof.png">
	
	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/prof_common.css">
	<link rel="stylesheet" href="css/prof_read.css">
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!--Nueva barra de navegación-->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="prof_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_prof.svg">
			<a href="prof_start.php"><span class="material-icons">home</span>MiProfesor</a>
		</div>
	</navbar>

	<br>
	<h1 align="center" style="color: #082460">Mis datos</h1>

	<br>
	<center>
		<table>
			<tr>
				<th class="tabh">&nbsp Nómina: &nbsp</th>
				<td class="tabd">&nbsp <?php echo $data['id_profesor']; ?> &nbsp</td>
			</tr>
			<tr>
				<th class="tabh">&nbsp Nombre: &nbsp</th>
				<td class="tabd">&nbsp <?php echo $data['nombre']; ?> &nbsp</td>
			</tr>
			<tr>
				<th class="tabh">&nbsp Apellido Paterno: &nbsp</th>
				<td class="tabd">&nbsp <?php echo $data['apellido_paterno']; ?> &nbsp</td>
			</tr>
			<tr>
				<th class="tabh">&nbsp Apellido Materno: &nbsp</th>
				<td class="tabd">&nbsp <?php echo $data['apellido_materno']; ?> &nbsp</td>
			</tr>
			<tr>
				<th class="tabh">&nbsp Correo Electronico: &nbsp</th>
				<td class="tabd">&nbsp <?php echo $data['correo']; ?> &nbsp</td>
			</tr>

		</table>
	</center>

	<br>
	<br>

	<?php

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql5 = 'SELECT profesor.id_profesor FROM profesor LEFT JOIN juez ON profesor.id_profesor = juez.id_juez WHERE juez.id_juez IS NULL AND profesor.id_profesor = ?';
	$q5 = $pdo->prepare($sql5);
	$q5->execute(array($id));
	$data = $q5->fetch(PDO::FETCH_ASSOC);
	$h = $id;
	if ($h == $data['id_profesor']) {
		echo '<center>';

		echo '<div class="botonbordeV" style="width: 14%; float: center;">';
		echo '<form  action="prof_promote.php" method="post">';
		echo '<input type="hidden" name="id" value="' . $id . '"/>';
		echo '<button class="botonfinalV" id="botonfinalV" type="submit">Convertirme en Juez</button>';
		echo '</form></th>';
		echo '</div>';

		echo '</center>';
	}

	?>


</body>

</html>