<?php
    //Kết nối CSDL
    require_once 'Config/connect.php';

    //Kiểm tra nếu có id được truyền qua URL
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        //Truy vấn CSDL để xóa phim
        $query = mysqli_query($conn, "DELETE FROM movies WHERE id = $id");

        if($query){
            //Chuyển hướng về trang danh sách phim
            header("Location: ad_index.php?page_layout=danhsachphim");
        } else {
            //Thông báo lỗi nếu xóa không thành công
            echo "<p>Xóa phim không thành công</p>";
        }
    } else {
        //Hiển thị thông báo nếu không có id được truyền qua URL
        echo "<p>Không có id phim được truyền qua URL</p>";
    }
?>