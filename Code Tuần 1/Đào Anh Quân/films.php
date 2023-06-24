<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Film</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            include "connect.php"
            
            $sql = "SELECT * FROM films";
            $result = mysqLi_query($conn, $dbname);
            while($row = mysqli_fetch_array($result)){

        ?>
            <br>
            <tr>
                <td><?php echo $row['id'] ?></td>
            </tr>
                
        <?php}?>


    </tbody>
</body>
</html>