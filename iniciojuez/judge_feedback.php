<?php
session_start();
$_SESSION['color'];
$color = $_SESSION['color'];
require '../src/php/database.php';
$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ($id == null) {
	header("Location: judge_start.php?id=$color");
}

$q5Error = NULL;

if (!empty($_POST)) {

	$q5 = $_POST['q5'];
	$valid = true;

	if ($valid) {

		$result1 = $q5;

		if ($result1 == NULL) {
			$result1 = "Sin comentarios";
		}

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql1 = "UPDATE califica set retro_juez = ?  WHERE id_proyecto = ?";
		$q1 = $pdo->prepare($sql1);
		$q1->execute(array($result1, $id));
		Database::disconnect();
		header("Location: judge_start.php?id=$color");

	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * califica where id_proyecto = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$id = $data['id_proyecto'];
		Database::disconnect();
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

	<title>MiJuez</title>
	<link rel="icon" href="../src/img/icon_judge.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/judge_common.css">
	<link rel="stylesheet" href="css/judge_feedback.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!--Nueva barra de navegación-->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="judge_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_judge.svg">
			<a href="judge_start.php"><span class="material-icons">home</span>MiJuez</a>
		</div>
	</navbar>

	<form class="form-horizontal" action="judge_feedback.php?id=<?php echo $id ?>" method="post">
		<center>
			<td style="width: 45%;">
				<h2 style="color:#082460">
					<center>
						Comentarios y retroalimentación
					</center>
				</h2>
			</td>
			<tr>
				<td>
					<input class=" input2" name="q5" style="width: 100% height: 100% "></input>
				</td>
			</tr>
		</center>

		<center>
			<tr>
				<td style="text-align: center;">
					<button type="submit" style="color:#FFFFFF" class="btn"><strong>Enviar</strong></button>
				</td>

			</tr>
		</center>

	</form>

	<tr>
		<a href="judge_start.php?id=<?php echo $color; ?>" style="color:#FFFFFF" class="btn"
			id="btnreturn"><strong>Atrás</strong>
		</a>
	</tr>

</body>

</html>