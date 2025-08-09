<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "password";
$dbname = "expo_ingenierias";

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conexion) {
	die("No hay conexión: " . mysqli_connect_error());
}

?>