<?php
    // Kết nối CSDL
    require_once '../Config/connect.php';

    // Lấy id của phim cần xóa từ biến GET
    $id = $_GET['id'];

    // Thực hiện truy vấn SQL để xóa phim từ CSDL
    $sql_delete = "DELETE FROM movies WHERE id = $id";
    $result_delete = mysqli_query($conn, $sql_delete);

    // Kiểm tra kết quả truy vấn SQL
    if ($result_delete) {
        // Chuyển hướng đến trang danh sách phim
        header('location: ad_index.php?page_layout=danhsach');
    } else {
        // Hiển thị thông báo lỗi nếu xóa không thành công
        echo "Lỗi: không thể xóa phim";
    }
?>