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

$sql = "SELECT * FROM articles ORDER BY article_order DESC LIMIT 6";
$result = $DbConn->query($sql);

if ($result) {
    if ($result->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>Article Order</th>
                <th>Author ID</th>
                <th>Article Title</th>
                <th>Article Full Text</th>
                <th>Article Created Date</th>
                <th>Article Last Update</th>
                <th>Article Display</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['article_order'] . "</td>";
            echo "<td>" . $row['authorId'] . "</td>";
            echo "<td>" . $row['article_title'] . "</td>";
            echo "<td>" . $row['article_full_text'] . "</td>";
            echo "<td>" . $row['article_created_date'] . "</td>";
            echo "<td>" . $row['article_last_update'] . "</td>";
            echo "<td>" . $row['article_display'] . "</td>";

            // Edit button
            echo "<td><a href='sUserEditArticle.php?order=" . $row['article_order'] . "'>Edit</a></td>";

            // Delete button
            echo "<td><a href='../../processes/superUser/sUserDeleteArticle.php?order=" . $row['article_order'] . "' onclick='return confirm(\"Are you sure you want to delete this article?\")'>Delete</a></td>";

            echo "</tr>";
        }
        echo "<tr>";
                echo "<td colspan=11> <center> <a href='../../processes/newArticle.php?id="."'>New article</a> </center> </td>";
                echo "<tr>";

        echo "</table>";
    } else {
        echo "No records found in the 'articles' table.";
    }
} else {
    echo "Error fetching data: " . $DbConn->errorInfo()[2];
}

$DbConn = null;
?>
</body>
</html>
