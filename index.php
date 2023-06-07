<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT p.parent_id, p.father_name, p.mother_name, c.child_name, c.image_path
        FROM parents p
        JOIN children c ON p.parent_id = c.parent_id";
$result = $conn->query($sql);

$records = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $record = array(
            "father_name" => $row["father_name"],
            "mother_name" => $row["mother_name"],
            "child_name" => $row["child_name"],
            "image_path" => $row["image_path"],
            "parent_id" => $row["parent_id"],
        );
        $records[] = $record;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listing Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 200px;
        }
        .add{
         float: right;
         width: 30px;
        }
    </style>
</head>
<body>
   <a href="/project/add.php" class="add">Add</a>
    <?php if (empty($records)): ?>
        <p>No records found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Child's Name</th>
                    <th>Child's Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo $record["father_name"]; ?></td>
                        <td><?php echo $record["mother_name"]; ?></td>
                        <td><?php echo $record["child_name"]; ?></td>
                        <td><img src="<?php echo $record["image_path"]; ?>"></td>
                        <td><a href="/project/edit.php?id=<?= $record['parent_id'] ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
