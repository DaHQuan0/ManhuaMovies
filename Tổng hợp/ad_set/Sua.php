<?php 
    //Kết nối CSDL
    require_once 'Config/connect.php';

    //Kiểm tra nếu có id được truyền qua URL
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        //Truy vấn CSDL để lấy thông tin phim
        $query = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id");

        //Hiển thị thông tin phim trong form
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
?>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2>Sửa phim</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="edit_movie_process.php">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <label for="title">Tên phim:</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="summary">Giới thiệu phim:</label>
                                <textarea class="form-control" id="summary" name="summary"><?php echo $row['summary']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh bìa:</label>
                                <input type="text" class="form-control" id="image" name="image" value="<?php echo $row['image']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="video_link">Video:</label>
                                <input type="text" class="form-control" id="video_link" name="video_link" value="<?php echo $row['video_link']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="genre">Thể loại:</label>
                                <input type="text" class="form-control" id="genre" name="genre" value="<?php echo $row['genre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <input type="text" class="form-control" id="status" name="status" value="<?php echo $row['status']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="actors">Actors:</label>
                                <input type="text" class="form-control" id="actors" name="actors" value="<?php echo $row['actors']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="director">Director:</label>
                                <input type="text" class="form-control" id="director" name="director" value="<?php echo $row['director']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="othertitle">Othertitle:</label>
                                <input type="text" class="form-control" id="othertitle" name="othertitle" value="<?php echo $row['othertitle']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
<?php 
        } else {
            //Hiển thị thông báo nếu không tìm thấy phim
            echo "<p>Không tìm thấy phim</p>";
        }
    } else {
        //Hiển thị thông báo nếu không có id được truyền qua URL
        echo "<p>Không có id phim được truyền qua URL</p>";
    }
?>
