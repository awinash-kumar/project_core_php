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

// Retrieve ID parameter from URL
$id = $_GET['id'];

// Query parent table to fetch parent record
$sqlParent = "SELECT * FROM parents WHERE parent_id = $id";
$resultParent = $conn->query($sqlParent);

// Query child table to fetch child records
$sqlChild = "SELECT * FROM children WHERE parent_id = $id";
$resultChild = $conn->query($sqlChild);
$parent = $resultParent->fetch_assoc();

$children = array();
while ($row = $resultChild->fetch_assoc()) {
    $children[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
          
            $('#update-form').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'update.php',
                    data: formData,
                    success: function(response) {
                       
                        alert(response);
                        window.location = '/project/';
                    },
                    error: function(xhr, status, error) {
                       
                        alert('Error: ' + error);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Edit Parent and Child</h1>
    <form id="update-form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="father-name">Father's Name:</label>
        <input type="text" name="father_name" id="father-name" value="<?php echo $parent['father_name']; ?>"><br><br>

        <label for="mother-name">Mother's Name:</label>
        <input type="text" name="mother_name" id="mother-name" value="<?php echo $parent['mother_name']; ?>"><br><br>

        <h2>Children:</h2>
        <?php foreach ($children as $child): ?>
            <label for="child-name-<?php echo $child['child_id']; ?>">Child Name:</label>
            <input type="text" name="child_name[]" id="child-name-<?php echo $child['child_id']; ?>" value="<?php echo $child['child_name']; ?>"><br><br>
        <?php endforeach; ?>

        <input type="submit" value="Update">
    </form>
</body>
</html>
