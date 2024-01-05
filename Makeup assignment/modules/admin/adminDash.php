<?php
session_start();
require '../../configs/DbConn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <style>
        body {
            background-color: #1f1f1f;
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #1985a1;
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #212529;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #339989;
        }
    </style>
</head>
<body>
    <h1>Welcome</h1>
    <a href="adminEdit.php">Update profile</a>
    <a href="adminManage.php">Manage authors</a>
    <a href="adminArtManage.php">View articles</a>
    <a href="../../processes/logout.php">Logout</a>
</body>
</html>