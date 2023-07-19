<?php
session_start();
include 'db_connection.php';

if (isset($_GET['user_id'])) {
    $_SESSION['user_id'] = $_GET['user_id'];
} else {
    $_SESSION['user_id'] = null;
}

if ($_SESSION['user_id'] !== null) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

// Kiểm tra xem đã nhập từ khóa tìm kiếm hay chưa
if (isset($_POST['noidung'])) {
    $keyword = $_POST['noidung'];

    // Tính toán số phần tử trên mỗi trang và trang hiện tại
    $itemsPerPage = 4; // Số phim hiển thị trên mỗi trang
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Trang hiện tại, mặc định là trang đầu tiên

    // Tính toán số phần tử bỏ qua
    $offset = ($page - 1) * $itemsPerPage;
    if ($offset < 0) {
        $offset = 0;
    }

    // Truy vấn danh sách phim từ cơ sở dữ liệu với phân trang và tìm kiếm
    $sql = "SELECT * FROM movies WHERE (genre LIKE '%$keyword%' OR title LIKE '%$keyword%' OR othertitle LIKE '%$keyword%') LIMIT $itemsPerPage OFFSET $offset";
    $result = $connection->query($sql);

    // Truy vấn để đếm tổng số phim phù hợp với từ khóa tìm kiếm
    $sqlCount = "SELECT COUNT(*) AS total FROM movies WHERE (genre LIKE '%$keyword%' OR title LIKE '%$keyword%' OR othertitle LIKE '%$keyword%')";
    $resultCount = $connection->query($sqlCount);
    $rowCount = $resultCount->fetch_assoc();
    $totalItems = $rowCount['total']; // Tổng số phim phù hợp
    $totalPages = ceil($totalItems / $itemsPerPage); // Tổng số trang

    // Xử lý khi người dùng nhấp vào nút Đến trang hoặc bấm Enter
    if (isset($_POST['go']) || isset($_POST['targetPage'])) {
        $targetPage = isset($_POST['targetPage']) ? $_POST['targetPage'] : $_POST['targetPageEnter'];
        // Kiểm tra xem trang hợp lệ hay không
        if ($targetPage >= 1 && $targetPage <= $totalPages) {
            $page = $targetPage;
            $offset = ($page - 1) * $itemsPerPage;
            $sql = "SELECT * FROM movies WHERE (genre LIKE '%$keyword%' OR title LIKE '%$keyword%' OR othertitle LIKE '%$keyword%') LIMIT $itemsPerPage OFFSET $offset";
            $result = $connection->query($sql);
        }
    }
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
    <link rel="stylesheet" type="text/css" href="dropdown.css">
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
                <form method="post" action="Search.php" style="display: flex;">
                    <input type="text" name="noidung" autocomplete="off" id="search-input" placeholder="Search Movies">
                    <button style="background-color: #2D2E37; border: none;" class="search-button" type="submit" name="btn">
                        <i class='bx bx-search'></i>
                    </button>
                </form>
            </div>
            <!-- User -->
            <a href="<?php echo isset($_SESSION['user_id']) ? 'UserInfo.php?user_id=' . $_SESSION['user_id'] : 'Dangnhap.php'; ?>" class="user">
                <img src="<?php echo $user !== null ? $user['avatar_link'] : 'img/images.png'; ?>" alt="" class="user-img">
            </a>
            <!-- NavBar -->
            <div class="navbar">
            <a href="Trangchu.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link nav-active">
                    <i class='bx bx-home' ></i>
                    <span class="nav-link-title">Trang chủ</span>
                </a>
                <a href="Trangchu.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link">
                    <i class='bx bxs-hot' ></i>
                    <span class="nav-link-title">Thịnh hành</span>
                </a>
                <a href="PhimBo.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link">
                    <i class='bx bxs-movie' ></i>
                    <span class="nav-link-title">Phim bộ</span>
                </a>
                <a href="PhimLe.php?user_id=<?php echo  $_SESSION['user_id']; ?>" class="nav-link">
                    <i class='bx bxs-film'></i>
                    <span class="nav-link-title">Phim lẻ</span>
                    <div class="dropdown-toggle-container" id="genre-dropdown-toggle">
                        <a href="#" class="nav-link dropdown">
                            <i class="bx bx-category nav-link-icon"></i>
                            <span class="nav-link-title">Thể loại</span>
                         </a>
                         <div class="dropdown-content">
                         <div class="column">
                         <a href="Theloai.php?genre=Hài hước&user_id=<?php echo $userId; ?>">Hài hước</a>
                             <a href="Theloai.php?genre=Hành động">Hành động</a>
                             <a href="Theloai.php?genre=Phiêu lưu">Phiêu lưu</a>
                             <a href="Theloai.php?genre=Tình cảm">Tình cảm</a>
                             <a href="Theloai.php?genre=Học đường">Học đường</a>
                             <a href="Theloai.php?genre=Võ thuật">Võ thuật</a>
                             <a href="Theloai.php?genre=Tài liệu">Tài liệu</a>
                 
                         </div>
                         <div class="column">
                             <a href="Theloai.php?genre=Viễn tưởng">Viễn tưởng</a>
                             <a href="Theloai.php?genre=Hoạt hình">Hoạt hình</a>
                             <a href="Theloai.php?genre=Thể thao">Thể thao</a>
                             <a href="Theloai.php?genre=Âm nhạc">Âm nhạc</a>
                             <a href="Theloai.php?genre=Gia đình">Gia đình</a>
                             <a href="Theloai.php?genre=Kinh dị">Kinh dị</a>
                             <a href="Theloai.php?genre=Tâm lý">Tâm lý</a>
                         </div>
                         <!-- Thêm các thể loại khác tương ứng với các option -->
                     </div>
                 
                     </div>
                
                 
                <a href="Yeuthich.php" class="nav-link">
                    <i class='bx bx-heart'></i>
                    <span class="nav-link-title">Yêu thích</span>
                </a>
            </div>
        </div>
    </header>
    
    <section class="popular container" id="popular" style="margin-top: 80px;">
        <div class="heading">
            <h2 class="heading-title">Kết quả tìm kiếm cho "<?php echo $keyword; ?>"</h2>
        </div>
        <div class="popular-content">
            <div class="movie-grid">
                <?php
                // Hiển thị danh sách phim tìm kiếm
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="movie-box">
                            <img src="' . $row['image'] . '" alt="" class="movie-box-img">
                            <div class="box-text">
                                <h2 class="movie-title">' . $row['title'] . '</h2>
                                <span class="movie-type">' . $row['genre'] . '</span>
                                <a href="chitietphim.php?id=' . $row['id'] . '&user_id=' . $_SESSION['user_id'] . '" class="watch-btn play-btn">
                                    <i class="bx bx-right-arrow"></i>
                                </a>
                            </div>
                        </div>';
                    }
                } else {
                    echo "Không tìm thấy kết quả phù hợp.";
                }
                ?>
            </div>
        </div>
        <div class="pagination">
            <!-- Phân trang code -->
        </div>
    </section>

    <script src="js/main.js"></script>
</body>
</html>

<?php
$connection->close();
?>
