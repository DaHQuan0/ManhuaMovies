<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
    <style>
        /* CSS styling cho trang chủ */
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
                    <select id="select-genre" onchange="filterByGenre()">
                        <option value="">Chọn thể loại</option>
                        <option value="Hài hước">Hài hước</option>
                        <option value="Giật gân">Giật gân</option>
                        <!-- Thêm các thể loại khác vào đây -->
                    </select>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Quốc gia</a>
                <div class="dropdown-content">
                <select id="select-country" onchange="filterByCountry()">
                    <option value="">Chọn quốc gia</option>
                        <option value="Mĩ">Mĩ</option>
                        <option value="Trung Quốc">Trung Quốc</option>
                        <option value="Hàn Quốc">Hàn Quốc</option>
                        <!-- Thêm các quốc gia khác vào đây -->
                    </select>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" class="dropbtn">Năm</a>
                <div class="dropdown-content">
                <select id="select-year" onchange="filterByYear()">
                    <option value="">Chọn năm</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <!-- Thêm các năm khác vào đây -->
                </select>
                </div>
            </li>

            <li>
               <button onclick="applyFilters()">Lọc</button>
            </li>
            
            <li><a href="#">Bảng xếp hạng</a></li>
        </ul>
    </nav>
    <section>
        <div class="movies">
            <h2>Danh sách phim bộ</h2>
            <div class="movie-list">
                <?php
                include 'db_connection.php';

                $query = "SELECT * FROM movies WHERE genre LIKE '%Phim bộ%' LIMIT 6";
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

            <div class="view-more">
                 <a href="PhimBo.php">Xem thêm</a>
            </div>

        </div>
        <div class="movies">
            <h2>Danh sách phim lẻ</h2>
            <div class="movie-list">
                <?php
                include 'db_connection.php';

                $query = "SELECT * FROM movies WHERE genre LIKE '%Phim lẻ%' LIMIT 6";
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
        <div class="view-more">
            <a href="PhimLe.php">Xem thêm</a>
        </div>
    </section>
    <footer>
        <!-- Nội dung footer -->
    </footer>
    <script src="filter.js"></script>
</body>
</html>
