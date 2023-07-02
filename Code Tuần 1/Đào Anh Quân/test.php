<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ManhuaMovies</title>
  <link rel="icon" type="image/x-icon" href="#">
  <link rel="stylesheet" href="./TrangChu.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
  <header class="header bgr">
    <div class="all">                    
        <nav class="nav container">
            <div class="all-bot all">
                <a href="Header.html" class="logo">
                    <img src="" alt="Logo" class="img-page"/>
                </a>
            </div>
            <ul class="ul-right">
                <li class="li-setup"><a href="./TrangChu.html">Kho phim</a></li>
                <li class="li-setup"><a href="./PhimLe.html">Phim lẻ</a></li> <!-- Thêm phần này -->
                <li class="li-setup"><a href="./PhimBo.html">Phim bộ</a></li>
                <li class="li-setup user"><a href="">Thể loại</a>
                    <div class="dropdown-content">
                        <a href=""><button class="btn btn-primary hidden mbtn">Cổ đại</button></a>
                        <a href=""><button class="btn btn-primary hidden mbtn">Chuyển sinh</button></a>
                        <a href=""><button class="btn btn-primary hidden mbtn">Xuyên không</button></a>
                        <a href=""><button class="btn btn-primary hidden mbtn">Mạt thế</button></a>
                    </div>
                </li>
                <li class="li-setup user"><a href="..."><i class="fa-solid fa-user"></i>Tài Khoản</a>
                    <div class="dropdown-content">
                        <a href="...">
                            <button class="btn btn-primary hidden mbtn">Đăng nhập</button>
                        </a>
                        <a href="...">
                            <button class="btn btn-primary hidden mbtn">Đăng ký</button>
                        </a>   
                    </div>
                </li>
            </ul>
            <div class="headitems ">
                <div id="advc-menu" class="search">
                    <form method="post">
                        <input type="text" placeholder="Nhập thông tin tìm kiếm" name="noidung" autocomplete="off">
                        <button class="search-button" type="submit" name="btn">
                            <span class="fas fa-search"></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
  </header>
  <div class="main all">
    
  </div>
</body>
</html>

<?php 
    include "connect.php";
    $noidung = "";
    
    if(isset($_POST['btn'])){
       $noidung = $_POST['noidung'];
    } else {
        echo $noidung = "false";
    }
?>

<?php 
    $dbname = "SELECT name FROM films WHERE name LIKE ?";
    $result = mysqli_query($conn, $dbname);
    while ($row = mysqli_fetch_array($result)){
?>
    <br>
    <main>
        <tr>
            <td style="color: black; margin-top: 100px"><?php echo $row["name"] ?></td>
        </tr>
    </main>
<?php } ?>