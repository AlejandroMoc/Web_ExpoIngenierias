<?php
require '../src/php/database.php';

// Check if the menuJuez POST parameter is not empty
if (!empty($_POST['menuJuez'])) {

	// Explode the menuJuez value into an array using '|' as the delimiter
	$var = explode('|', $_POST['menuJuez']);

	// Connect to the database
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Prepare an SQL statement to insert a new record into the 'califica' table
	$sql2 = 'INSERT INTO califica (id_proyecto, id_juez, calificacion, retro_juez) values(?, ?, NULL, NULL)';
	$q2 = $pdo->prepare($sql2);

	// Execute the prepared statement with the id_proyecto and id_juez values
	$q2->execute(array($var[0], $var[1]));
	// Disconnect from the database
	Database::disconnect();
}

// Redirect to admin_assign.php page
header("Location: admin_assign.php");

?>