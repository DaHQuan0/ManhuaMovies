<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';

// Kiểm tra xem có dữ liệu bình luận được gửi từ form hay không
if (isset($_POST['comment']) && isset($_POST['movie_id'])) {
    $comment = $_POST['comment'];
    $movieId = $_POST['movie_id'];

    // Thực hiện truy vấn để lưu bình luận vào cơ sở dữ liệu
    $sql = "INSERT INTO comments (movie_id, comment, created_at) VALUES ('$movieId', '$comment', NOW())";
    if ($connection->query($sql) === TRUE) {
        echo "Bình luận đã được gửi thành công.";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $connection->error;
    }
}

// Đóng kết nối cơ sở dữ liệu
$connection->close();
?>

