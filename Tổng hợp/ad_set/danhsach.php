<?php 
    //Kết nối CSDL
    require_once 'Config/connect.php';

    //Lấy danh sách phim từ CSDL
    $query = mysqli_query($conn, "SELECT * FROM films");

    //Kiểm tra nếu có phim trong CSDL
    if(mysqli_num_rows($query) > 0){
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách phim</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên phim</th>
                        <th>Giới thiệu phim</th>
                        <th>Ảnh bìa</th>
                        <th>Video</th>
                        <th>Thể loại</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['film']; ?></td>

                            <td>
                                <img style="width: 100px;" src="img/<?php echo $row['art']; ?>" alt="">
                            </td>

                            <td>
                                <video style="width: 200px;" controls>
                                    <source src="videos/<?php echo $row['video']; ?>" type="video/mp4">
                                </video>
                            </td>

                            <td><?php echo $row['category']; ?></td>
                            <td><a href="ad_index.php?page_layout=sua&id=<?php echo $row['id']; ?>">Sửa</a></td>
                            <td><a onclick="return Del('<?php echo $row['name']; ?>')" href="ad_index.php?page_layout=xoa&id=<?php echo $row['id']; ?>">Xóa</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="ad_index.php?page_layout=them">Thêm mới</a>
        </div>
    </div>
</div>

<script>
    function Del(name){
        return confirm("Bạn có chắc chắn muốn xóa phim " + name + " chứ?");
    }
</script>

<?php 
    } else {
        //Hiển thị thông báo nếu không có phim trong CSDL
        echo "<p>Không có phim trong CSDL</p>";
    }
?>