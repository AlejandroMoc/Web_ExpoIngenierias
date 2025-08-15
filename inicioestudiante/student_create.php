<?php

// Variables
require '../src/php/database.php';

$nombreError = null;
$apellidoPError = null;
$apellidoMError = null;
$correoError = null;
$matriculaError = null;
$passError = null;
$confircontraError = null;

if (!empty($_POST)) {

	// Obtain data
	$nombre = $_POST['nombre'];
	$apellidoP = $_POST['apellidoP'];
	$apellidoM = $_POST['apellidoM'];
	$correo = $_POST['correo'];
	$matricula = $_POST['matricula'];
	$pass = $_POST['pass'];
	$confirmPassword = $_POST['confirmPassword'];

	// Validate input
	$valid = true;

	if (empty($nombre)) {
		$nombreError = 'Ingresa un nombre para continuar';
		$valid = false;
	}
	if (empty($apellidoP)) {
		$apellidoPError = 'Ingresa un apellido paterno para continuar';
		$valid = false;
	}
	if (empty($apellidoM)) {
		$apellidoMError = 'Ingresa un apellido materno para continuar';
		$valid = false;
	}
	if (empty($correo)) {
		$correoError = 'Ingresa un correo para continuar';
		$valid = false;
	}
	if (empty($matricula)) {
		$matriculaError = 'Ingresa una matrícula para continuar';
		$valid = false;
	}
	if (empty($pass)) {
		$passError = 'Ingresa una contraseña para continuar';
		$valid = false;
	}
	if (empty($confirmPassword)) {
		$confircontraError = 'Vuelve a ingresar tu contraseña para continuar';
		$valid = false;
	}

	// Insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'INSERT INTO estudiante (id_estudiante, nombre, apellido_paterno, apellido_materno, correo, contrasena) values(?, ?, ?, ?, ?, ?)';
		$q = $pdo->prepare($sql);

		$q->execute(array($matricula, $nombre, $apellidoP, $apellidoM, $correo, $pass));

		Database::disconnect();
		header("Location: index.php");
	}
}
?>

<script>
	function verifyPassword() {
		var pw = document.getElementById("pass").value;
		var vpw = document.getElementById("confirmPassword").value;
		//check empty password field  
		if (pw != vpw) {
			document.getElementById("message").innerHTML = "Las contraseñas no coinciden";
			return false;
		}

		// Minimum password length validation  
		if (pw.length < 8) {
			document.getElementById("message").innerHTML = "La contraseña debe tener mas de 8 caracteres";
			return false;
		}

		// Maximum length of password validation  
		if (pw.length > 50) {
			document.getElementById("message").innerHTML = "La contraseña no puede tener mas de 50 caracteres";
			return false;
		} else {
			alert("Creación de cuenta exitosa");
		}
	}  
</script>

<!DOCTYPE html>
<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MiEstudiante</title>
	<link rel="icon" href="../src/img/icon_student.png">

	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="../src/css/common_create.css">
	<link rel="stylesheet" href="css/student_common.css">
	<link rel="stylesheet" href="css/student_create.css">

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
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_student.svg">
			<a href="student_start.php"><span class="material-icons">home</span>MiEstudiante</a>
		</div>
	</navbar>

	<form class="divfix" action="student_create.php" method="post" onsubmit="return verifyPassword()">
		<table  width="100%">
			<tr>
				<td>
					<p class="create_paragraph"><strong> Nombre(s) y apellidos</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="nombre" name="nombre" required maxlength="30" placeholder="  Nombre(s)"
						size="50" class="input" value="<?php echo !empty($nombre) ? $nombre : ''; ?>">
					<?php if (($nombreError != null)) ?>
					<span class="help-inline"><?php echo $nombreError; ?></span>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="apellidoP" name="apellidoP" required maxlength="30"
						placeholder="  Apellido Pat." size="50" class="input2"
						value="<?php echo !empty($apellidoP) ? $apellidoP : ''; ?>"><input type="text" id="apellidoM"
						name="apellidoM" required maxlength="30" placeholder="  Apellido Mat." size="50" class="input2"
						value="<?php echo !empty($apellidoM) ? $apellidoM : ''; ?>">
					<?php if (($apellidoPError != null)) ?>
					<span class="help-inline"><?php echo $apellidoPError; ?></span>
					<?php if (($apellidoPError != null)) ?>
					<span class="help-inline"><?php echo $apellidoMError; ?></span>
				</td>
			</tr>

			<tr>
				<td>
					<p class="create_paragraph"><strong> Correo electrónico</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="correo" name="correo" required maxlength="30" placeholder="  Identificador"
						size="70" class="input" value="<?php echo !empty($correo) ? $correo : ''; ?>">
					<?php if (($correoError != null)) ?>
					<span class="help-inline"><?php echo $correoError; ?></span>
				</td>
			</tr>

			<tr>
				<td>
					<p class="create_paragraph"><strong> Matrícula</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" id="matricula" name="matricula" required maxlength="30" placeholder="  XXXXXXXXX"
						size="10" class="input" value="<?php echo !empty($matricula) ? $matricula : ''; ?>">
					<?php if (($matriculaError != null)) ?>
					<span class="help-inline"><?php echo $matriculaError; ?></span>
				</td>
			</tr>

			<tr>
				<td>
					<p class="create_paragraph"><strong> Contraseña</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="password" id="pass" name="pass" required maxlength="30" placeholder="  Contraseña"
						size="70" class="input" value="<?php echo !empty($pass) ? $pass : ''; ?>">
					<?php if (($passError != null)) ?>
					<span class="help-inline"><?php echo $passError; ?></span>
				</td>
			</tr>


			<tr>
				<td>
					<p class="create_paragraph"><strong> Confirma tu contraseña</strong>
				</td>
			</tr>

			<tr>
				<td>
					<input type="password" id="confirmPassword" name="confirmPassword" required maxlength="30"
						placeholder="  Vuelve a escribir tu clave" size="70" class="input"
						value="<?php echo !empty($confirmPassword) ? $confirmPassword : ''; ?>">
					<?php if (($confircontraError != null)) ?>
					<span class="help-inline"><?php echo $confircontraError; ?></span>
				</td>
			</tr>

			<br>

			<tr>
				<td class="button_create" style="width: 33.33%;">
					<button class="botonfinal" id="botonfinal" type="submit">
						<strong>Crear cuenta</strong>
					</button>
				</td>
			</tr>

			<br>

			<tr>
				<td class="botonborde2">
					<button  class="botonfinal2"><strong><a href="index.php"
								class="alv">Regresar</a></strong></button>
				</td>
			</tr>
		</table>
	</form>

	<p class="footer">@2023 <a href="https://tec.mx/es"> Tecnológico de Monterrey.</a></p>

</body>

</html>