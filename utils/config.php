<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$database = "Ecomm";  // Adjust database name as necessary

// Create connection
$conn = new mysqli($servername, $username, $password, $database);


// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}