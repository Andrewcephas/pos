<?php
$servername = "localhost";
$username = "root";
$password = ""; // password
$dbname = "pos"; //  database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$category = $_POST['category'];
$name = $_POST['name'];
$price = $_POST['price'];

// Image upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Allow certain file formats
if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
  if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
    // Insert data into database
    $sql = "INSERT INTO stock (category, name, price, img) VALUES ('$category', '$name', '$price', '$target_file')";
    
    if ($conn->query($sql) === TRUE) {
      echo "Product added successfully!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "Error uploading image.";
  }
} else {
  echo "Invalid image file format.";
}

$conn->close();
?>
