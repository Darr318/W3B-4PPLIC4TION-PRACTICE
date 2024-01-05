<?php
session_start();
require '../../configs/DbConn.php';

// Check if the user is logged in
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: index.php");
    exit();
}

// Check if an ID parameter is provided in the URL
if (isset($_GET["id"])) {
    $userId = $_GET["id"];

    // Prepare and execute the delete query
    $deleteStmt = $DbConn->prepare("DELETE FROM users WHERE userId = :userId");
    $deleteStmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        echo "<script> alert('User deleted successfully'); </script>";
    } else {
        echo "Error deleting user: " . $deleteStmt->errorInfo()[2];
    }

    // Redirect back to the page displaying users
    header("Location: ../../modules/superUser/sUserManage.php");
    exit();
} else {
    // If no ID is provided, redirect to the display_users page
    header("Location: sUserManage.php");
    exit();
}
?>
