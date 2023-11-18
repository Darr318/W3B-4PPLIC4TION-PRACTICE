<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST">
        <label for="AuthorId">Author ID:</label><br>
        <input type="number" name="AuthorId" id="AuthorId"  maxlength="100" required /><br><br>

        <label for="AuthorFullName">Full Name:</label><br>
        <input type="text" name="AuthorFullName" id="AuthorFullName" placeholder="Enter your full name" maxlength="100" required /><br><br>

        <label for="AuthorEmail">Email Address:</label><br>
        <input type="email" name="AuthorEmail" id="AuthorEmail" placeholder="Enter your email address" maxlength="60" /><br><br>

        <label for="AuthorAddress">Address:</label><br>
        <input type="text" name="AuthorAddress" id="AuthorAddress" placeholder="Enter your address" maxlength="13" /><br><br>

        <label for="AuthorBiography">Userame:</label><br>
        <input type="text" name="AuthorBiography" id="AuthorBiography" placeholder="Write a short biography"  /><br><br>

        <label for="AuthorDateOfBirth">Date of Birth:</label><br>
        <input type="date" name="AuthorDateOfBirth" id="AuthorDateOfBirth" /><br><br>

        <input type="checkbox" name="AuthorSuspended" id="AuthorSuspended" value="No" value="Yes"/> <label for="AuthorSuspended">Suspended</label>
        <br><br>

        <br><br>
    
       <input type="submit" name="submit" value="submit" />
        <br><br>
    </form>
</body>
</html>