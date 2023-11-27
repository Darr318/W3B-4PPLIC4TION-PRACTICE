<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Author</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $hostname = "localhost";
    $username = "root";
    $userpass = "";
    $db_name = "authordb";

    try {
        $DbConn = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $userpass);
        $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM authorstb ORDER BY AuthorFullName";
        $stmt = $DbConn->query($sql);

        if ($stmt) {
            echo "<table border='1'>";
            echo "<tr><th>Author ID</th><th>Author Full Name</th><th>Action</th></tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['AuthorId']}</td>";
                echo "<td>{$row['AuthorFullName']}</td>";
                echo "<td><a href='DelAuth.php?id={$row['AuthorId']}'>Delete</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Error fetching authors: " . $DbConn->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    } finally {
        $DbConn = null;
    }
    ?>

    <br>
    <a href="index.php">Back to Author Registration</a>
</body>
</html>
