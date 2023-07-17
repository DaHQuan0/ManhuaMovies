<?php 
    if(isset($_POST['sbm'])){
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $image = $_POST['image'];
        $genre = $_POST['genre'];
        $status = $_POST['status'];
        $actors = $_POST['actor'];
        $director = $_POST['director'];
        $othertitle = $_POST['othertitle'];
        $movie_id = $_POST['movie_id'];
        $episode_number = $_POST['episode_number'];
        $video_link_episode = $_POST['video_link_episode'];
        $video_link_trailer = $_POST['video_link_trailer'];
        $trailer_title = $_POST['trailer_title'];

        //Kết nối CSDL
        include '../Config/connect.php';

        //Chèn dữ liệu vào CSDL
        $sql_movies = "INSERT INTO movies (title, summary, image, genre, status, actors, director, othertitle) 
            VALUES ('$title', '$summary', '$image', '$genre', '$status', '$actors', '$director', '$othertitle')";
        $result_movies = mysqli_query($conn, $sql_movies);
        $movie_id = mysqli_insert_id($conn); // Lấy id của bộ phim vừa được thêm vào

        if ($result_movies && $movie_id) {
            $sql_episodes = "INSERT INTO episodes (movie_id, episode_number, video_link) 
                VALUES ('$movie_id', '$episode_number', '$video_link_episode')";
            mysqli_query($conn, $sql_episodes);

            $sql_trailers = "INSERT INTO trailers (movie_id, title, video_link) 
                VALUES ('$movie_id', '$trailer_title', '$video_link_trailer')";
            mysqli_query($conn, $sql_trailers);

            header('location: ad_index.php?page_layout=danhsach');  
        } else {
            echo "Lỗi: không thể thêm phim mới";
        }
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
          <label for="">Movie_iD:</label>
          <input type="text" name="movie_id" class="form-control" required>
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
        <div class="form-group">
          <label for="">Số tập:</label>
          <input type="text" name="episode_number" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Link tập phim:</label>
          <input type="text" name="video_link_episode" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Link trailer:</label>
          <input type="text" name="video_link_trailer" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Tiêu đề trailer:</label>
          <input type="text" name="trailer_title" class="form-control" required>
        </div>
        <div class="form-group">
          <button type="submit" name="sbm" class="btn btn-success">Thêm</button>
          <a href="ad_index.php?page_layout=danhsach" class="btn btn-danger">Hủy</a>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .card-header {
    background-color: black;
  }
  .text-center {
    color : white!important;
    text-align: center;  
    justify-content: center;
    width: 100%;
    font-weight: bold;
  }
  .card-body {
    max-width: 600px;
    margin: 0 auto;
  }

  .form-group {
    margin-bottom: 20px;  
  }

  label {
    font-weight: bold;
  }

  select,
  textarea,
  input[type="text"] {
    width: 100%;
  }

  .btn-success {
    margin-right: 10px;
  }

  .btn-danger {
    background-color: #dc3545;
    color: black; 
    border: 1px red;
  }
  .btn {
    text-decoration: none;
  }
  
</style>