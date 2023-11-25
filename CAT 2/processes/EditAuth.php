<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include '../configs/DbConn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AuthorId = $_POST['AuthorId'];
    $AuthorFullName = $_POST['AuthorFullName'];
    $AuthorEmail = $_POST['AuthorEmail'];
    $AuthorAddress = $_POST['AuthorAddress'];
    $AuthorBiography = $_POST['AuthorBiography'];
    $AuthorDateOfBirth = $_POST['AuthorDateOfBirth'];
    $AuthorSuspended = $_POST['AuthorSuspended'];
    
    $sql = "UPDATE authorstb SET AuthorFullName = ?, AuthorEmail = ?, AuthorAddress = ?, AuthorBiography = ?, AuthorDateOfBirth = ?, AuthorSuspended = ? WHERE AuthorId = ?";
    $stmt = $DbConn->prepare($sql);

    if ($stmt) {
        $stmt->bindParam(1, $AuthorFullName);
        $stmt->bindParam(2, $AuthorEmail);
        $stmt->bindParam(3, $AuthorAddress);
        $stmt->bindParam(4, $AuthorBiography);
        $stmt->bindParam(5, $AuthorDateOfBirth);
        $stmt->bindParam(6, $AuthorSuspended);
        $stmt->bindParam(7, $AuthorId);

        if ($stmt->execute()) {
            echo "Author details edited successfully!";
        } else {
            echo "Error editing author details: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $DbConn->error;
    }
}

if (isset($_GET['id'])) {
    $AuthorId = $_GET['id'];

    $sql = "SELECT * FROM authorstb WHERE AuthorId = ?";
    $stmt = $DbConn->prepare($sql);

    if ($stmt) {
        $stmt->bindParam(1, $AuthorId);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                ?>
                <form action="EditAuth.php" method="POST">
                    <input type="hidden" name="AuthorId" value="<?php echo $result['AuthorId']; ?>">

                    <label for="AuthorFullName">Full Name:</label>
                    <input type="text" name="AuthorFullName" id="AuthorFullName" value="<?php echo $result['AuthorFullName']; ?>" required>

                    <label for="AuthorEmail">Email Address:</label>
                    <input type="text" name="AuthorEmail" id="AuthorEmail" value="<?php echo $result['AuthorEmail']; ?>" required>

                    <label for="AuthorAddress">Address:</label>
                    <input type="text" name="AuthorAddress" id="AuthorAddress" value="<?php echo $result['AuthorAddress']; ?>" required>

                    <label for="AuthorBiography">Biography:</label>
                    <input type="text" name="AuthorBiography" id="AuthorBiography" value="<?php echo $result['AuthorBiography']; ?>" required>

                    <label for="AuthorDateOfBirth">Date Of Birth:</label>
                    <input type="date" name="AuthorDateOfBirth" id="AuthorDateOfBirth" value="<?php echo $result['AuthorDateOfBirth']; ?>" required>

                    <label for="AuthorSuspendedYes">Not suspended:</label>
                    <input type="radio" name="AuthorSuspended" id="AuthorSuspendedYes" value="0" <?php echo ($result['AuthorSuspended'] == 0) ? 'checked' : ''; ?> required>

                    <label for="AuthorSuspendedNo">Suspended:</label>
                    <input type="radio" name="AuthorSuspended" id="AuthorSuspendedNo" value="1" <?php echo ($result['AuthorSuspended'] == 1) ? 'checked' : ''; ?> required>

                    <input type="submit" name="submit" value="Edit">
                </form>
                <?php
            } else {
                echo "Author not found.";
            }
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->closeCursor();
    } else {
        echo "Error preparing statement: " . $DbConn->error;
    }
} else {
    echo "An error occurred retrieving the id from the database.";
}

$DbConn = null;
?>
</body>
</html>
