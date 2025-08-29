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

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

	<title>MiProfesor</title>
	<link rel="icon" href="../src/img/icon_prof.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="../src/css/common_delete.css">
	<link rel="stylesheet" href="css/prof_common.css">
	<link rel="stylesheet" href="css/prof_reject.css">

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

	<div class="center">
		<div class="center2">
			<div>
				<h3>Rechazar Proyecto</h3>
			</div>

			<form action="prof_reject.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<p class="subtitle_delete">¿Estás seguro de que quieres rechazar este proyecto?</p>
			
				<div>
					<button style="width: 3%;" class="button_reject" id="button_reject" type="submit">Sí</button>
					<a style="width: 3%; heigth:3%;" href="prof_view.php?id=<?php echo $id; ?>">No</a>
				</div>
			</form>

		</div>
	</div>
</body>

</html>