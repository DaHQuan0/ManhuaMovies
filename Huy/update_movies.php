<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cập nhật phim</title>
    <link rel="stylesheet" type="text/css" href="update_movies.css">
</head>
<body>
    <h1 style="font-family: Arial, sans-serif;margin-left: 80px; margin-top: 40px;">Cập nhật phim</h1>
    <?php
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "movie_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        echo '<script>alert("Không thể kết nối đến cơ sở dữ liệu: ' . $conn->connect_error . '");</script>';
        die("Không thể kết nối đến cơ sở dữ liệu: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ biểu mẫu
        $title = $_POST['title'];
        $image = $_POST['image'];
        $releaseYear = $_POST['release_year'];
        $country = $_POST['country'];
        $genre = $_POST['genre'];
        $status = $_POST['status'];
        $episodes = $_POST['episodes'];
        $actors = $_POST['actors'];
        $director = $_POST['director'];
        $summary = $_POST['summary'];

        // Thực thi truy vấn để thêm dữ liệu vào bảng "movies"
        $sql = "INSERT INTO movies (title, image, release_year, country, genre, status, episodes, actors, director, summary) 
                VALUES ('$title', '$image', '$releaseYear', '$country', '$genre', '$status', '$episodes', '$actors', '$director', '$summary')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Thêm phim thành công");</script>';
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
    ?>
    <form action="update_movies.php" method="POST">
        <label for="title">Tiêu đề:</label>
        <input type="text" id="title" name="title" required>

        <label for="image">Đường dẫn ảnh:</label>
        <input type="text" id="image" name="image" required>

        <label for="release_year">Năm sản xuất:</label>
        <input type="text" id="release_year" name="release_year" required>

        <label for="country">Quốc gia:</label>
        <input type="text" id="country" name="country" required>

        <label for="genre">Thể loại:</label>
        <input type="text" id="genre" name="genre" required>

        <label for="status">Trạng thái:</label>
        <input type="text" id="status" name="status" required>

        <label for="episodes">Số tập:</label>
        <input type="text" id="episodes" name="episodes" required>

        <label for="actors">Diễn viên:</label>
        <input type="text" id="actors" name="actors" required>

        <label for="director">Đạo diễn:</label>
        <input type="text" id="director" name="director" required>

        <label for="summary">Nội dung:</label>
        <textarea id="summary" name="summary" required></textarea>

        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
