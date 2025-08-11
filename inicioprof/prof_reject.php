<?php
session_start();
$_SESSION['color'];

$color = $_SESSION['color'];
require '../src/php/database.php';

if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if (!empty($_POST)) {
	// Keep track of post values
	$id = $_POST['id'];

	// Delete data
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql1 = "UPDATE status Set status='Rechazado' WHERE id_proyecto = ?";
	$q1 = $pdo->prepare($sql1);
	$q1->execute(array($id));
	Database::disconnect();
	header("Location: prof_start.php?id=$color");
}

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
			<a href="prof_read.php?id=<?php echo $color; ?>"><span class="material-icons">person</span></a>
		</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_prof.svg">
			<a href="prof_start.php?id=<?php echo $color; ?>"><span class="material-icons">home</span>MiProfesor</a>
		</div>
	</navbar>

	<br>

	<center>
		<div class="center">
			<div class="center2">
				<div>
					<h3 class="titulo1">Rechazar Proyecto</h3>
				</div>

				<form action="prof_reject.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<p class="subtitulo2">¿Estás seguro de que quieres rechazar este proyecto?</p>
					<br>
					<div>
						<button style="width: 3%;" class="botonfinalD" id="botonfinalD" type="submit">Si</button>
						<a style="width: 3%; heigth:3%;" href="prof_view.php?id=<?php echo $id; ?>">No</a>
					</div>
				</form>

			</div>
		</div>
		</div>
	</center>
</body>

</html>