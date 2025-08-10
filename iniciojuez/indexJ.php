<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MiJuez</title>
	<link rel="icon" href="../src/img/miniicon.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!--Nueva barra de navegación-->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="cerrarsesion.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_judge.svg">
			<a href="indexJ.php"><span class="material-symbols-outlined"><link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></span>MiJuez</a>
		</div>
	</navbar>

	<div style="color:#082460">
		<?php
		$id = null;
		$id = $_REQUEST['id'];
		if (!empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}

		if ($id == null) {
			header("Location: indexJ.php");
		}

		include 'database.php';
		$pdo = Database::connect();
		$sql = 'SELECT estudiante.nombre AS nombrelider, estudiante.apellido_paterno, estudiante.apellido_materno, proyecto.id_proyecto, proyecto.nombre, califica.id_juez, categoria.nombre As cat, califica.calificacion, proyecto.link_archivo FROM estudiante, proyecto, categoria, califica  WHERE proyecto.lider = estudiante.id_estudiante And proyecto.id_categoria = categoria.id_categoria AND proyecto.id_proyecto = califica.id_proyecto AND califica.id_juez="' . $id . '"';

		echo '<center>';
		echo '<div id="bigdiv">';

		$idNegro = 1;

		foreach ($pdo->query($sql) as $row) {

			echo '<div id="Renglon2">';
			echo '<span>' . 'PROYECTO ' . $idNegro . '</span>';
			echo '</div>';
			echo '<div id="Renglon" >';
			echo '<div style = "width : 20%"><span>' . $row['nombre'] . '</span> </div>';
			echo '<div style = "width : 9%"><span>' . $row['id_proyecto'] . '</span></div>';
			echo '<div style = "width : 18%"><span>' . $row['nombrelider'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . '</span></div>';
			echo '<div style = "width : 12%"><span>' . $row['cat'] . '</span></div>';
			echo '<div style = "width : 1%"><span>' . $row['calificacion'] . '</span></div>';
			echo '<div class="botones">';
			echo '<a href="' . $row['link_archivo'] . '" style="color:#FFFFFF" id="text1">Visualizar proyecto</a>';
			echo '<a href="rubrica.php?id=' . $row['id_proyecto'] . '" style="color:#FFFFFF" id="text1">Rubrica</a>';
			echo '<a href="comentarios.php?id=' . $row['id_proyecto'] . '" style="color:#FFFFFF" id="text1">C/R</a>';
			echo '</div>';
			echo '  </div>';
			$idNegro = $idNegro + 1;
			session_start();
			$_SESSION['color'] = $row['id_juez'];
		}

		echo '</div>';
		echo '</center>';

		Database::disconnect();

		?>
	</div>
</body>


</html>