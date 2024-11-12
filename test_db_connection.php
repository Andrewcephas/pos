<?php
$servername = "localhost"; // or "localhost"
$username = "root";
$password = ""; // leave blank if no password
$dbname = "pos"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful!";
}

$conn->close();
?>
