<!DOCTYPE html>
<html>
<head>
    <title>Danh sách phim lẻ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header-container">
        <div class="logo">
            Logo của trang
        </div>
        <div class="user-actions">
            <a href="#">Đăng nhập</a> | <a href="#">Đăng ký</a>
        </div>
        <div class="search-container">
            <form class="search-form" action="#" method="GET">
                <input class="search-input" type="text" name="search" placeholder="Tìm kiếm phim...">
                <button class="search-button" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>

    <div class="navigation-container">
        <div class="navigation-item"><a href="movies_list.php">Trang chủ</a></div>
        <div class="navigation-item"><a href="single.php">Phim lẻ</a></div>
        <div class="navigation-item"><a href="series.php">Phim bộ</a></div>
        <div class="navigation-item"><a href="#">Quốc gia</a></div>
        <div class="navigation-item"><a href="#">Thể loại</a></div>
        <div class="navigation-item"><a href="#">Bảng xếp hạng</a></div>
    </div>

    <div class="navigation-container">
        <h2>Phim đề xuất</h2>
    </div>

    <div class="movie-container">

        <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "movie_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Không thể kết nối đến cơ sở dữ liệu: " . $conn->connect_error);
        }

        // Thực thi truy vấn để lấy danh sách phim lẻ từ bảng "movies" với điều kiện là phim lẻ
        $sql = "SELECT * FROM movies WHERE genre = 'Phim lẻ'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị danh sách phim lẻ
            while ($row = $result->fetch_assoc()) {
                echo "<div class='movie-item'>";
                echo "<a href='movie_detail.php?id=" . $row['id'] . "'>";
                echo "<img class='movie-image' src='" . $row['image'] . "'>";
                echo "<div class='movie-title'>" . $row['title'] . "</div>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "Không có phim lẻ nào.";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>
</body>
</html>
