<?php 
    if(isset($_POST['sbm'])){
        $name = $_POST['name'];
        $film = $_POST['film'];

        //Kiểm tra xem người dùng đã chọn tệp tin ảnh mới hay chưa
        if(isset($_FILES['art']) && $_FILES['art']['error'] == 0){
            $art = $_FILES['art']['name'];
            move_uploaded_file($_FILES["art"]["tmp_name"], "../img/$art");
        }

        //Kiểm tra xem người dùng đã chọn tệp tin video mới hay chưa
        if(isset($_FILES['video']) && $_FILES['video']['error'] == 0){
            $video = $_FILES['video']['name'];
            move_uploaded_file($_FILES["video"]["tmp_name"], "../videos/$video");
        }

        $category = $_POST['category'];

        //Kết nối CSDL
        require_once 'Config/connect.php';

        //Lưu vào CSDL
        $sql = "INSERT INTO films (name, film, art, video, category)
        VALUES ('$name', '$film', '$art', '$video', '$category')";

        //Kiểm tra xem đã có tệp tin được tải lên hay chưa
        if(!empty($art) && !empty($video)){
            mysqli_query($conn, $sql);
            header('location: ad_index.php?page_layout=danhsach');
        } else {
            echo "Vui lòng tải lên đầy đủ ảnh và video";
        }
    }
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm phim</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Tên phim:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Giới thiệu phim:</label>
                    <input type="text" name="film" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Ảnh phim:</label>
                    <input type="file" name="art" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Phim:</label>
                    <input type="file" name="video" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Thể loại phim:</label>
                    <input type="text" name="category" class="form-control" required>
                </div>
                <button name="sbm" class="btn btn-success" type="submit">Thêm</button>
            </form>
        </div>
    </div>
</div>