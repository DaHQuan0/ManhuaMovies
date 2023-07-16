<?php 
    //Kết nối CSDL
    require_once 'Config/connect.php';

    //Lấy ID phim cần xóa từ URL
    $id = $_GET['id'];

    //Kiểm tra xem ID có tồn tại không
    if(isset($id)){
        //Sử dụng câu lệnh prepared statement để xóa phim
        $sql = "DELETE FROM movies WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //Chuyển hướng về trang danh sách phim
        header('location: ad_index.php?page_layout=danhsach');
    } else {
        //Nếu không có ID, thông báo lỗi
        echo "Không tìm thấy ID phim cần xóa";
    }
?>