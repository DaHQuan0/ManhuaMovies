<?php 
    $sql = "SELECT episodes.id, episodes.movie_id, episodes.episode_number, episodes.video_link, trailers.title, trailers.video_link
    FROM episodes
    JOIN trailers ON episodes.movie_id = trailers.movie_id";
    $query_movies = mysqli_query($conn, $sql);
    if(isset($_POST['sbm'])){
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $image = $_POST['image'];
        $video_link = $_POST['video_link'];
        $video_link = $_POST['video_link'];
        $genre = $_POST['genre'];
        $status = $_POST['status'];
        $actors = $_POST['actor'];
        $director = $_POST['director'];
        $othertitle = $_POST['othertitle'];

        //Kết nối CSDL
        require_once 'Config/connect.php';

        //Chèn dữ liệu vào CSDL
        $sql_insert = "INSERT INTO movies (title, summary, image, genre, status, actors, director, othertitle) 
        VALUES ('$title', '$summary', '$image', '$genre', '$status', '$actors', '$director', '$othertitle')";
        mysqli_query($conn, $sql_insert);

        header('location: ad_index.php?page_layout=danhsach');  
    }
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h2 class="text-center">Thêm phim</h2>
    </div>
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Tên phim:</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Giới thiệu phim:</label>
          <textarea name="summary" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
          <label for="">Ảnh bìa:</label>
          <input type="text" name="image" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Trailer:</label>
          <input type="text" name="video_link" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Link phim:</label>
          <input type="text" name="video_link" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Thể loại phim:</label>
          <input type="text" name="genre" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Trạng thái:</label>
          <select name="status" class="form-control" required>
            <option value="">--Chọn trạng thái--</option>
            <option value="Đang chiếu">Đang chiếu</option>
            <option value="Sắp chiếu">Sắp chiếu</option>
            <option value="Ngừng chiếu">Ngừng chiếu</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Diễn viên:</label>
          <input type="text" name="actor" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Đạo diễn:</label>
          <input type="text" name="director" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Tên khác:</label>
          <input type="text" name="othertitle" class="form-control" required>
        </div>
        <div class="form-group text-center">
          <button name="sbm" class="btn btn-success" type="submit">Thêm</button>
          <a href="ad_index.php?page_layout=danhsach" class="btn btn-danger">Hủy bỏ</a>
        </div>
      </form>
    </div>
  </div>
</div>