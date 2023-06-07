<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Insert parent information
    $fatherName = $_POST["fatherName"];
    $motherName = $_POST["motherName"];
    
    $sql = "INSERT INTO parents (father_name, mother_name) VALUES ('$fatherName', '$motherName')";
    if ($conn->query($sql) === TRUE) {
        $parentId = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        exit;
    }

   
    $childName = $_POST["childName"];

   
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["childImage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Upload child image (continued)
    if (move_uploaded_file($_FILES["childImage"]["tmp_name"], $targetFile)) {
      $sql = "INSERT INTO children (child_name, image_path, parent_id) VALUES ('$childName', '$targetFile', '$parentId')";
      if ($conn->query($sql) === TRUE) {
          echo "Data inserted successfully! <a href='/project'>Go Back</a>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  } else {
      echo "Error uploading the child image.";
  }

  $conn->close();
  exit;
}
?>