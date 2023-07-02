<form method="post">
    <input type="text" name="noidung">
    <button type="submit" name="btn">Search</button>
</form>



<?php 
    include "connect.php";
    $noidung = "";
    
    if(isset($_POST['btn'])){
       $noidung = $_POST['noidung'];
    } 
?>

<?php 
    $dbname = "SELECT name FROM films WHERE name LIKE ?";
    $stmt = mysqli_prepare($conn, $dbname);
    mysqli_stmt_bind_param($stmt, "s", $noidung);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_array($result)){
        echo "<p>". $row["name"]. "</p>";
    }
?>

