<?php

require '../src/php/database.php';

$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ($id == null) {
	header("Location: admin_start.php");
}

if ($id[0] == "A") {
	$user_type = " Estudiante";
} elseif ($id[0] == "L") {
	$user_type = " Profesor";
} elseif ($id[0] == "X") {
	$user_type = " Juez";
}

if (!empty($_POST)) {

	// Keep track of validation errors
	$idError = null; // id as id_estudiante
	$nombreError = null;
	$apellidoPError = null;
	$apellidoMError = null;
	$correoError = null;

	// Keep track of post values
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$apellidoP = $_POST['apellidoP'];
	$apellidoM = $_POST['apellidoM'];
	$correo = $_POST['correo'];

	echo $id;
	echo $nombre;
	echo $apellidoP;
	echo $apellidoM;
	echo $correo;

	// Validate input
	$valid = true;

	/*if (empty($idError)) {
		$idError = 'Lorem Ipsum.';
		$valid = false;
	}*/

	if (empty($nombre)) {
		$nombreError = 'Por favor escribe tu nombre';
		$valid = false;
	}
	if (empty($apellidoP)) {
		$apellidoPError = 'Por favor escribe tu apellido paterno';
		$valid = false;
	}
	if (empty($apellidoM)) {
		$apellidoMError = 'Por favor escribe tu apellido materno';
		$valid = false;
	}
	if (empty($correo)) {
		$correoError = 'Por favor escribe tu correo';
		$valid = false;
	}

	// Update data
	if ($valid) {

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($id[0] == "A") {
			$sql2 = "UPDATE estudiante  set nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo= ? WHERE id_estudiante = ?";
			$q2 = $pdo->prepare($sql2);
			$q2->execute(array($nombre, $apellidoP, $apellidoM, $correo, $id));
		} elseif ($id[0] == "L") {

			$sql4 = "UPDATE profesor set nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo= ? WHERE id_profesor = ?";
			$q4 = $pdo->prepare($sql4);
			$q4->execute(array($nombre, $apellidoP, $apellidoM, $correo, $id));
		} elseif ($id[0] == "X") {
			//$id = ltrim($id, 'X');

			$sql5 = "UPDATE juez set nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo= ? WHERE id_juez = ?";
			$q5 = $pdo->prepare($sql5);
			$q5->execute(array($nombre, $apellidoP, $apellidoM, $correo, $id));
		}

		Database::disconnect();
		header("Location: admin_start.php");

		/*$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE estudiante  set nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo= ? WHERE id_estudiante = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($nombre,$apellidoP,$apellidoM,$correo, $id));
		Database::disconnect();
		header("Location: admin_start.php");*/
	}

} else {

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if ($id[0] == "A") {
		$sql2 = "SELECT * FROM estudiante where id_estudiante = ?";
		$q2 = $pdo->prepare($sql2);
		$q2->execute(array($id));
		$data = $q2->fetch(PDO::FETCH_ASSOC);
		$id = $data['id_estudiante'];
		$nombre = $data['nombre'];
		$apellidoP = $data['apellido_paterno'];
		$apellidoM = $data['apellido_materno'];
		$correo = $data['correo'];

	} elseif ($id[0] == "L") {
		$sql4 = "SELECT * FROM profesor where id_profesor = ?";
		$q4 = $pdo->prepare($sql4);
		$q4->execute(array($id));
		$data = $q4->fetch(PDO::FETCH_ASSOC);
		$id = $data['id_profesor'];
		$nombre = $data['nombre'];
		$apellidoP = $data['apellido_paterno'];
		$apellidoM = $data['apellido_materno'];
		$correo = $data['correo'];

	} elseif ($id[0] == "X") {
		//$id = ltrim($id, 'X');
		$sql5 = "SELECT * FROM juez where id_juez = ?";
		$q5 = $pdo->prepare($sql5);
		$q5->execute(array($id));
		$data = $q5->fetch(PDO::FETCH_ASSOC);
		$id = $data['id_juez'];
		$nombre = $data['nombre'];
		$apellidoP = $data['apellido_paterno'];
		$apellidoM = $data['apellido_materno'];
		$correo = $data['correo'];
		//$id = 'X'.$id;
	}

	Database::disconnect();
	//header("Location: admin_start.php");

	/*
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM estudiante where id_estudiante = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$id 	= $data['id_estudiante'];
	$nombre = $data['nombre'];
	$apellidoP = $data['apellido_paterno'];
	$apellidoM = $data['apellido_materno'];
	$correo = $data['correo'];
	Database::disconnect();*/
}
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

	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/admin_common.css">
	<link rel="stylesheet" href="css/admin_common2.css">

	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
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
			<a href=""><?php echo "Modificar" . $user_type ?></a>
			<a href="admin_start.php"><span class="material-icons">home</span>MiAdmin</a>
		</div>
	</navbar>

	<div class="center">
		<div class="center2">
			<form class="form" action="admin_edit.php?id=<?php echo $id ?>" method="post">

				<!-- ID -->
				<div class="padding" <?php echo !empty($f_idError) ? 'error' : ''; ?>>

					<label class="subtitulo1">ID</label>
					<div class="padding2">
						<input class="input" name="id" type="text" readonly
							value="<?php echo !empty($id) ? $id : ''; ?>">
						<?php if (!empty($f_idError)): ?>
							<span><?php echo $f_idError; ?></span>
						<?php endif; ?>
					</div>
				</div>

				<!-- Nombre -->
				<div class="padding" <?php echo !empty($nombreError) ? 'error' : ''; ?>>

					<label class="subtitulo1">Nombre</label>

					<div class="padding2">
						<input class="input" name="nombre" type="text"
							value="<?php echo !empty($nombre) ? $nombre : ''; ?>">
						<?php if (!empty($nombreError)): ?>
							<span><?php echo $nombreError; ?></span>
						<?php endif; ?>
					</div>
				</div>

				<!-- Apellido paterno -->
				<div class="padding" <?php echo !empty($apellidoPError) ? 'error' : ''; ?>>

					<label class="subtitulo1">Apellido paterno</label>
					<div class="padding2">
						<input class="input" name="apellidoP" type="text"
							value="<?php echo !empty($apellidoP) ? $apellidoP : ''; ?>">
						<?php if (!empty($apellidoPError)): ?>
							<span><?php echo $apellidoPError; ?></span>
						<?php endif; ?>
					</div>
				</div>

				<!-- Apellido materno -->
				<div class="padding" <?php echo !empty($apellidoMError) ? 'error' : ''; ?>>

					<label class="subtitulo1">Apellido materno</label>
					<div class="padding2">
						<input class="input" name="apellidoM" type="text"
							value="<?php echo !empty($apellidoM) ? $apellidoM : ''; ?>">
						<?php if (!empty($apellidoMError)): ?>
							<span><?php echo $apellidoMError; ?></span>
						<?php endif; ?>
					</div>
				</div>

				<!-- Correo -->
				<div class="padding" <?php echo !empty($correoError) ? 'error' : ''; ?>>
					<label class="subtitulo1">Correo electrónico</label>
					<div class="padding2">
						<input class="input" name="correo" type="text"
							value="<?php echo !empty($correo) ? $correo : ''; ?>">
						<?php if (!empty($correoError)): ?>
							<span><?php echo $correoError; ?></span>
						<?php endif; ?>
					</div>
				</div>

				<br>
				<div class="center2">
					<a style="text-decoration:none;" class="boton" href="admin_start.php">Regresar</a>
					<button type="submit" class="boton">Actualizar</button>
				</div>
			</form>
		</div>

	</div>
</body>

</html>