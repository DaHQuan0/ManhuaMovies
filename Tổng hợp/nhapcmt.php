<?php
// Kết nối đến cơ sở dữ liệu
require_once 'Config/connect.php';

// Kiểm tra xem có dữ liệu bình luận được gửi từ form hay không
if (isset($_POST['comment']) && isset($_POST['movie_id'])) {
    $comment = $_POST['comment'];
    $movieId = $_POST['movie_id'];
    
    // Kiểm tra xem user_id đã được truyền vào hay chưa
    if (isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        
        // Thực hiện truy vấn để lưu bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO comments (movie_id, comment, created_at, user_id) VALUES ('$movieId', '$comment', NOW(), '$userId')";
        if ($conn->query($sql) === TRUE) {
            echo "Bình luận đã được gửi thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Nếu user_id chưa được truyền vào, hiển thị thông báo và nút Đăng nhập
        echo "Vui lòng đăng nhập để bình luận. ";
        echo "<a href='Dangnhap.php'>Đăng nhập</a>";
    }
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
