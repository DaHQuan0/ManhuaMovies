<!-- Trang search.php -->
<?php 
    include "connect.php";
    $noidung = "";

    if(isset($_POST['btn'])){
        $noidung = $_POST['noidung'];

        $dbname = "SELECT art, name FROM films WHERE name LIKE ?";
        $stmt = mysqli_prepare($conn, $dbname);
        mysqli_stmt_bind_param($stmt, "s", $noidung);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManhwaMovies</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./search.css">
    <!-- Link Swiper CSS-->
    <link rel="stylesheet" href="css/cdn.jsdelivr.net_npm_swiper@10.0.4_swiper-bundle.min.css">
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="img/fav-icon.png" type="image/x-icon">
    <!-- Box Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<header>
        <!-- Nav -->
        <div class="nav container">
            <!-- Logo -->
            <a href="TrangChu.html" class="logo">
                Movie<span>Manhwa</span>
            </a>
            <!-- Search Box-->
            <div class="search-box">
                <form method="post" action="search.php" style="display: flex;">
                <input type="text" name="noidung" id="search-input" autocomplete="off" placeholder="Search Movies">
                    <button class="search-button" type="submit" name="btn">
                        <i class='bx bx-search'></i> 
                    </button>
                </form>
            </div>  
            <!-- User -->
            <a href="#" class="user">
                <img src="img/images.png" alt="" class="user-img">
            </a>
            <!-- NavBar -->
            <div class="navbar">
                <a href="#home" class="nav-link nav-active">
                    <i class='bx bx-home' ></i>
                    <span class="nav-link-title">Trang chủ</span>
                </a>
                <a href="#home" class="nav-link">
                    <i class='bx bxs-hot' ></i>
                    <span class="nav-link-title">Thịnh hành</span>
                </a>
                <a href="#home" class="nav-link">
                    <i class='bx bxs-movie' ></i>
                    <span class="nav-link-title">Phim bộ</span>
                </a>
                <a href="#home" class="nav-link">
                    <i class='bx bxs-film'></i>
                    <span class="nav-link-title">Phim lẻ</span>
                </a>
                <a href="#home" class="nav-link">
                    <i class='bx bx-category' ></i>
                    <span class="nav-link-title">Thể loại</span>
                </a>
                <a href="#home" class="nav-link">
                    <i class='bx bx-heart'></i>
                    <span class="nav-link-title">Yêu thích</span>
                </a>
            </div>
        </div>
    </header>

    <?php if(isset($_POST['btn'])) { ?>
        <br>
        <br>
        <br>
        <br><br>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="film">
                <img src="<?php echo $row["art"] ?>" alt="<?php echo $row["name"] ?>" class="film-img">
                <h3 class="film-title"><?php echo $row["name"] ?></h3>
            </div>
        <?php } ?>
    <?php } ?>
</body>
</html>