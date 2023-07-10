<?php
include 'db_connection.php';

// Lấy ID phim từ tham số truy vấn
$movieId = isset($_GET['id']) ? $_GET['id'] : '';

// Truy vấn cơ sở dữ liệu để lấy thông tin chi tiết phim dựa trên ID
$query = "SELECT * FROM movies WHERE id = '$movieId'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem phim có tồn tại hay không
if (!$row) {
    echo "Không tìm thấy thông tin phim.";
    exit;
}

// Hiển thị thông tin chi tiết phim
echo "<h2>" . $row['title'] . "</h2>";
echo "<img src='" . $row['image'] . "' alt='" . $row['title'] . "'>";
echo "<p>Tiêu đề: " . $row['title'] . "</p>";
echo "<p>Năm phát hành: " . $row['release_year'] . "</p>";
echo "<p>Quốc gia: " . $row['country'] . "</p>";
echo "<p>Thể loại: " . $row['genre'] . "</p>";
echo "<p>Trạng thái: " . $row['status'] . "</p>";
echo "<p>Số tập: " . $row['episodes'] . "</p>";
echo "<p>Diễn viên: " . $row['actors'] . "</p>";
echo "<p>Đạo diễn: " . $row['director'] . "</p>";
echo "<p>Tóm tắt: " . $row['summary'] . "</p>";

mysqli_close($connection);
?>
