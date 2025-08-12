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

	<link rel="stylesheet" href="../src/css/common_login.css">
	<link rel="stylesheet" href="css/judge_login.css">
</head>

<body>
	<!-- Barra de inicio de sesión -->
	<table>
		<tr>
			<td align="left" style="width: 33.33%;"><img src="../src/img/logo_tec_login.png"
					style="width: 35%;height: 15%;" id="logo-tec"></td>
			<td align="right" style="width: 33.33%;" class="login_header">MiProfesor</td>
		</tr>
	</table>

	<br>

	<table>
		<tr>
			<td style="width: 33.33%;"></td>
			<td align="center" style="width: 33.33%;" class="logo"><img src="../src/img/logo_expo_judge.svg"
					style="width: 100%;height: 100%;" id="logo-tec"></td>
			<td style="width: 33.33%;"></td>
		</tr>
	</table>

	<br>

	<form class="form-horizontal" action="db_connection.php" method="POST">
		<table align="center" width="100%">
			<tr>
				<td style="width: 33.33%;"></td>
				<td align="center"><input type="email" id="correo" name="correo" required maxlength="30"
						placeholder="  Correo..." size="50" class="input"
						value="<?php echo !empty($correo) ? $correo : ''; ?>"></td>
				<td style="width: 33.33%;"></td>
			</tr>

		</table>

		<br>

		<table align="center" width="100%">
			<tr>
				<td style="width: 33.33%;"></td>
				<td align="center"><input type="password" id="password" name="password" required maxlength="30"
						placeholder="  Contraseña..." size="50" class="input"
						value="<?php echo !empty($password) ? $password : ''; ?>"></td>
				<td style="width: 33.33%;"></td>
			</tr>
		</table>

		<center>
			<div align="center">
				<span id="message" style="color: #646464"><strong> </strong></span>
			</div>
		</center>

		<br>

		<?php
		if (isset($_GET['error'])) {
			?>
			<center>
				<div class="login_error_div">
					<p class="error">
						<strong>
							<?php
							echo $_GET['error'];
							?>
						</strong>
					</p>
				</div>
			</center>
			<br>
			<?php
		}

		?>

		<table align="center" width="100%">
			<tr>
				<td style="width: 42"></td>
				<td align="center" class="button_login" style="width: 23%;">
					<button align="center" class="botonfinal" id="botonfinal" type="submit">
						<strong>Iniciar sesión</strong>
					</button>
				</td>
				<td style="width: 42;"></td>
			</tr>
		</table>
	</form>

	<br>

	<table align="center" width="100%">
		<tr>
			<td style="width: 46;"></td>
			<td align="center" class="botonborde2" style="width: 20%;"><button align="center" class="botonfinal2"
					id="botonfinal2" name="botonfinal2">
					<strong>
						<a href="judge_create.php" class="login_text_create">Crear cuenta</a>
					</strong>
				</button>
			</td>
			<td style="width: 46;"></td>
		</tr>
	</table>

	<br>

	<table align="center" width="100%">
		<tr>
			<td style="width: 33.33%;"></td>
			<td align="center" style="width: 33.33%;" class="login_text_help"><strong>¿Olvidaste tu contraseña?</strong>
			</td>
			<td style="width: 33.33%;"></td>
		</tr>

		<tr>
			<td style="width: 33.33%;"></td>
			<td align="center" style="width: 33.33%;" class="login_text_help"><strong>¿Necesitas ayuda?
					Contáctanos</strong>
			</td>
			<td style="width: 33.33%;"></td>
		</tr>

	</table>
	<p class="login_text_footer">
		@2023 <a class="login_link_footer" href="https://tec.mx/es"> Tecnológico de Monterrey.</a>
	</p>
</body>

</html>