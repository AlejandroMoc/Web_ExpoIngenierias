<?php
require '../src/php/database.php';
$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}
if ($id == null) {
	header("Location: index.php");
} else {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM estudiante where id_estudiante = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}
session_start();
$_SESSION['color'] = $data['id_estudiante'];
$_SESSION['pro'] = "CU0201";
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
	<link rel="stylesheet" href="css/student_start.css">
	
	
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
			<a href="student_project.php"><span class="material-icons">home</span>MiEstudiante</a>
		</div>
	</navbar>

	<?php
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql9 = 'SELECT id_proyecto FROM proyecto where lider=?';
	$q9 = $pdo->prepare($sql9);
	$q9->execute(array($id));
	$data = $q9->fetch(PDO::FETCH_ASSOC);
	$idpp = $data['id_proyecto'];
	?>
	<?php
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql7 = 'SELECT id_proyecto FROM miembrosProyecto where id_estudiante=?';
	$q7 = $pdo->prepare($sql7);
	$q7->execute(array($id));
	$data = $q7->fetch(PDO::FETCH_ASSOC);
	$idpp = $data['id_proyecto'];

	?>
	<br>
	<h1 align="center" style="color: #082460">Bienvenido <?php echo $data['nombre'] ?></h1>
	<?php
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql5 = 'SELECT estudiante.id_estudiante
FROM estudiante
LEFT JOIN miembrosProyecto ON estudiante.id_estudiante = miembrosProyecto.id_estudiante
LEFT JOIN proyecto ON estudiante.id_estudiante = proyecto.lider
WHERE miembrosProyecto.id_estudiante IS NULL AND proyecto.lider IS NULL AND estudiante.id_estudiante = ?';

	$q5 = $pdo->prepare($sql5);
	$q5->execute(array($id));
	$data = $q5->fetch(PDO::FETCH_ASSOC);
	$h = $id;
	if ($h == $data['id_estudiante']) {
		echo '<H2  style="color: #082460">&nbsp &nbsp Aùn no te encuentras en ningun Proyecto</H2>';
		echo '<br>';
		echo '<center>';
		echo '<center>
        <table>
          <tr></tr>
          <tr>
          <td style="width: 4%;"> </td>
          <th align="center" class="botonbordeR" style="width: 12%;"><a style="text-decoration:none" href="student_create_project.php">
          <button align="center" class="botonfinalR" id="botonfinalR"><strong>Crear Proyecto</strong></button>
        </a></th>
            <td style="width: 4%;"> </td>
        
            <th align="center" class="botonbordeR" style="width: 10%;"><a style="text-decoration:none" href="student_join_proyect.php?id=' . $id . '">
            <button align="center" class="botonfinalR" id="botonfinalR"><strong>Unirme a un Proyecto</strong></button>
          </a></th>
            <td style="width: 7%;"> </td>
          
          </tr>
        </table>
        </center>';
	}
	?>
	<?php
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql5 = 'SELECT estudiante.id_estudiante
FROM estudiante
LEFT JOIN miembrosProyecto ON estudiante.id_estudiante = miembrosProyecto.id_estudiante
LEFT JOIN proyecto ON estudiante.id_estudiante = proyecto.lider
WHERE (miembrosProyecto.id_estudiante IS NOT NULL  OR proyecto.lider IS not NULl) AND estudiante.id_estudiante = ?';
	$q5 = $pdo->prepare($sql5);
	$q5->execute(array($id));
	$data = $q5->fetch(PDO::FETCH_ASSOC);
	$h = $id;
	if ($h == "A01327397") {
		echo '<H2  style="color: #082460">&nbsp &nbsp &nbsp &nbsp Estás inscrito en un proyecto</H2>';
		echo '<br>';
		echo '<center>';
		echo '<center>
        <table >
          <tr></tr>
          <tr>
          <td style="width: 4%;"> </td>
          <th align="center" class="botonbordeR" style="width: 1.2%;"><a style="text-decoration:none" href="student_project.php?id=' . $_SESSION['pro'] . '">
          <button align="center" class="botonfinalR" id="botonfinalR"><strong>Ver detalles</strong></button>
        </a></th>
            <td style="width: 4%;"> </td>

          
          </tr>
        </table>
        </center>';
	} else {
		echo '<H2  style="color: #082460">&nbsp &nbsp &nbsp &nbsp Estás inscrito en un proyecto</H2>';
		echo '<br>';
		echo '<center>';
		echo '<center>
      <table >
        <tr></tr>
        <tr>
        <td style="width: 4%;"> </td>
        <th align="center" class="botonbordeR" style="width: 1.2%;"><a style="text-decoration:none" href="student_project.php?id=' . $idpp . '">
        <button align="center" class="botonfinalR" id="botonfinalR"><strong>Ver detalles</strong></button>
      </a></th>
          <td style="width: 4%;"> </td>

        
        </tr>
      </table>
      </center>';
	}
	?>
</body>

</html>