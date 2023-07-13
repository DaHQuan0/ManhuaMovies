<?php
    include "Header.html";
    include "connect.php";
    $noidung = "";
    
    if(isset($_POST['btn'])){
       $noidung = $_POST['noidung'];
    } else {
        echo $noidung = "false";
    }
?>

<?php 
    $dbname = "SELECT art, name FROM films WHERE name LIKE ?";
    $stmt = mysqli_prepare($conn, $dbname);
    mysqli_stmt_bind_param($stmt, "s", $noidung);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
?>
        <div class="film">
            <img src="<?php echo $row["art"] ?>" alt="<?php echo $row["name"] ?>" class="film-img">
            <h3 class="film-title"><?php echo $row["name"] ?></h3>
        </div>
<?php } else {
        echo "Không tìm thấy kết quả phù hợp.";
    }
?>