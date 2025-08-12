<?php
session_start();
$_SESSION['color'];

$color = $_SESSION['color'];
require '../src/php/database.php';
$idError = null;
$proyectoError = null;


if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if (!empty($_POST)) {

	$id = $_POST['id'];
	$proyecto = $_POST['proyecto'];

	// Validate input
	$valid = true;
	if (empty($proyecto)) {
		$proyectoError = 'Ingresa una matrícula para continuar';
		$valid = false;
	}

	// Insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'INSERT INTO miembrosProyecto (id_proyecto, id_estudiante ) values(?, ?)';
		$q = $pdo->prepare($sql);
		$q->execute(array($proyecto, $id));
		Database::disconnect();
		header("Location: student_start.php?id=$color");
	}

}

?>

<!DOCTYPE html>
<html lang="es">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MiEstudiante</title>
	<link rel="icon" href="../src/img/icon_student.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/student_dani.css">

	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!-- Barra de navegación lista -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<a href="student_logout.php?id=<?php echo $color; ?>">
				<span class="material-icons">logout</span>Salir
			</a>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_student.svg">
			<a href="student_start.php?id=<?php echo $color; ?>"><span class="material-icons">home</span>MiEstudiante</a>
		</div>
	</navbar>

	<br>
	<h1 style="color: #082460">
		&nbsp &nbsp Unirme a un proyecto
	</h1>
	<br>
	<form class="form-horizontal" action="student_join_proyect.php?id=<?php echo $id ?>" method="post">
		<table align="center" style="width: 23%;">
			<tr style="width: 33.33%;">
				<td style="width: 33.33%;"></td>
				<td style="width: 33.33%;" class="tabh" align="center">
					<p style="color:#ffffff"><strong> Tu Matrícula</strong>
				</td>
				<td style="width: 33.33%;"></td>
			</tr>

			<tr>
				<td style="width: 33.33%;"></td>
				<td class="tabd" align="center"><input class="tabd" type="text" id="id" name="id" required
						maxlength="30" readonly placeholder="  AXXXXXXXX" size="70" class="input"
						value="<?php echo !empty($id) ? $id : ''; ?>">
					<?php if (($idError != null)) ?>
					<span class="help-inline"><?php echo $idError; ?></span>
				</td>
				<td style="width: 33.33%;"></td>
			</tr>


			<tr>
				<td style="width: 33.33%;"></td>
				<td style="width: 33.33%;" class="tabh" align="center">
					<p style="color:#ffffff"><strong> Id del Proyecto</strong>
				</td>
				<td style="width: 33.33%;"></td>
			</tr>

			<tr>
				<td style="width: 33.33%;"></td>
				<td style="width: 33.33%;" class="tabd" align="center"><input class="tabd" type="text" id="proyecto"
						name="proyecto" required maxlength="30" placeholder="  Identificador del proyecto" size="70"
						class="input">
					<?php if (($correoError != null)) ?>
					<span class="help-inline"><?php echo $proyectoError; ?></span>
				</td>
				<td style="width: 33.33%;"></td>
			</tr>

			<tr>
				<td style="height: 50px;">

				</td>
			</tr>

			<tr>
				<td style="width: 33.33%;"></td>
				<td align="center" class="botonbordeC" style="width: 33.33%;"><button align="center" class="botonfinalC"
						id="botonfinalC" type="submit"><strong>Crear cuenta</strong></button></td>
				<td style="width: 33.33%;"></td>
			</tr>

		</table>
	</form>
</body>

</html>