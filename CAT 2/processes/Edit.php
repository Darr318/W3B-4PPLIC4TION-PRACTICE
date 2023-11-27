<?php
include('../configs/DbConn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
    if(isset($_GET['id'])){
        $Auth_id = $_GET['id'];

        $query = "SELECT * FROM authorstb WHERE AuthorFullName=:Auth_id LIMIT 1";
        $stmt = $DbConn->prepare($query);
        $data =  [':Auth_id' =>$Auth_id];
        $stmt->execute($data);

        $result= $stmt->fetch(PDO::FETCH_OBJ);
    }
    ?>
    <form action="AutRegistration.php" method="POST">
        
        <label for="AuthorFullName">Full Name:</label><br>
        <input type="text" name="AuthorFullName" id="AuthorFullName" value="<?=$result->AuthorFullName; ?>" 
        maxlength="100" required /><br><br>

        <label for="AuthorEmail">Email Address:</label><br>
        <input type="email" name="AuthorEmail" id="AuthorEmail" value="<?=$result->AuthorEmail; ?>" 
        maxlength="60" /><br><br>

        <label for="AuthorAddress">Address:</label><br>
        <input type="text" name="AuthorAddress" id="AuthorAddress" value="<?=$result->AuthorAddress; ?>" 
        maxlength="13" /><br><br>

        <label for="AuthorBiography">Biography:</label><br>
        <input type="text" name="AuthorBiography" id="AuthorBiography" value="<?=$result->AuthorBiography; ?>" /><br><br>

        <label for="AuthorDateOfBirth">Date of Birth:</label><br>
        <input type="date" name="AuthorDateOfBirth" id="AuthorDateOfBirth" value="<?=$result->AuthorDateOfBirth; ?>" /><br><br>

        <div class="Checkbox">
        <label for="AuthorSuspended">Not suspended</label> 
        <input type="radio" name="AuthorSuspended" id="AuthorSuspended" value="<?=$result->AuthorSuspended; ?>"> 

        <label for="AuthorSuspended">Suspended</label>
        <input type="radio" name="AuthorSuspended" id="AuthorSuspended" value="<?=$result->AuthorSuspended; ?>"> 
        </div>
        <br><br>
        <center>
       <input type="submit" name="Update" value="Update">
        </center>
        <br><br>
    </form>
</body>
</html>
