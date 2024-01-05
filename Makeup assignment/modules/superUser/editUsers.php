<?php
session_start();
require '../../configs/DbConn.php';

// Check if the user is logged in
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: index.php");
    exit();
}

// Retrieve user information based on the user ID in the URL
$User_ID = isset($_GET["id"]) ? $_GET["id"] : null; // Use null if ID is not provided
if ($User_ID !== null) {
    $stmt = $DbConn->prepare("SELECT * FROM users WHERE userId = :User_ID");
    $stmt->bindParam(':User_ID', $User_ID, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user ID is available
    if ($User_ID !== null) {
    // Retrieve updated information from the form
    $newFullName = !empty($_POST["Full_Name"]) ? $_POST["Full_Name"] : $userData['Full_Name'];
    $newEmail = !empty($_POST["email"]) ? $_POST["email"] : $userData['email'];
    $newPhoneNumber = !empty($_POST["phone_Number"]) ? $_POST["phone_Number"] : $userData['phone_Number'];
    $newUserType = !empty($_POST["UserType"]) ? $_POST["UserType"] : $userData['UserType'];
    $newProfileImage = !empty($_FILES["profile_Image"]["name"]) ? $_FILES["profile_Image"]["name"] : $userData['profile_Image'];
    $newAddress = !empty($_POST["Address"]) ? $_POST["Address"] : $userData['Address'];
    $newPassword = !empty($_POST["Password"]) ? $_POST["Password"] : $userData['Password'];

    // Update user information in the database
    $updateStmt = $DbConn->prepare("UPDATE users SET 
        Full_Name = :Full_Name, 
        email = :email, 
        phone_Number = :phone_Number, 
        UserType = :UserType, 
        profile_Image = :profile_Image, 
        Address = :Address,
        Password = :Password
        WHERE User_Name = :User_Name");

    $updateStmt->bindParam(':Full_Name', $newFullName, PDO::PARAM_STR);
    $updateStmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
    $updateStmt->bindParam(':phone_Number', $newPhoneNumber, PDO::PARAM_STR);
    $updateStmt->bindParam(':UserType', $newUserType, PDO::PARAM_INT);
    $updateStmt->bindParam(':profile_Image', $newProfileImage, PDO::PARAM_STR);
    $updateStmt->bindParam(':Address', $newAddress, PDO::PARAM_STR);
    $updateStmt->bindParam(':Password', $newPassword, PDO::PARAM_STR);
    $updateStmt->bindParam(':User_Name', $User_Name, PDO::PARAM_STR);
    
    if ($updateStmt->execute()) {
        echo "<script> alert('Profile updated successfully'); </script>";
    } else {
        echo "Error updating profile: " . $updateStmt->errorInfo()[2];
    }
} else {
    echo "User ID is missing. Unable to update profile.";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile</title>
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
    <form action="" method="POST" enctype="multipart/form-data">
        
        <label for="Full_Name">Full name:</label><br>
        <input type="text" name="Full_Name" id="Full_Name" placeholder="Enter your full name" maxlength="100" value="<?php echo $userData['Full_Name']; ?>" /><br><br>

        <label for="email">Email Address:</label><br>
        <input type="email" name="email" id="email" placeholder="Enter your email address" maxlength="60" value="<?php echo $userData['email']; ?>" /><br><br>

        <label for="phone_Number">Phone number:</label><br>
        <input type="tel" name="phone_Number" id="phone_Number" placeholder="Enter your phone number" value="<?php echo $userData['phone_Number']; ?>" /><br><br>

        <label for="User_Name">User name:</label><br>
        <input type="text" name="User_Name" id="User_Name" placeholder="Enter your user name" maxlength="100" value="<?php echo $userData['User_Name']; ?>" readonly /><br><br>

        <label for="Password">Password:</label><br>
        <input type="password" name="Password" id="Password" placeholder="Enter your password" maxlength="100" /><br><br>

        <label for="confirm_pass">Confirm password:</label><br>
        <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm your password" maxlength="100" /><br><br>

        <div class="Checkbox">
        <label for="UserType">User type:</label><br>
        <label for="UserType">Super user</label> 
        <input type="radio" name="UserType" id="super_User" value="0" <?php echo ($userData['UserType'] == 0) ? 'checked' : ''; ?>>

        <label for="UserType">Administrator</label>
        <input type="radio" name="UserType" id="Admin" value="1" <?php echo ($userData['UserType'] == 1) ? 'checked' : ''; ?>> 
        </div>
        <br>
       
        <label for="profile">Profile photo:</label>
        <input type="file" name="profile_Image" id="profile_Image" /><br><br>

        <label for="Address">Address:</label><br>
        <input type="text" name="Address" id="Address" placeholder="Enter your address" maxlength="13" value="<?php echo $userData['Address']; ?>" /><br><br>

        <br><br>
        <center>
       <input type="submit" name="submit" value="submit">
        </center>
        <br><br>
    </form>
</body>
</html
