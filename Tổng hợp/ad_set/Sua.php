<?php 
    //Lấy id của sản phẩm cần sửa
    $id = $_GET['id'];

    //Kết nối CSDL
    require_once 'Config/connect.php';

    //Lấy thông tin sản phẩm cần sửa từ CSDL
    $sql = "SELECT * FROM films WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['sbm'])){
        $name = $_POST['name'];
        $film = $_POST['film'];
        $category = $_POST['category'];

        //Kiểm tra xem người dùng có cập nhật ảnh mới không
        if(!empty($_FILES['art']['name'])){
            $art = $_FILES['art']['name'];
            move_uploaded_file($_FILES["art"]["tmp_name"], "../img/$art");
            $art_path = "../img/$art";
        } else {
            $art_path = $row['art'];
        }

        //Kiểm tra xem người dùng có cập nhật video mới không
        if(!empty($_FILES['video']['name'])){
            $video = $_FILES['video']['name'];
            move_uploaded_file($_FILES["video"]["tmp_name"], "../videos/$video");
            $video_path = "../videos/$video";
        } else {
            $video_path = $row['video'];
        }

        //Cập nhật thông tin sản phẩm vào CSDL
        $sql_update = "UPDATE films SET name = '$name', film = '$film', art = '$art_path', video = '$video_path', category = '$category' WHERE id = $id";
        mysqli_query($conn, $sql_update);

        header('location: ad_index.php?page_layout=danhsach');
    }
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Sửa phim</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Tên phim:</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Giới thiệu phim:</label>
                    <input type="text" name="film" class="form-control" value="<?php echo $row['film']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Ảnh phim:</label>
                    <input type="file" name="art" class="form-control">
                    <img src="<?php echo $row['art']; ?>" alt="Ảnh phim" width="200">
                </div>
                <!-- <div class="form-group">
                    <label for="">Trailer phim:</label>
                    <input type="file" name="trailer" class="form-control">
                </div> -->
                <div class="form-group">
                    <label for="">Phim:</label>
                    <input type="file" name="video" class="form-control">
                    <video width="200" height="150" controls>
                        <source src="<?php echo $row['video']; ?>" type="video/mp4">
                    </video>
                </div>
                <div class="form-group">
                    <label for="">Thể loại phim:</label>
                    <input type="text" name="category" class="form-control" value="<?php echo $row['category']; ?>" required>
                </div>
                <button name="sbm" class="btn btn-success" type="submit">Sửa</button>
            </form>
        </div>
    </div>
</div>