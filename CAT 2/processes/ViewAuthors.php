<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    
    include '../configs/DbConn.php';

    $sql = "SELECT * FROM authorstb ORDER BY AuthorFullName";
    $result = $DbConn->query($sql);

    if ($result) {
        if ($result->rowCount() > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Address</th><th>Biography</th><th>Date of Birth</th><th>Suspended</th></tr>";

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['AuthorId'] . "</td>";
                echo "<td>" . $row['AuthorFullName'] . "</td>";
                echo "<td>" . $row['AuthorEmail'] . "</td>";
                echo "<td>" . $row['AuthorAddress'] . "</td>";
                echo "<td>" . $row['AuthorBiography'] . "</td>";
                echo "<td>" . $row['AuthorDateOfBirth'] . "</td>";
                echo "<td>" . ($row['AuthorSuspended'] == 1 ? 'Suspended' : 'Not suspended') . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found in the database.";
        }
    } else {
        echo "Error fetching data: " . $DbConn->errorInfo()[2];
    }

    $DbConn = null;
    ?>
</body>
</html>
