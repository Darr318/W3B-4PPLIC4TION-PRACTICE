<?php
session_start();
    // Include your database connection file (configs/DbConn.php)
    require '../configs/DbConn.php';

    // Fetch Author IDs from the users table
    $authorIds = [];
    $stmtAuthors = $DbConn->query("SELECT userId FROM users");
    foreach ($stmtAuthors as $row) {
        $authorIds[] = $row['userId'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // Retrieve form data
        $authorId = $_POST["authorId"];
        $articleTitle = $_POST["article_title"];
        $articleContent = $_POST["article_full_text"];
        $displayArticle = $_POST["article_display"];

        // Set the current date and time
        $currentDateTime = date('Y-m-d H:i:s');

        // Perform database insertion
        try {
            $stmt = $DbConn->prepare("INSERT INTO articles (authorId, article_title, article_full_text, article_created_date, article_last_update, article_display) VALUES (:authorId, :article_title, :article_full_text, :article_created_date, :article_last_update, :article_display)");

            $stmt->bindParam(':authorId', $authorId, PDO::PARAM_INT);
            $stmt->bindParam(':article_title', $articleTitle, PDO::PARAM_STR);
            $stmt->bindParam(':article_full_text', $articleContent, PDO::PARAM_STR);
            $stmt->bindParam(':article_created_date', $currentDateTime, PDO::PARAM_STR);
            $stmt->bindParam(':article_last_update', $currentDateTime, PDO::PARAM_STR);
            $stmt->bindParam(':article_display', $displayArticle, PDO::PARAM_INT);

            $stmt->execute();

            echo "<script> alert('Article added successfully'); </script>";
            header("Location: ../modules/admin/adminArtManage.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Close the database connection
    $DbConn = null;
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Article Form</title>
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
        <!-- Hidden input field for Author ID -->
        <input type="hidden" name="authorId" value="<?php echo (!empty($authorIds) ? $authorIds[0] : ''); ?>">

        <label for="article_title">Article Title:</label><br>
        <input type="text" name="article_title" id="article_title" placeholder="Enter Article Title" required /><br><br>

        <label for="article_full_text">Article Content:</label><br>
        <textarea  name="article_full_text" id="article_full_text" rows="4" placeholder="Enter Article Content" required></textarea><br><br>

        <!-- Hidden input fields for date and time -->
        <input type="hidden" name="article_created_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <input type="hidden" name="article_last_update" value="<?php echo date('Y-m-d H:i:s'); ?>">

        <!-- Hidden input field for Display Article -->
        <input type="hidden" name="article_display" value="1">

        <br><br>
        <center>
            <input type="submit" name="submit" value="Submit">
        </center>
        <br><br>
    </form>
</body>
</html>

