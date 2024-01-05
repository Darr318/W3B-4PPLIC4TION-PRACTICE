<?php
session_start();
include '../../configs/DbConn.php';

// Check if the article order is provided in the URL
if (isset($_GET['order'])) {
    $articleOrder = $_GET['order'];

    // Delete the article based on the provided article order
    $deleteStmt = $DbConn->prepare("DELETE FROM articles WHERE article_order = :order");
    $deleteStmt->bindParam(':order', $articleOrder, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        echo "<script> alert('Article deleted successfully'); </script>";
        header("Location: ../../modules/admin/adminArtManage.php");
    } else {
        echo "Error deleting article: " . $deleteStmt->errorInfo()[2];
    }
} else {
    echo "Article order not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
</body>
</html>
