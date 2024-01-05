<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Info</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <style>
        body {
    background-color: #1f1f1f;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border: 1px solid #444;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #333;
}

th {
    background-color: #212529;
    color: #324a5f;
    border-radius: 8px 8px 0 0;
}

tr:nth-child(even) {
    background-color: #adb5bd;
}

tr:nth-child(odd) {
    background-color: #495057;
}

tr:hover {
    background-color: #660708; 
}

a {
    color: #1985a1;
    text-decoration: none;
}

a:hover {
    color: #339989; 
}

    </style>
</head>
<body>
    <?php
    session_start();
    include '../../configs/DbConn.php';

    $sql = "SELECT * FROM users WHERE UserType = 1 ORDER BY Full_Name";
    $result = $DbConn->query($sql);

    if ($result) {
        if ($result->rowCount() > 0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>User name</th>
                    <th>Password</th>
                    <th>User type</th>
                    <th>Access time</th>
                    <th>Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>";

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['userId'] . "</td>";
                echo "<td>" . $row['Full_Name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone_Number'] . "</td>";
                echo "<td>" . $row['User_Name'] . "</td>";
                echo "<td>" . $row['Password'] . "</td>";
                echo "<td>" . $row['UserType'] . "</td>";
                echo "<td>" . $row['AccessTime'] . "</td>";
                echo "<td>" . $row['Address'] . "</td>";

                // Edit button
                echo "<td><a href='editAuth.php?id=" . $row['userId'] . "'>Edit</a></td>";

                // Delete button
                echo "<td><a href='../../processes/admin/deleteAuth.php?id=" . $row['userId'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";

                echo "</tr>";
            }
                echo "<tr>";
                echo "<td colspan=11> <center> <a href='addAuth.php?id="."'>New author</a> </center> </td>";
                echo "<tr>";

                echo "<tr>";
                echo "<td colspan=11> <center> <a href='../../processes/admin/exportAuth.php?id="."'>Print authors</a> </center> </td>";
                echo "<tr>";


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
