<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "expo_ingenierias";

$conexion = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if (!$conexion) {
	die("No hay conexión: " . mysqli_connect_error());
}

?>