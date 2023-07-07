<!DOCTYPE html>
<html>
<head>
    <title>Lọc phim</title>
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
        <div class="navigation-item"><a href="filter.php">Lọc phim</a></div>
        <div class="navigation-item"><a href="#">Bảng xếp hạng</a></div>
    </div>

    <div class="navigation-container">
        <h2>Lọc phim</h2>
    </div>

    <div class="movie-container">
        <div class="filter-container">
            <form class="filter-form" action="filtered_movies.php" method="GET">
                <div class="filter-group">
                    <label for="select-country">Quốc gia:</label>
                    <select id="select-country" name="country">
                        <option value="">Quốc gia</option>
                        <option value="Mĩ">Mĩ</option>
                        <option value="Trung Quốc">Trung Quốc</option>
                        <option value="Hàn Quốc">Hàn Quốc</option>
                        <!-- Thêm các quốc gia khác vào đây -->
                    </select>
                </div>
                <div class="filter-group">
                    <label for="select-genre">Thể loại:</label>
                    <select id="select-genre" name="genre[]" multiple>
                        <option value="">Thể loại</option>
                        <option value="Hài hước">Hài hước</option>
                        <option value="Hành động">Hành động</option>
                        <option value="Tình cảm">Tình cảm</option>
                        <!-- Thêm các thể loại khác vào đây -->
                    </select>
                </div>
                <div class="filter-group">
                    <label for="select-year">Năm:</label>
                    <select id="select-year" name="year">
                        <option value="">Năm</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <!-- Thêm các năm khác vào đây -->
                    </select>
                </div>
                <button class="filter-button" type="submit">Lọc</button>
            </form>
        </div>
    </div>
</body>
</html>
