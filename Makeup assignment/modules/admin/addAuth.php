<?php
session_start();
require '../../configs/DbConn.php';

if (isset($_POST["submit"])) {
    // Fetching user input from the form
    $Full_Name = $_POST["Full_Name"];
    $email = $_POST["email"];
    $phone_Number = $_POST["phone_Number"];
    $User_Name = $_POST["User_Name"];
    $Password = $_POST["Password"];
    $confirm_pass = $_POST["confirm_pass"];
    $UserType = isset($_POST["UserType"]) ? $_POST["UserType"] : '1';
    $Address = $_POST["Address"];

    // Basic password validation
    if ($Password !== $confirm_pass) {
        echo "<script> alert('Passwords do not match'); </script>";
        exit();
    }

    // Set AccessTime to the current date and time
    $AccessTime = date("Y-m-d H:i:s");

    // File Upload Handling
    if (isset($_FILES["profile_Image"])) {
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["profile_Image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_Image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script> alert('File is not an image.'); </script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_Image"]["size"] > 10000000) {
            echo "<script> alert('Sorry, your file is too large.'); </script>";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<script> alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); </script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_Image"]["tmp_name"], $target_file)) {
                try {
                    // Using prepared statement to insert data into the database
                    $stmt = $DbConn->prepare("INSERT INTO users 
                        (Full_Name, email, phone_Number, User_Name, Password, UserType, AccessTime, profile_Image, Address) 
                        VALUES (:Full_Name, :email, :phone_Number, :User_Name, :Password, :UserType, :AccessTime, :profile_Image, :Address)");

                    // Binding parameters
                    $stmt->bindParam(':Full_Name', $Full_Name, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':phone_Number', $phone_Number, PDO::PARAM_STR);
                    $stmt->bindParam(':User_Name', $User_Name, PDO::PARAM_STR);
                    $stmt->bindParam(':Password', $Password, PDO::PARAM_STR); // No hashing for now
                    $stmt->bindParam(':UserType', $UserType, PDO::PARAM_INT);
                    $stmt->bindParam(':AccessTime', $AccessTime, PDO::PARAM_STR);
                    $stmt->bindParam(':profile_Image', $target_file, PDO::PARAM_STR);
                    $stmt->bindParam(':Address', $Address, PDO::PARAM_STR);

                    // Executing the query
                    $stmt->execute();

                    echo "<script> alert('Registration successful'); </script>";
                    header("Location: adminManage.php");
                    
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "<script> alert('Sorry, there was an error uploading your file.'); </script>";
            }
        }
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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

    <style>
  .hidden {
    display: none;
  }
  </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        
        <label for="Full_Name">Full name:</label><br>
        <input type="text" name="Full_Name" id="Full_Name" placeholder="Enter your full name" maxlength="100" required /><br><br>

        <label for="email">Email Address:</label><br>
        <input type="email" name="email" id="email" placeholder="Enter your email address" maxlength="60" /><br><br>

        <label for="phone_Number">Phone number:</label><br>
        <input type="tel" name="phone_Number" id="phone_Number" placeholder="Enter your phone number"  /><br><br>

        <label for="User_Name">User name:</label><br>
        <input type="text" name="User_Name" id="User_Name" placeholder="Enter your user name" maxlength="100" required /><br><br>

        <label for="Password">Password:</label><br>
        <input type="password" name="Password" id="Password" placeholder="Enter your password" maxlength="100" required /><br><br>

        <label for="confirm_pass">Confirm password:</label><br>
        <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm your password" maxlength="100" required /><br><br>

        <!-- Add the hidden class to the label and input elements -->
<label for="UserType" class="hidden">User type:</label>
<div class="Checkbox hidden">
  <label for="UserType" class="hidden">Super user</label> 
  <input type="radio" name="UserType" id="super_User" value="0" class="hidden"> 

  <label for="UserType" class="hidden">Administrator</label>
  <input type="radio" name="UserType" id="Admin" value="1" class="hidden"> 
</div>
        <br>
       
        <label for="profile">Profile photo:</label>
        <input type="file" name="profile_Image" id="profile_Image" /><br><br>

        <label for="Address">Address:</label><br>
        <input type="text" name="Address" id="Address" placeholder="Enter your address" maxlength="13" /><br><br>

        <br><br>
        <center>
       <input type="submit" name="submit" value="submit">
        </center>
        <br><br>
    </form>
</body>
</html>
