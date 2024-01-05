<?php
session_start();
require 'configs/DbConn.php';

if (isset($_POST["submit"])) {
    $User_Name = $_POST["User_Name"];
    $Password = $_POST["Password"];

    try {
        $stmt = $DbConn->prepare("SELECT User_Name, Password, UserType FROM users WHERE User_Name = :User_Name");
        $stmt->bindParam(':User_Name', $User_Name, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $storedPassword = $row["Password"];

            if ($Password == $storedPassword) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["User_Name"];

                // Check user type and redirect accordingly
                if ($row["UserType"] == 0) { // Assuming 0 is superuser
                    header("Location: modules/superUser/sUserdash.php");
                } elseif ($row["UserType"] == 1) { // Assuming 1 is admin
                    header("Location: modules/admin/adminDash.php");
                } else {
                    // Handle other user types or set a default redirect
                    header("Location: index.php");
                }

                exit();
            } else {
                echo "<script> alert('Wrong password'); </script>";
            }
        } else {
            echo "<script> alert('User not registered'); </script>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <style>
        body {
            background-color: #1f1f1f;
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            color: #1985a1;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            display: inline-block;
            border: 1px solid #495057;
            box-sizing: border-box;
            background-color: #212529;
            color: #fff;
            border-radius: 5px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #339989;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #660708;
        }
    </style>
</head>
<body>
    <form action="" method="POST" autocomplete="off">
        <label for="User_Name">Username:</label><br>
        <input type="text" name="User_Name" id="User_Name" placeholder="Enter your username" maxlength="60" required /><br><br>

        <label for="Password">Password:</label><br>
        <input type="password" name="Password" id="Password" placeholder="Enter your password" maxlength="255" required /><br><br>

        <br><br>
        <center>
            <input type="submit" name="submit">
        </center>
        <br><br>
    </form>
</body>
</html>
