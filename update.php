<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$id = $_POST['id'];
$fatherName = $_POST['father_name'];
$motherName = $_POST['mother_name'];
$childNames = $_POST['child_name'];


$sqlParent = "UPDATE parents SET father_name = '$fatherName', mother_name = '$motherName' WHERE parent_id = $id";
if ($conn->query($sqlParent) === false) {
    die("Error updating parent record: " . $conn->error);
}

$sqlDeleteChildren = "DELETE FROM children WHERE parent_id = $id";
if ($conn->query($sqlDeleteChildren) === false) {
    die("Error deleting child records: " . $conn->error);
}


foreach ($childNames as $childName) {
    $sqlInsertChild = "INSERT INTO children (parent_id, child_name) VALUES ($id, '$childName')";
    if ($conn->query($sqlInsertChild) === false) {
        die("Error inserting child record: " . $conn->error);
    }
}

$conn->close();

echo "Record updated successfully!";
?>
