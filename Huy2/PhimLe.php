<!DOCTYPE html>
<html>
<head>
    <title>Phim bộ</title>
    <style>
        /* CSS styling cho trang */
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <!-- Logo của trang -->
        </div>
      
        <div class="search">
            <!-- Khung tìm kiếm -->
            <form action="search.php" method="GET">
                <input type="text" name="keyword" placeholder="Nhập từ khóa">
                <button type="submit">Tìm kiếm</button>
            </form>
        </div>

        <div class="user">
            <!-- Đăng nhập và Đăng kí -->
            <!-- Danh sách yêu thích -->
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="Trangchu.php">Trang chủ</a></li>
            <li><a href="PhimLe.php">Phim lẻ</a></li>
            <li><a href="PhimBo.php">Phim bộ</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Thể loại</a>
                <div class="dropdown-content">
                    <!-- Các mục trong dropdown thể loại -->
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Quốc gia</a>
                <div class="dropdown-content">
                    <!-- Các mục trong dropdown quốc gia -->
                </div>
            </li>
            <li><a href="#">Bảng xếp hạng</a></li>
        </ul>
    </nav>
    <section>
        <div class="movies">
            <h2>Danh sách phim lẻ</h2>
            <div class="movie-list">
                <?php
                include 'db_connection.php';

                $query = "SELECT * FROM movies WHERE genre LIKE '%Phim lẻ%'";
                $result = mysqli_query($connection, $query);

                $counter = 0; // Biến đếm số bộ phim trên mỗi hàng
                echo "<div class='movie-row'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($counter % 3 == 0 && $counter != 0) {
                        echo "</div><div class='movie-row'>"; // Đóng hàng trước và mở hàng mới
                    }
                    echo "<div class='movie-item'>";
                    echo "<a href='movie_detail.php?id=" . $row['id'] . "'>";
                    echo "<img class='movie-image' src='" . $row['image'] . "'>";
                    echo "<div class='movie-title'>" . $row['title'] . "</div>";
                    echo "</a>";
                    echo "</div>";
                    $counter++;
                }
                echo "</div>";

                mysqli_close($connection);
                ?>
            </div>
        </div>
    </section>
    <footer>
        <!-- Nội dung footer -->
    </footer>
</body>
</html>
