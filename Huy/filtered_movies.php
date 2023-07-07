<!DOCTYPE html>
<html>
<head>
    <title>Kết quả tìm kiếm</title>
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
            <select id="select-genre" multiple>
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
        <h2>Kết quả tìm kiếm</h2>
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

        // Xử lý các tham số lọc
        $country = $_GET['country'] ?? '';
        $genres = $_GET['genre'] ?? [];
        $year = $_GET['year'] ?? '';

        // Tạo câu truy vấn dựa trên các tham số lọc
        $sql = "SELECT * FROM movies WHERE 1 = 1";

        if ($country) {
            $sql .= " AND country = '$country'";
        }
        if (!empty($genres)) {
            $genreConditions = [];
            foreach ($genres as $genre) {
                $genreConditions[] = "genre LIKE '%$genre%'";
            }
            $genreConditionsString = implode(" OR ", $genreConditions);
            $sql .= " AND ($genreConditionsString)";
        }
        if ($year) {
            $sql .= " AND year = '$year'";
        }

        // Thực thi truy vấn để lấy danh sách bộ phim từ bảng "movies"
        $result = $conn->query($sql);

