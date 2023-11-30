<?php
// Coneccion a la base de datos
$servername = "192.168.101.93";
$username = "AG06";
$password = "St2023#QUcwNg";
$dbname = "ag06";
$conn = new mysqli("$servername", "$username", "$password", "$dbname");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>