<?php
    // Kết nối CSDL
    require_once '../Config/connect.php';

    // Lấy id của phim cần sửa từ biến GET
    $id = $_GET['id'];

    // Lấy thông tin chi tiết của phim từ CSDL
    $sql = "SELECT * FROM movies WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $movie = mysqli_fetch_assoc($result);

    // Xử lý khi người dùng nhấn nút "Cập nhật"
    if(isset($_POST['sbm'])){
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $image = $_POST['image'];
        $genre = $_POST['genre'];
        $status = $_POST['status'];
        $actors = $_POST['actor'];
        $director = $_POST['director'];
        $othertitle = $_POST['othertitle'];
        $episode_number = $_POST['episode_number'];
        $video_link_episode = $_POST['video_link_episode'];
        $video_link_trailer = $_POST['video_link_trailer'];
        $trailer_title = $_POST['trailer_title'];

        // Thực hiện truy vấn SQL để cập nhật thông tin phim vào CSDL
        $sql_update = "UPDATE movies SET
            title = '$title',
            summary = '$summary',
            image = '$image',
            genre = '$genre',
            status = '$status',
            actors = '$actors',
            director = '$director',
            othertitle = '$othertitle'
            WHERE id = $id";
        $result_update = mysqli_query($conn, $sql_update);

        // Thực hiện truy vấn SQL để cập nhật thông tin tập phim vào CSDL
        $sql_update_episode = "UPDATE episodes SET
            episode_number = '$episode_number',
            video_link = '$video_link_episode'
            WHERE movie_id = $id";
        mysqli_query($conn, $sql_update_episode);

        // Thực hiện truy vấn SQL để cập nhật thông tin trailer vào CSDL
        $sql_update_trailer = "UPDATE trailers SET
            title = '$trailer_title',
            video_link = '$video_link_trailer'
            WHERE movie_id = $id";
        mysqli_query($conn, $sql_update_trailer);

        // Kiểm tra kết quả truy vấn SQL
        if ($result_update) {
            // Chuyển hướng đến trang danh sách phim
            header('location: ad_index.php?page_layout=danhsach');
        } else {
            // Hiển thị thông báo lỗi nếu cập nhật không thành công
            echo "Lỗi: không thể cập nhật thông tin phim";
        }
    }
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h2 class="text-center">Sửa phim</h2>
    </div>
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Tên phim:</label>
          <input type="text" name="title" class="form-control" required value="<?php echo $movie['title']; ?>">
        </div>
        <div class="form-group">
          <label for="">Giới thiệu phim:</label>
          <textarea name="summary" class="form-control" rows="5" required><?php echo $movie['summary']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="">Ảnh bìa:</label>
          <input type="text" name="image" class="form-control" required value="<?php echo $movie['image']; ?>">
        </div>
        <div class="form-group">
          <label for="">Thể loại phim:</label>
          <input type="text" name="genre" class="form-control" required value="<?php echo $movie['genre']; ?>">
        </div>
        <div class="form-group">
          <label for="">Trạng thái:</label>
          <select name="status" class="form-control" required>
            <option value="">--Chọn trạng thái--</option>
            <option value="Đang chiếu" <?php if($movie['status']=='Đang chiếu') echo 'selected'; ?>>Đang chiếu</option>
            <option value="Sắp chiếu" <?php if($movie['status']=='Sắp chiếu') echo 'selected'; ?>>Sắp chiếu</option>
            <option value="Ngừng chiếu" <?php if($movie['status']=='Ngừng chiếu') echo 'selected'; ?>>Ngừng chiếu</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Movie_iD:</label>
          <input type="text" name="movie_id" class="form-control" required value="<?php echo $movie['id']; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="">Diễn viên:</label>
          <input type="text" name="actor" class="form-control" required value="<?php echo $movie['actors']; ?>">
        </div>
        <div class="form-group">
          <label for="">Đạo diễn:</label>
          <input type="text" name="director" class="form-control" required value="<?php echo $movie['director']; ?>">
        </div>
        <div class="form-group">
          <label for="">Tên khác:</label>
          <input type="text" name="othertitle" class="form-control" required value="<?php echo $movie['othertitle']; ?>">
        </div>
        <div class="form-group">
          <label for="">Số tập:</label>
          <input type="text" name="episode_number" class="form-control" required value="<?php echo $movie['episode_number']; ?>">
        </div>
        <div class="form-group">
          <label for="">Link tập phim:</label>
          <input type="text" name="video_link_episode" class="form-control" required value="<?php echo $movie['video_link_episode']; ?>">
        </div>
        <div class="form-group">
          <label for="">Link trailer:</label>
          <input type="text" name="video_link_trailer" class="form-control" required value="<?php echo $movie['video_link_trailer']; ?>">
        </div>
        <div class="form-group">
          <label for="">Tiêu đề trailer:</label>
          <input type="text" name="trailer_title" class="form-control" required value="<?php echo $movie['trailer_title']; ?>">
        </div>
        <div class="form-group">
          <button type="submit" name="sbm" class="btn btn-success">Cập nhật</button>
          <a href="ad_index.php?page_layout=danhsach" class="btn btn-danger">Hủy</a>
        </div>
      </form>
    </div>
  </div>
</div>