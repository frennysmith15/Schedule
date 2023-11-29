<?php

$hostname = "localhost";
$servername = "agenda";
$username = "root";
$password = "";

// Create connection
$conexion = new mysqli($hostname,  $username, $password, $servername);

// Check connection
if ($conexion->connect_error) {
  die("Connection failed: " . $conexion->connect_error);
}

?>