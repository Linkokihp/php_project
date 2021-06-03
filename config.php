<?php 
	session_start();

	// connect to database, $conn can be used in the entire project for sql queryies
	$conn = mysqli_connect("localhost", "root", "", "php_project_phil");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

	define ('ROOT_PATH', 'C:\xampp\htdocs\php_project');
	define('BASE_URL', 'http://localhost/php_project/');
?>