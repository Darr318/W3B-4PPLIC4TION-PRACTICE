<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    ?>
    <form action="processes/AutRegistration.php" method="POST">
        
        <label for="AuthorFullName">Full name:</label><br>
        <input type="text" name="AuthorFullName" id="AuthorFullName" placeholder="Enter your full name" maxlength="100" required /><br><br>

        <label for="AuthorEmail">Email Address:</label><br>
        <input type="email" name="AuthorEmail" id="AuthorEmail" placeholder="Enter your email address" maxlength="60" /><br><br>

        <label for="phone_Number">Phone number:</label><br>
        <input type="tel" name="phone_Number" id="phone_Number" placeholder="Enter your phone number"  /><br><br>

        <label for="User_Name">User name:</label><br>
        <input type="text" name="User_Name" id="User_Name" placeholder="Enter your user name" maxlength="100" required /><br><br>

        <label for="Password">Password:</label><br>
        <input type="password" name="Password" id="Password" placeholder="Enter your password" maxlength="100" required /><br><br>

        <label for="confirm_pass">Confirm password:</label><br>
        <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm your password" maxlength="100" required /><br><br>

        <label for="UserType">User type:</label><br>
        <div class="Checkbox">
        <label for="UserType">Admin</label> 
        <input type="radio" name="UserType" id="Admin" value="0"> 

        <label for="UserType">User</label>
        <input type="radio" name="UserType" id="User" value="1"> 
        </div>
       
        <label for="AccessTime">Accesstime:</label><br>
        <input type="date" name="AccessTime" id="AccessTime" /><br><br>

        <label for="profile_Image">User name:</label><br>
        <input type="text" name="profile_Image" id="profile_Image" /><br><br>

        <label for="AuthorAddress">Address:</label><br>
        <input type="text" name="AuthorAddress" id="AuthorAddress" placeholder="Enter your address" maxlength="13" /><br><br>

        <br><br>
        <center>
       <input type="submit" name="submit" value="submit">
        </center>
        <br><br>
    </form>
</body>
</html>
