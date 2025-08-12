<html lang="es">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MiAdmin</title>
	<link rel="icon" href="../src/img/icon_admin.png">
	
	<link rel="stylesheet" href="../src/css/common_navbar.css">
	<link rel="stylesheet" href="css/admin_score.css">
	<link rel="stylesheet" href="css/admin_common.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<!-- Barra de navegación lista -->
	<navbar>
		<div id="navbar">
			<img src="../src/img/logo_tec_blue.png">
			<div id="navbarIconsContainer">
				<a id="navbarIcon" href="" class="material-icons">person</a>
				<a id="navbarIcon" href="admin_assign.php" class="material-icons">rate_review</a>
				<a id="navbarIcon" href="admin_logout.php" class="material-icons">logout</a>
			</div>
		</div>
	</navbar>
	<navbar>
		<div id="navbarAzul">
			<img src="../src/img/logo_expo_admin.svg">
			<a href="">Proyectos calificados</a>
			<a href="admin_start.php"><span class="material-icons">home</span>MiAdmin</a>
		</div>
	</navbar>

	<table class="graph">
		<thead>
			<tr>
				<th scope="col">Elemento</th>
				<th scope="col">Porcentaje</th>
			</tr>
		</thead>
		<tbody>
			<tr style="height:85%">
				<th scope="row">Robótica</th>
				<td><span>85%</span></td>
			</tr>
			<tr style="height:23%">
				<th scope="row">Software</th>
				<td><span>23%</span></td>
			</tr>
			<tr style="height:7%">
				<th scope="row">Nanotech</th>
				<td><span>7%</span></td>
			</tr>
			<tr style="height:38%">
				<th scope="row">Comunica</th>
				<td><span>38%</span></td>
			</tr>
			<tr style="height:35%">
				<th scope="row">Ambiente</th>
				<td><span>35%</span></td>
			</tr>
		</tbody>
	</table>
</body>

</html>