<?php
include 'db_connection.php';

// Lấy từ khóa từ URL hoặc biến POST (tùy thuộc vào phương thức gửi dữ liệu)
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
// Nếu bạn sử dụng phương thức POST, hãy sử dụng $_POST['keyword'] thay vì $_GET['keyword']

// Loại bỏ các ký tự đặc biệt để tránh tấn công SQL injection
$keyword = mysqli_real_escape_string($connection, $keyword);

// Câu truy vấn SQL để tìm kiếm phim theo từ khóa trong tiêu đề và thể loại
$query = "SELECT * FROM movies WHERE LOWER(title) LIKE LOWER('%$keyword%') OR LOWER(genre) LIKE LOWER('%$keyword%') OR LOWER(summary) LIKE LOWER('%$keyword%')" ;
$result = mysqli_query($connection, $query);

// Kiểm tra kết quả tìm kiếm
if (mysqli_num_rows($result) > 0) {
    // Hiển thị danh sách phim
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='movie-item'>";
        echo "<a href='movie_detail.php?id=" . $row['id'] . "'>";
        echo "<img class='movie-image' src='" . $row['image'] . "'>";
        echo "<div class='movie-title'>" . $row['title'] . "</div>";
        echo "</a>";
        echo "</div>";
    }
} else {
    // Hiển thị thông báo không tìm thấy kết quả
    echo "Không tìm thấy kết quả phù hợp.";
}

mysqli_close($connection);
?>
