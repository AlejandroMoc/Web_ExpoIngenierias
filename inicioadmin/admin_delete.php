<?php
require '../src/php/database.php';

// Initialize ID variable and request ID
$id = 0;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

// Determine user type based on ID prefix
if ($id[0] == "A") {
	$user_type = " Estudiante";
} elseif ($id[0] == "L") {
	$user_type = " Profesor";
} elseif ($id[0] == "X") {
	$user_type = " Juez";
}

// Check if the form has been submitted (POST request)
if (!empty($_POST)) {

	// Get ID from POST request and connect to database
	$id = $_POST['id'];
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Perform delete operation based on user type (first letter of ID)
	if ($id[0] == "A") {
		$id = $_POST['id'];
		$sql2 = "DELETE FROM estudiante WHERE id_estudiante = ?";
		$q2 = $pdo->prepare($sql2);
		$q2->execute(array($id));
	
	} elseif ($id[0] == "L") {
		$id = $_POST['id'];
		$sql4 = "DELETE FROM profesor WHERE id_profesor = ?";
		$q4 = $pdo->prepare($sql4);
		$q4->execute(array($id));
	
	} elseif ($id[0] == "X") {
		$id = $_POST['id'];
		$sql5 = "DELETE FROM juez WHERE id_juez = ?";
		$q5 = $pdo->prepare($sql5);
		$q5->execute(array($id));
	}

	// Disconnect from the database and redirect
	header("Location: admin_start.php");
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
	<link rel="stylesheet" href="../src/css/common_delete.css">
	<link rel="stylesheet" href="css/admin_common.css">
	<link rel="stylesheet" href="css/admin_delete.css">

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
			<a href=""><?php echo "Eliminar" . $user_type ?></a>
			<a href="admin_start.php"><span class="material-icons">home</span>MiAdmin</a>
		</div>
	</navbar>

	<div class="center">
		<div class="center2">
			<form class="form-horizontal" action="admin_delete.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<p class="subtitle_delete">¿Estás seguro de que quieres eliminar a este Usuario?</p>
				
				<div class="form-actions">
					<button class="button_delete" type="submit">Sí</button>
					<a style="text-decoration: none;" class="button_admin" href="admin_start.php">No</a>
				</div>
			</form>
		</div>
	</div>
</body>

</html>