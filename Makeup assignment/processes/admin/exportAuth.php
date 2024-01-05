<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<br>
<center>
<form action="exportAuthors.php" method="post">
    <input type="submit" name="export_pdf" value="Export to PDF">
    <input type="submit" name="export_text" value="Export to Text">
    <input type="submit" name="export_excel" value="Export to Excel">
</form>
</center>

</body>
</html>