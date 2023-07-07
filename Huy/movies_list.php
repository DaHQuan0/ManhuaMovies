<!DOCTYPE html>
<html>
<head>
    <title>Danh sách bộ phim</title>
    <link rel="stylesheet" type="text/css" href="movies_list.css">
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
        <div class="navigation-item"><a href="filter.php">Lọc phim</a></div>
        <div class="navigation-item">
            <select id="select-country">
                <option value="">Quốc gia</option>
                <option value="Mĩ">Mĩ</option>
                <option value="Trung Quốc">Trung Quốc</option>
                <option value="Hàn Quốc">Hàn Quốc</option>
                <!-- Thêm các quốc gia khác vào đây -->
            </select>
        </div>
        <div class="navigation-item">
            <select id="select-genre">
                <option value="">Thể loại</option>
                <option value="Hài hước">Hài hước</option>
                <option value="Hành động">Hành động</option>
                <option value="Tình cảm">Tình cảm</option>
                <!-- Thêm các thể loại khác vào đây -->
            </select>
        </div>
        <div class="navigation-item">
            <select id="select-year">
                <option value="">Năm</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <!-- Thêm các năm khác vào đây -->
            </select>
        </div>
        <div class="navigation-item">
            <button id="filter-button">Lọc</button>
        </div>
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
        
        // Xử lý từ khóa tìm kiếm
        $keyword = $_GET['search'] ?? '';

        // Tạo câu truy vấn dựa trên từ khóa tìm kiếm
        $sql = "SELECT * FROM movies WHERE title LIKE '%$keyword%' OR genre LIKE '%$keyword%' OR country LIKE '%$keyword%' OR release_year LIKE '%$keyword%'";
        $result = $conn->query($sql);
    
        // Xử lý các tham số lọc
        $country = $_GET['country'] ?? '';
        $genre = $_GET['genre'] ?? '';
        $year = $_GET['year'] ?? '';

        // Tạo câu truy vấn dựa trên các tham số lọc
        $sql = "SELECT * FROM movies WHERE 1 = 1";

        if ($country) {
            $sql .= " AND country = '$country'";
        }
        if ($genre) {
            $sql .= " AND genre = '$genre'";
        }
        if ($year) {
            $sql .= " AND release_year = '$year'";
        }

        // Thực thi truy vấn để lấy danh sách bộ phim từ bảng "movies"
        $result = $conn->query($sql);

        // Số lượng phim trên mỗi trang
        $itemsPerPage = 12;

        // Tính tổng số trang
        $totalPages = ceil($result->num_rows / $itemsPerPage);

        // Xác định trang hiện tại
        $currentPage = $_GET['page'] ?? 1;

        // Tính vị trí bắt đầu và số phim cần lấy
        $startIndex = ($currentPage - 1) * $itemsPerPage;
        $numItems = $itemsPerPage;

        // Thêm LIMIT vào câu truy vấn
        $sql .= " LIMIT $startIndex, $numItems";

        // Thực thi truy vấn mới để lấy danh sách phim trên trang hiện tại
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị danh sách bộ phim
            while ($row = $result->fetch_assoc()) {
                echo "<div class='movie-item'>";
                echo "<a href='movie_detail.php?id=" . $row['id'] . "'>";
                echo "<img class='movie-image' src='" . $row['image'] . "'>";
                echo "<div class='movie-title'>" . $row['title'] . "</div>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "Không có bộ phim nào.";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>

    <div class="pagination-container">
        <?php
        // Hiển thị các nút chuyển trang
        for ($page = 1; $page <= $totalPages; $page++) {
            $activeClass = ($page == $currentPage) ? "active" : "";
            echo "<a class='pagination-link $activeClass' href='movies_list.php?page=$page'>$page</a>";
        }
        ?>
    </div>

    <script>
        document.getElementById('filter-button').addEventListener('click', function() {
            var selectedCountry = document.getElementById('select-country').value;
            var selectedGenre = document.getElementById('select-genre').value;
            var selectedYear = document.getElementById('select-year').value;
            var url = 'movies_list.php?';

            if (selectedCountry) {
                url += 'country=' + encodeURIComponent(selectedCountry) + '&';
            }
            if (selectedGenre) {
                url += 'genre=' + encodeURIComponent(selectedGenre) + '&';
            }
            if (selectedYear) {
                url += 'year=' + encodeURIComponent(selectedYear) + '&';
            }

            // Xóa ký tự & dư thừa ở cuối URL
            url = url.slice(0, -1);

            window.location.href = url;
        });
    </script>
</body>
</html>
