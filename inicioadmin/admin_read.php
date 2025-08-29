<?php
require '../src/php/database.php';
$id = null;

//Request ID if necessary
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

// Assign user_type based on ID
if ($id[0] == "A") {
	$user_type = " Estudiante";
} elseif ($id[0] == "L") {
	$user_type = " Profesor";
} elseif ($id[0] == "X") {
	$user_type = " Juez";
}

if ($id == null) {
	header("Location: admin_delete.php");
} else {

	$cont = 0;
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Select student data from database (based on ID)
	if ($id[0] == "A") {
		$sql2 = "SELECT * FROM estudiante WHERE id_estudiante = ?";
		$q2 = $pdo->prepare($sql2);
		$q2->execute(array($id));
		$data = $q2->fetch(PDO::FETCH_ASSOC);
	
	} elseif ($id[0] == "L") {
		$sql4 = "SELECT * FROM profesor WHERE id_profesor = ?";
		$q4 = $pdo->prepare($sql4);
		$q4->execute(array($id));
		$data = $q4->fetch(PDO::FETCH_ASSOC);
	
	} elseif ($id[0] == "X") {
		$cont = 1;
		$sql5 = "SELECT * FROM juez WHERE id_juez = ?";
		$q5 = $pdo->prepare($sql5);
		$q5->execute(array($id));
		$data = $q5->fetch(PDO::FETCH_ASSOC);
	}
	Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

	<title>MiAdmin</title>
	<link rel="icon" href="../src/img/icon_admin.png">

	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/admin_common.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!-- Barra de navegación lista -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbar_icon_container">
				<a id="navbar_icon" href="" class="material-icons">person</a>
				<a id="navbar_icon" href="admin_assign.php" class="material-icons">rate_review</a>
				<a id="navbar_icon" href="admin_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbar_blue">
			<img src="../src/img/logo_expo_admin.svg">
			<a href=""><?php echo "Detalles del" . $user_type ?></a>
			<a href="admin_start.php"><span class="material-icons">home</span>MiAdmin</a>
		</div>
	</navbar>

	<div class="container">

		<div class="span10 offset1">
			<div class="form-horizontal">
				
				<!-- MATRICULA -->
				<?php

				if ($id[0] == "A") {
					echo '<div class="control-group">';
					echo '<label class="control-label">Matrícula</label>';
					echo '<div class="controls">';
					echo '<label class="checkbox">';
					echo $data['id_estudiante'];
					echo '</label>';
					echo '</div>';
					echo '</div>';

				} elseif ($id[0] == "L" and $cont == 0) {
					echo '<div class="control-group">';
					echo '<label class="control-label">Matrícula</label>';
					echo '<div class="controls">';
					echo '<label class="checkbox">';
					echo $data['id_profesor'];
					echo '</label>';
					echo '</div>';
					echo '</div>';

				} elseif ($cont == 1) {
					echo '<div class="control-group">';
					echo '<label class="control-label">Identificador</label>';
					echo '<div class="controls">';
					echo '<label class="checkbox">';
					echo $data['id_juez'];
					echo '</label>';
					echo '</div>';
					echo '</div>';
				}

				?>
				<!-- Nombre -->
				<div class="control-group">
					<label class="control-label">Nombre(s)</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['nombre']; ?>
						</label>
					</div>
				</div>
				<!-- Apellido Paterno -->
				<div class="control-group">
					<label class="control-label">Apellido Paterno</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['apellido_paterno']; ?>
						</label>
					</div>
				</div>
				<!-- Apellido Materno -->
				<div class="control-group">
					<label class="control-label">Apellido Materno</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['apellido_materno']; ?>
						</label>
					</div>
				</div>
				<!-- Correo -->
				<div class="control-group">
					<label class="control-label">Correo</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['correo']; ?>
						</label>
					</div>
				</div>

				<div class="form-actions">
					<a class="btn" href="admin_start.php">Regresar</a>
				</div>

			</div>
		</div>
	</div>
</body>

</html>