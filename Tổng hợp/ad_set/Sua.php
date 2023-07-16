<?php 
    //Lấy id của phim cần sửa 
    $id = $_GET['id']; 
    
    //Kết nối CSDL 
    require_once 'Config/connect.php'; 
    //Lấy thông tin phim cần sửa từ CSDL 
    $sql = "SELECT * FROM movies WHERE id = $id"; 
    $result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($result); 
    if(isset($_POST['sbm'])){ 
        $title = $_POST['title']; 
        $summary = $_POST['summary']; 
        $genre = $_POST['genre']; 
        
        //Kiểm tra xem người dùng có cập nhật ảnh mới không 
        if(!empty($_FILES['image']['name'])){ 
            $image = $_FILES['image']['name']; 
            move_uploaded_file($_FILES["image"]["tmp_name"], "../img/$image"); 
            $image_path = "../img/$image"; 
        } else { 
            $image_path = $row['image']; 
        } 
            
        //Kiểm tra xem người dùng có cập nhật video mới không 
        if(!empty($_FILES['video_link']['name'])){ 
            $video_link = $_FILES['video_link']['name']; 
            move_uploaded_file($_FILES["video_link"]["tmp_name"], "../videos/$video_link"); 
            $video_link_path = "../videos/$video_link"; 
        } else { 
            $video_link_path = $row['video_link']; 
        } 
        //Cập nhật thông tin phim vào CSDL 
        $sql_update = "UPDATE movies SET title = '$title', summary = '$summary', image = '$image_path', video_link = '$video_link_path', genre = '$genre' WHERE id = $id"; mysqli_query($conn, $sql_update); header('location: ad_index.php?page_layout=danhsach'); 
} ?> 
<div class="container-fluid"> 
    <div class="card"> 
        <div class="card-header"> 
            <h2>Sửa phim</h2> 
        </div> 
        <div class="card-body"> 
            <form action="" method="POST" enctype="multipart/form-data"> 
                <div class="form-group"> 
                    <label for="">Tên phim:</label> 
                    <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required> 
                </div> 
                <div class="form-group"> 
                    <label for="">Giới thiệu phim:</label> 
                    <input type="text" name="summary" class="form-control" value="<?php echo $row['summary']; ?>" required> 
                </div> 
                <div class="form-group"> 
                    <label for="">Ảnh phim:</label> 
                    <input type="file" name="image" class="form-control"> 
                    <img src="<?php echo $row['image']; ?>" alt="Ảnh phim" width="200"> 
                </div> 
                <div class="form-group"> 
                    <label for="">Trailer phim:</label> 
                    <input type="text" name="video_link" class="form-control" value="<?php echo $row['video_link']; ?>" required> 
                </div> 
                <div class="form-group"> 
                    <label for="">Thể loại phim:</label> 
                    <input type="text" name="genre" class="form-control" value="<?php echo $row['genre']; ?>" required> 
                </div> 
                <button name="sbm" class="btn btn-success" type="submit">Sửa</button> 
            </form> 
        </div> 
    </div> 
</div>