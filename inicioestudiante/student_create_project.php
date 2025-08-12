<?php
session_start();
$_SESSION['color'];

$color = $_SESSION['color'];

// Variables
require '../src/php/database.php';

$nombreProyectoError = null;
$descripcionError = null;
$categoriaError = null;
$unidadFormacionError = null;
$linkarchivoError = null;
$liderError = null;
$idproyectoError = null;

if (!empty($_POST)) {

	$nombreProyecto = $_POST['nombreProyecto'];
	$descripcion = $_POST['descripcion'];
	$categoria = $_POST['categoria'];
	$unidadFormacion = $_POST['unidadFormacion'];
	$linkarchivo = $_POST['linkarchivo'];
	$idproyecto = $_POST['idproyecto'];
	$edicion = 2;
	$lider = $_POST['liderMenu'];

	// Validate input
	$valid = true;

	if (empty($nombreProyecto)) {
		$nombreProyectoError = 'Ingresa un nombre de proyecto';
		$valid = false;
	}
	if (empty($descripcion)) {
		$descripcionError = 'Ingresa una descripción del proyecto';
		$valid = false;
	}
	if (empty($categoria)) {
		$categoria = 'Selecciona una categoría';
		$valid = false;
	}
	if (empty($unidadFormacion)) {
		$unidadFormacion = 'Selecciona una categoría';
		$valid = false;
	}
	if (empty($linkarchivo)) {
		$linkarchivo = 'Selecciona una categoría';
		$valid = false;
	}
	if (empty($lider)) {
		$lider = 'Ingresa tu matrícula para continuar';
		$valid = false;
	}
	if (empty($idproyecto)) {
		$idproyecto = 'Ingresa tu matrícula para continuar';
		$valid = false;
	}

	// Insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'INSERT INTO proyecto (id_proyecto, nombre, lider, id_ufprof, id_categoria, id_edicion, link_archivo, descripcion) values(?, ?, ?, ?, ?, ?, ?, ?)';
		$q = $pdo->prepare($sql);
		$q->execute(array($idproyecto, $nombreProyecto, $lider, $unidadFormacion, $categoria, $edicion, $linkarchivo, $descripcion));
		Database::disconnect();
		$_SESSION["proyectomat"] = $idproyecto;
		header("Location: student_start.php?id=$color");
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

	<title>MiEstudiante</title>
	<link rel="icon" href="../src/img/icon_admin.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="../src/css/common_create.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!-- Barra de navegación lista -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="" class="material-icons">person</a>
				<!-- <a id="navbarIcon" href="" class="material-icons">rate_review</a> -->
				<a id="navbarIcon" href="student_logout.php" class="material-icons">logout</a>
			</div>
		</div>
		<navbar>
			<div id="navbarAzul">
				<img src="../src/img/logo_expo_student.svg">
				<a href="student_project.php"><span class="material-icons">home</span>MiEstudiante</a>
			</div>
		</navbar>

		<form class="divfix" action="student_create_project.php" method="post">
			<table width="100%">
				<tr>
					<td>
						<p class="create_paragraph"><strong>Nombre del proyecto </strong>
					</td>
				</tr>

				<tr>
					<td><input type="text" id="nombreProyecto" name="nombreProyecto" required maxlength="50"
							placeholder="   Ingresa el nombre del proyecto" size="50" class="input"
							value="<?php echo !empty($nombreProyecto) ? $nombreProyecto : ''; ?>">
						<?php if (($nombreProyectoError != null)) ?>
						<span class="help-inline"><?php echo $nombreProyectoError; ?></span>
					</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong>Descripción</strong>
					</td>
				</tr>

				<tr>
					<td><input type="text" id="descripcion" name="descripcion" required maxlength="400"
							placeholder="   Descripción del proyecto (máximo 300 caracteres)" size="70" class="input"
							value="<?php echo !empty($descripcion) ? $descripcion : ''; ?>">
						<?php if (($descripcionError != null)) ?>
						<span class="help-inline"><?php echo $descripcionError; ?></span>
					</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong>Categoría</strong>
					</td>
				</tr>

				<tr>
					<td>
						<div class="control-group <?php echo !empty($categoriaError) ? 'error' : ''; ?>">
							<select class="input" name="categoria">
								<option value="">Seleccionar</option>
								<?php
								$pdo = Database::connect();
								$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$query = 'SELECT * FROM categoria';
								foreach ($pdo->query($query) as $row) {
									echo '<option value=' . $row['id_categoria'] . '>' . $row['nombre'] . '</option>';
								}
								//Database::disconnect();
								?>
							</select>
							<?php if (($categoriaError) != null) ?>
							<span class="help-inline"><?php echo $categoriaError; ?></span>
						</div>
					</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong>Unidad de Formación y Profesor</strong>
					</td>
				</tr>

				<tr>
					<td>
						<div class="control-group <?php echo !empty($unidadFormacionError) ? 'error' : ''; ?>">
							<select class="input" name="unidadFormacion">
								<option value="">Seleccionar</option>
								<?php
								//$pdo = Database::connect();
								$query = 'SELECT * FROM profesor
													INNER JOIN ufProf ON ufProf.id_profesor = profesor.id_profesor';

								foreach ($pdo->query($query) as $row) {
									echo '<option value=' . $row['id_ufprof'] . '>' . $row['id_uf'] . ' - ' . $row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . '</option>';
								}
								//Database::disconnect();
								?>
							</select>
							<?php if (($unidadFormacionError) != null) ?>
							<span class="help-inline"><?php echo $unidadFormacionError; ?></span>

						</div>
					</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong>Líder del proyecto</strong>
					</td>
				</tr>

				<tr>
					<td>
						<div class="control-group <?php echo !empty($liderError) ? 'error' : ''; ?>">

							<select class="input" name="liderMenu">
								<option value="">Seleccionar</option>
								<?php
								//$pdo = Database::connect();
								$query = 'SELECT * FROM estudiante';
								foreach ($pdo->query($query) as $row) {
									echo '<option value=' . $row['id_estudiante'] . '>' . $row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . '</option>';
								}
								//Database::disconnect();
								?>
							</select>
							<?php if (($liderError) != null) ?>
							<span class="help-inline"><?php echo $liderError; ?></span>

						</div>
					</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong>ID del proyecto</strong>
					</td>
				</tr>

				<tr>
					<td><input type="text" id="idproyecto" name="idproyecto" required maxlength="8"
							placeholder="   Con este ID se uniran los miembros del equipo" size="50" class="input"
							value="<?php echo !empty($idproyecto) ? $idproyecto : ''; ?>">
						<?php if (($idproyectoError != null)) ?>
						<span class="help-inline"><?php echo $idproyectoError; ?></span>
					</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong>Cómo crear tu ID del proyecto:</strong>
					</td>
				</tr>

				<tr>
					<td>1. Escribe las 2 primeras letras
						del nombre de tu proyecto en mayusculas</td>
				</tr>

				<tr>
					<td>2. Despues escribe las dos
						primeras letras de la categoria en mayusculas</td>
				</tr>

				<tr>
					<td>3. Por ultimo ingresa el día y
						el mes del día de hoy</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong> Tu ID deberia verse algo así: AGNA2704</strong>
					</td>
				</tr>

				<tr>
					<td>
						<p class="create_paragraph"><strong>Link del archivo</strong>
					</td>
				</tr>

				<tr>
					<td><input type="text" id="linkarchivo" name="linkarchivo" required maxlength="50"
							placeholder="   Ingresa el link de drive donde subiras tus archivos del proyecto" size="50"
							class="input" value="<?php echo !empty($linkarchivo) ? $linkarchivo : ""; ?>">
						<?php if (($linkarchivoError != null)) ?>
						<span class="help-inline"><?php echo $linkarchivoError; ?></span>
					</td>

				</tr>

				<tr>
					<td class="button_create">
						<button type="submit" class="botonfinal" id="botonfinal">
							<strong>Registrar Proyecto</strong>
						</button>
					</td>
				</tr>

			</table>
		</form>

		<p class="footer">@2023 <a href="https://tec.mx/es"> Tecnológico de Monterrey.</a></p>

</body>

</html>