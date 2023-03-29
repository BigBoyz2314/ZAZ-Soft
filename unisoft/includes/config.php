<?php
$servername = "localhost";
$username = "BigBoyz";
$password = "BigBoyz2314";
$dbname = "project";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connecting
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
