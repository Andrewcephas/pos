<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name"; // Use your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT category FROM stock";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li class="category-item" data-category="' . $row['category'] . '">' . $row['category'] . '</li>';
    }
} else {
    echo "<li>No categories found.</li>";
}

$conn->close();
?>
