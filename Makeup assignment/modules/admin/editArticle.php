<?php
session_start();
include '../../configs/DbConn.php';

// Check if the article order is provided in the URL
if (isset($_GET['order'])) {
    $articleOrder = $_GET['order'];

    // Fetch article details based on the provided article order
    $sql = "SELECT * FROM articles WHERE article_order = :order";
    $stmt = $DbConn->prepare($sql);
    $stmt->bindParam(':order', $articleOrder, PDO::PARAM_INT);
    $stmt->execute();

    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        echo "Article not found.";
        exit();
    }
} else {
    echo "Article order not provided.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated information from the form
    $newTitle = $_POST["article_title"];
    $newContent = $_POST["article_full_text"];

    // Update article information in the database
    $updateStmt = $DbConn->prepare("UPDATE articles SET article_title = :title, article_full_text = :content WHERE article_order = :order");
    $updateStmt->bindParam(':title', $newTitle, PDO::PARAM_STR);
    $updateStmt->bindParam(':content', $newContent, PDO::PARAM_STR);
    $updateStmt->bindParam(':order', $articleOrder, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        echo "<script> alert('Article updated successfully'); </script>";
        header("Location: adminArtManage.php");
    } else {
        echo "Error updating article: " . $updateStmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
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
        textarea {
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
    <form action="" method="POST">
        <label for="article_title">Article Title:</label><br>
        <input type="text" name="article_title" id="article_title" value="<?php echo $article['article_title']; ?>" required /><br><br>

        <label for="article_full_text">Article Content:</label><br>
        <textarea name="article_full_text" id="article_full_text" rows="4" required><?php echo $article['article_full_text']; ?></textarea><br><br>

        <br><br>
        <center>
            <input type="submit" name="submit" value="Submit">
        </center>
        <br><br>
    </form>
</body>
</html>
