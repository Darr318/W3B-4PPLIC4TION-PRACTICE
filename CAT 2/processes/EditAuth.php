<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
 <table>
    <thead>
        <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Biography</th>
        <th>Date of Birth</th>
        <th>Suspended</th>
        <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../configs/DbConn.php';
        $query = "SELECT * FROM authorstb ORDER BY AuthorFullName";
        $stmt = $DbConn->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetchAll();
        if($result){
            foreach($result as $row){
                ?>
                <tr>
                <td><?=$row->AuthorFullName;?></td>
                <td><?=$row->AuthorEmail;?></td>
                <td><?=$row->AuthorAddress;?></td>
                <td><?=$row->AuthorBiography;?></td>
                <td><?=$row->AuthorDateOfBirth;?></td>
                <td><?=$row->AuthorSuspended;?></td>
                <td>
                    <a href="Edit.php?id=<?= $row->AuthorFullName;?>" class="btn btn-primary">Edit</a>
                </td>
                </tr>
                <?php
            }
        }
        else{
            ?>
            <tr>
                <td colspan="6">No Record Found</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
</body>
</html>
