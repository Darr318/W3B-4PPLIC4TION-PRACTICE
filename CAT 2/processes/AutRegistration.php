<?php
include '../configs/DbConn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AuthorFullName = $_POST['AuthorFullName'];
    $AuthorEmail = $_POST['AuthorEmail'];
    $AuthorAddress = $_POST['AuthorAddress'];
    $AuthorBiography = $_POST['AuthorBiography'];
    $AuthorDateOfBirth = $_POST['AuthorDateOfBirth'];
    $AuthorSuspended = $_POST['AuthorSuspended'];

    try {
        $sql = "INSERT INTO authorstb (AuthorFullName, AuthorEmail, AuthorAddress, AuthorBiography, AuthorDateOfBirth, AuthorSuspended) 
        VALUES (:AuthorFullName, :AuthorEmail, :AuthorAddress, :AuthorBiography, :AuthorDateOfBirth, :AuthorSuspended)";
        $stmt = $DbConn->prepare($sql);

        $stmt->bindValue(':AuthorFullName', $AuthorFullName);
        $stmt->bindValue(':AuthorEmail', $AuthorEmail);
        $stmt->bindValue(':AuthorAddress', $AuthorAddress);
        $stmt->bindValue(':AuthorBiography', $AuthorBiography);
        $stmt->bindValue(':AuthorDateOfBirth', $AuthorDateOfBirth);
        $stmt->bindValue(':AuthorSuspended', $AuthorSuspended);

        if ($stmt->execute()) {
            echo "Registered successfully";
        } else {
            echo "Error executing statement: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $DbConn = null;
    }
}
?>

