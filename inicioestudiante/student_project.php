<?php
session_start();
require '../src/php/database.php';
$id = null;
// $idjuez=  null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}
/*if ( !empty($_GET['idjuez'])) {
	$id = $_REQUEST['idjuez'];
}*/
if ($id == null) {
	header("Location: index.php");
} else {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT id_proyecto AS proyecmat FROM proyecto status WHERE id_proyecto=?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
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
	<link rel="icon" href="../src/img/icon_student.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/student_start.css">

	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>MiEstudiante</title>
</head>



<link rel="stylesheet" href="css/student_index.css">

<body>
	<!--Nueva barra de navegación-->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="student_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_student.svg">
			<a href="student_project.php"><span class="material-icons">home</span>MiEstudiante</a>
		</div>
	</navbar>

	<!--Información proyecto-->
	<div>

		<!--Objeto con un contenedor-->
		<form class="paddingcontenedor">

			<!--Tipo de proyecto; Campus Puebla-->
			<table width="100%" class="expobanner1">
				<tr>
					<td>
						<div class="expotexto2">
							<p>Tipo de proyecto</p>
						</div>
					</td>

					<td>
						<div class="expotexto3">
							<p>Campus Puebla</p>
						</div>
					</td>
				</tr>
			</table>

			<!--Descripción proyecto, Nombre proyecto-->
			<table class="expobanner2">
				<tr>

					<td>
						<div class="expotexto4" style="width:45%">
							<p>
								<?php
								$pdo3 = Database::connect();
								$sql3 = 'SELECT proyecto.descripcion AS descri FROM proyecto, estudiante  WHERE  proyecto.lider = estudiante.id_estudiante  AND proyecto.id_proyecto="' . $id . '"';
								foreach ($pdo3->query($sql3) as $rows) {
									echo $rows['descri'];
								}
								Database::disconnect();

								?>
							</p>
						</div>
					</td>
					<td class="expotexto5">
						<div>
							<p>
								<?php
								$pdo3 = Database::connect();
								$sql3 = 'SELECT proyecto.nombre AS nombreproye FROM proyecto, estudiante  WHERE  proyecto.lider = estudiante.id_estudiante  AND proyecto.id_proyecto="' . $id . '"';
								foreach ($pdo3->query($sql3) as $rows) {
									echo $rows['nombreproye'];
								}
								Database::disconnect();

								?>
							</p>
						</div>
					</td>
				</tr>
			</table>
		</form>

		<!--Info detallada-->
		<table width="100%" class="tablainfo1">

			<tr>
				<td style="width:50%" class="celdacolor">
					<h class="expotexto6">Revisión</h>

					<p class="expotexto7">
						Calificación final
					</p>

					<p class="expotexto10"></p>
					<table class="expotexto10" width="60%" style=border:0;>
						<?php

						$pdo3 = Database::connect();
						$sql3 = 'SELECT califica.calificacion FROM califica WHERE  califica.id_proyecto="' . $id . '"';

						foreach ($pdo3->query($sql3) as $rows) {
							if ($rows['calificacion'] == NULL) {
								echo 'PENDIENTE';
							} else {
								echo '<td>' . $rows['calificacion'] . '</td>';
								echo '</tr>';
							}
						}
						Database::disconnect();

						?>
					</table>

					<p class="expotexto7">
						Juez asignado(a)
					</p>
					<table class="expotexto10" width="60%" style=border:0;>
						<?php

						$pdo3 = Database::connect();
						$sql3 = 'SELECT juez.nombre AS nomj, juez.apellido_paterno AS apellPj, juez.apellido_materno AS apellMj FROM   juez,califica WHERE juez.id_juez = califica.id_juez AND califica.id_proyecto="' . $id . '"';

						foreach ($pdo3->query($sql3) as $rows) {

							echo '<td>' . $rows['nomj'] . ' ' . $rows['apellPj'] . ' ' . $rows['apellMj'] . '</td>';
							echo '</tr>';
						}
						Database::disconnect();

						?>
					</table>
				</td>

				<td rowspan="2" colspan="2" style="width:50%" class="celdacolor">
					<h class="expotexto6"> Rúbrica de evaluación </h>

					<p class="expotexto7">
						Proyecto grupal
						<br>
					</p>

					<table class="expotexto8">
						<tr class="expotexto7">

							<th align=center>Parámetros</th>
							<th align=center>Descripción</th>
						</tr>

						<tr>
							<th align=center>1</th>
							<th class="expotexto9" style="width:70%">
								Utilidad: El proyecto resuelve un problema actual en el área de
								interpes y/o el proyecto da alta prioridad al cleinte quien queda ampliamente satisfecho
							</th>
						</tr>

						<tr>
							<th align=center>2</th>
							<th class="expotexto9">
								Impacto e innovación: El proyecto presenta una idea nueva e impacta positivamente en el
								área de interés y/o
								el producto presenta una idea nueva e incrementa la productividad
							</th>
						</tr>

						<tr>
							<th align=center>3</th>
							<th class="expotexto9">
								Desarrollo experimental o técnico y/o resultados o producto final: Ausiencia de errores
								técnicos los
								resultados
								y/o producto resuelven el problema propuestos
							</th>
						</tr>

						<tr>
							<th align=center>4</th>
							<th class="expotexto9">
								Impacto e innovación: Claridad y precisión de ideas: La presentación es concreta y clara
							</th>
						</tr>

						<tr>
							<th align=center>5</th>
							<th class="expotexto9">
								Respuestas a preguntas: Respuestas precisas de acuerdo al diseño, al estado de avance
								del proyecto, al
								impactoy
								a los resultados obtenidos
							</th>
						</tr>
					</table>

			<tr>
				<td class="celdacolor">

					<h class="expotexto6">Información del proyecto</h>

					<p class="expotexto7">Categoría</p>
					<p class="expotexto10"></p>
					<?php

					$pdo3 = Database::connect();
					$sql3 = 'SELECT categoria.nombre AS cat2 FROM categoria, proyecto  WHERE  proyecto.id_categoria = categoria.id_categoria  AND proyecto.id_proyecto="' . $id . '"';

					foreach ($pdo3->query($sql3) as $rows) {
						echo $rows['cat2'];
					}

					Database::disconnect();
					?>

					<p class="expotexto7">Líder del proyecto</p>
					<p class="expotexto10"></p>

					<?php

					$pdo3 = Database::connect();
					$sql3 = 'SELECT estudiante.nombre AS name, estudiante.apellido_paterno AS apellPl, estudiante.apellido_materno AS apellMl FROM proyecto, estudiante  WHERE  proyecto.lider = estudiante.id_estudiante  AND proyecto.id_proyecto="' . $id . '"';

					foreach ($pdo3->query($sql3) as $rows) {
						echo $rows['name'] . ' ' . $rows['apellPl'] . ' ' . $rows['apellMl'];
					}
					Database::disconnect();
					?>

					<p class="expotexto7">Integrantes del equipo</p>

					<table class="expotexto10" width="60%" style=border:0;>
						<?php

						$pdo3 = Database::connect();
						$sql3 = 'SELECT estudiante.nombre AS nom, estudiante.apellido_paterno AS apell, estudiante.apellido_materno AS apell2 from estudiante, miembrosProyecto WHERE estudiante.id_estudiante = miembrosProyecto.id_estudiante AND miembrosProyecto.id_proyecto="' . $id . '"';

						foreach ($pdo3->query($sql3) as $rows) {

							echo '<td>' . '<strong>-</strong>' . $rows['nom'] . ' ' . $rows['apell'] . ' ' . $rows['apell2'] . '</td>';
							echo '</tr>';
						}
						Database::disconnect();

						?>
					</table>

				</td>
			</tr>

			<tr>
				<td class="celdacolor" colspan="2">

					<h class="expotexto6"> Comentarios y retroalimentación </h>
					<p class="expotexto7">Profesor</p>
					<p class="expotexto10"></p>
					
					<?php

					$pdo3 = Database::connect();
					$sql3 = 'SELECT status.retroprof FROM status WHERE  status.id_proyecto="' . $id . '"';

					foreach ($pdo3->query($sql3) as $rows) {
						if ($rows['retroprof'] == NULL) {
							echo 'SIN COMENTARIOS';
						} else {
							echo $rows['retroprof'];
							echo "<br>";
						}
					}
					Database::disconnect();
					?>

					<p class="expotexto7">Juez</p>
					
					<?php

					$pdo3 = Database::connect();
					$sql3 = 'SELECT califica.retro_juez FROM califica WHERE  califica.id_proyecto="' . $id . '"';

					foreach ($pdo3->query($sql3) as $rows) {
						if ($rows['retro_juez'] == NULL) {
							echo 'EN ESPERA';
						} else {
							echo $rows['retro_juez'];
							echo '</tr>';
						}
					}
					Database::disconnect();

					?>
				</td>
			</tr>
		</table>
	</div>

	<!--
		<div class="expobanner22">
			<div class="expofondo">
				<img src="/images/img-principal.png" alt="" height="100px">
				<div class="expotexto">
					<h1><b>Your Title</b></h1>
					<p>The information you want to present.</p>
					</a></p>
				</div>
			</div>            
		</div>
		-->

	<div id="footerline">

	</div>
	<!--Footer-->
	<div id="footer">
		<!--Footer izquierdo-->
		<!-- <h3 class="footerizquierdo">Copyright Stuff.</h3> -->

		<!--Footer derecho-->
		<p class="footerderecho">©2023 Tecnológico de Monterrey. Todos los derechos reservados.</p>
		<div style="clear: both"></div>
	</div>

</body>

</html>