<?php
// Replace 'your_database_name', 'your_username', and 'your_password' with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_crud_app";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
