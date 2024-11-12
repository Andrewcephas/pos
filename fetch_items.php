<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';

// Prepare query based on category
if ($category) {
    $stmt = $conn->prepare("SELECT * FROM stock WHERE category = ?");
    $stmt->bind_param("s", $category);
} else {
    $stmt = $conn->prepare("SELECT * FROM stock");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card item-card" data-name="' . $row['name'] . '" data-price="' . $row['price'] . '">';
        echo '<img src="' . $row['img'] . '" alt="' . $row['name'] . '" style="width: 100%;">';
        echo '<h4>' . $row['name'] . '</h4>';
        echo '<p>$' . number_format($row['price'], 2) . '</p>';
        echo '</div>';
    }
} else {
    echo "<p>No items found.</p>";
}

$stmt->close();
$conn->close();
?>
