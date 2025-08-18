<?php

// Variables
require '../src/php/database.php';

$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ($id == "Estudiante") {
	$id_description = " A seguida de 8 números.";
} elseif ($id == "Juez") {
	$id_description = " X seguida de 8 números.";
} elseif ($id == "Profesor") {
	$id_description = " L seguida de 8 números.";
}

$nombreError = null;
$apellidoPError = null;
$apellidoMError = null;
$correoError = null;
$matriculaError = null;

if (!empty($_POST)) {

	// Obtain data
	$nombre = $_POST['nombre'];
	$apellidoP = $_POST['apellidoP'];
	$apellidoM = $_POST['apellidoM'];
	$correo = $_POST['correo'];
	$matricula = $_POST['matricula'];

	// Validate input
	$valid = true;

	if (empty($nombre)) {
		$nombreError = 'Ingresa un nombre para continuar';
		$valid = false;
	}
	if (empty($apellidoP)) {
		$apellidoPError = 'Ingresa un apellido paterno para continuar';
		$valid = false;
	}
	if (empty($apellidoM)) {
		$apellidoMError = 'Ingresa un apellido materno para continuar';
		$valid = false;
	}
	if (empty($correo)) {
		$correoError = 'Ingresa un correo para continuar';
		$valid = false;
	}
	if (empty($matricula) || strlen($matricula) != 9 || ($id == "Estudiante" and $matricula[0] != "A") || ($id == "Profesor" and $matricula[0] != "L") || ($id == "Juez" and $matricula[0] != "X")) {
		$matriculaError = 'Ingresa una matrícula correcta para continuar.';
		$valid = false;
	}

	// Insert data
	if ($valid) {

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Delete data
		if ($matricula[0] == "A" and strlen($matricula) == 9) {
			$sql2 = 'INSERT INTO estudiante (id_estudiante, nombre, apellido_paterno, apellido_materno, correo) values(?, ?, ?, ?, ?)';
			$q2 = $pdo->prepare($sql2);
			$q2->execute(array($matricula, $nombre, $apellidoP, $apellidoM, $correo));
			Database::disconnect();
			header("Location: http://localhost/Web_ExpoIngenierias/inicioadmin/admin_start.php");

		} elseif ($matricula[0] == "L") {
			$sql4 = 'INSERT INTO profesor (id_profesor, nombre, apellido_paterno, apellido_materno, correo) values(?, ?, ?, ?, ?)';
			$q4 = $pdo->prepare($sql4);
			$q4->execute(array($matricula, $nombre, $apellidoP, $apellidoM, $correo));
			Database::disconnect();
			header("Location: http://localhost/Web_ExpoIngenierias/inicioadmin/admin_start.php");

		} elseif ($matricula[0] == "X") {
			$sql5 = 'INSERT INTO juez (id_juez, nombre, apellido_paterno, apellido_materno, correo) values(?, ?, ?, ?, ?)';
			$q5 = $pdo->prepare($sql5);
			$q5->execute(array($matricula, $nombre, $apellidoP, $apellidoM, $correo));
			Database::disconnect();
			header("Location: http://localhost/Web_ExpoIngenierias/inicioadmin/admin_start.php");
		}

		/*$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'INSERT INTO estudiante (id_estudiante, nombre, apellido_paterno, apellido_materno, correo) values(?, ?, ?, ?, ?)';
		$q = $pdo->prepare($sql);

		$q->execute(array($matricula, $nombre ,$apellidoP, $apellidoM, $correo));

		Database::disconnect();
		header("Location: admin_start.php");*/
	}
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

	<title>MiAdmin</title>
	<link rel="icon" href="../src/img/icon_admin.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="../src/css/common_create.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!-- Barra de navegación lista -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="" class="material-icons">person</a>
				<a id="navbarIcon" href="admin_assign.php" class="material-icons">rate_review</a>
				<a id="navbarIcon" href="admin_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_admin.svg">
			<!-- <a href="">Crear proyectos</a> -->
			<a href="admin_start.php"><span class="material-icons">home</span>MiAdmin</a>
		</div>
	</navbar>

	<form class="divfix" action="admin_create.php" method="post">
		<table width="100%">
			<tr>
				<td>
					<p class="create_paragraph"><strong> Nombre(s) y apellidos</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="nombre" name="nombre" required maxlength="30" placeholder="  Nombre(s)"
						size="50" class="input" value="<?php echo !empty($nombre) ? $nombre : ''; ?>">
					<?php if (($nombreError != null)) ?>
					<span class="help-inline"><?php echo $nombreError; ?></span>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="apellidoP" name="apellidoP" required maxlength="30"
						placeholder="  Apellido Pat." size="50" class="input2"
						value="<?php echo !empty($apellidoP) ? $apellidoP : ''; ?>"><input type="text" id="apellidoM"
						name="apellidoM" required maxlength="30" placeholder="  Apellido Mat." size="50" class="input2"
						value="<?php echo !empty($apellidoM) ? $apellidoM : ''; ?>">
					<?php if (($apellidoPError != null)) ?>
					<span class="help-inline"><?php echo $apellidoPError; ?></span>
					<?php if (($apellidoPError != null)) ?>
					<span class="help-inline"><?php echo $apellidoMError; ?></span>
				</td>
			</tr>

			<tr>
				<td>
					<p class="create_paragraph"><strong> Correo electrónico</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="correo" name="correo" required maxlength="30" placeholder="  Correo"
						size="70" class="input">
					<?php if (($correoError != null)) ?>
					<span class="help-inline"><?php echo $correoError; ?></span>
				</td>
			</tr>

			<tr>
				<td>
					<p class="create_paragraph"><strong> Matrícula</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="matricula" name="matricula" required maxlength="30" placeholder="  XXXXXXXXX"
						placeholder="<?php echo $id_description ?>" size="70" class="input"
						value="<?php echo !empty($matricula) ? $matricula : ''; ?>">
					<?php if (($matriculaError != null)) ?>
					<span class="help-inline"><?php echo $matriculaError; ?></span>
				</td>
			</tr>

			<tr>
				<td style="height: 15px;">
				</td>
			</tr>

			<tr>
				<td class="button_create" style="width: 33.33%;">
					<button class="botonfinal" id="botonfinal" type="submit">
						<strong>Crear cuenta</strong>
					</button>
				</td>
			</tr>

			<tr>
				<td style="height: 15px;">

				</td>
			</tr>

			<tr>
				<td class="botonborde2" style="width: 33.33%;"><button class="botonfinal2"><strong><a
								href="admin_start.php" class="alv">Regresar</a></strong></button>
				</td>
			</tr>

		</table>
	</form>

	<p class="footer">@2023 <a href="https://tec.mx/es"> Tecnológico de Monterrey.</a></p>

</body>

</html>