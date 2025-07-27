<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blog";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
