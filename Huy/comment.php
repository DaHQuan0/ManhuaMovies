<style>
    .comment-container {
        margin-bottom: 20px;
        width: 100%;
    }
    .commenth2 {
        font-size: 30px;;
        margin-bottom: 15px;
        color: #E91A46;
    }
    .comment-container form {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .comment-container textarea {
        width: 100%;
        height: 80px;
        margin-bottom: 10px;
        padding: 8px;
        resize: vertical;
        border-radius: 10px;
    }
    .comment-container button {
        padding: 8px 20px;
        background-color: var(--main-color);
        color: var(--text-color);
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .comment-list {
        margin-bottom: 20px;
        width: 100%;
        margin-top: 40px;
    }
    .comment-list h2 {
        font-size: 30px;;
        margin-bottom: 25px;
        color: #E91A46;
    }
    .comment {
        margin-bottom: 10px;
        padding: 10px;
        background-color: var(--container-color);
        border-radius: 10px;
        padding-top:15px;
    }
    .comment p:first-child {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .pagination {
        margin-top: 20px;
    }
    .pagination a {
        display: inline-block;
        padding: 4px 8px;
        background-color: var(--container-color);
        color: var(--text-color);
        border-radius: 4px;
        margin-right: 5px;
        text-decoration: none;
    }
    .pagination a.current {
        background-color: var(--main-color);
        color: var(--text-color);
    }
    .pagination a.active {
        background-color: red;
    }
</style>

<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';

// Kiểm tra xem id phim đã được truyền vào hay chưa
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn danh sách bình luận dựa trên id phim
    $commentsSql = "SELECT * FROM comments WHERE movie_id = $id";

    // Kiểm tra tùy chọn sắp xếp
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

    if ($sort == 'newest') {
        $commentsSql .= " ORDER BY created_at DESC";
    } elseif ($sort == 'oldest') {
        $commentsSql .= " ORDER BY created_at ASC";
    }

    // Truy vấn danh sách bình luận
    $commentsResult = $connection->query($commentsSql);

    if ($commentsResult) {
        // Lấy tổng số bình luận
        $totalComments = $commentsResult->num_rows;

        // Số bình luận hiển thị trên mỗi trang
        $commentsPerPage = 5;

        // Tính số trang bình luận
        $totalPages = ceil($totalComments / $commentsPerPage);

        // Xác định trang hiện tại
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Xác định giới hạn bắt đầu và kết thúc của các bình luận trên trang hiện tại
        $limitStart = ($currentPage - 1) * $commentsPerPage;
        $limitEnd = $limitStart + $commentsPerPage;

        // Truy vấn danh sách bình luận với giới hạn trang hiện tại
        $commentsSql .= " LIMIT $limitStart, $commentsPerPage";
        $commentsResult = $connection->query($commentsSql);

        // Hiển thị khung bình luận và danh sách bình luận trong cùng một div
        ?>
        <h2 class ="commenth2">Bình luận</h2>
        <div class="comment-container">
            <div class="comment">
    <form method="post" action="nhapcmt.php">
        <input type="hidden" name="movie_id" value="<?php echo $id; ?>">
        <textarea name="comment" placeholder="Nhập bình luận của bạn"></textarea>
        <button type="submit">Gửi</button>
    </form>
</div>


            <div class="comment-list">
                <h2>Danh sách bình luận</h2>
                <!-- Hiển thị danh sách bình luận từ cơ sở dữ liệu -->
                <?php
                if ($commentsResult->num_rows > 0) {
                    while ($comment = $commentsResult->fetch_assoc()) {
                        echo "<div class='comment'>";
                        echo "<p><strong>" . $comment['created_at'] . "</strong></p>";
                        echo "<p>" . $comment['comment'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "Chưa có bình luận nào.";
                }
                ?>
            </div>
        </div>

        <?php
        // Hiển thị phân trang nếu có nhiều hơn 1 trang
        if ($totalPages > 1) {
            echo "<div class='pagination'>";
            echo "<a href='chitietphim.php?id=$id&page=1&sort=newest' class='" . ($sort == 'newest' ? 'active' : '') . "'>Newest</a>";
            echo "<a href='chitietphim.php?id=$id&page=1&sort=oldest' class='" . ($sort == 'oldest' ? 'active' : '') . "'>Oldest</a>";
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i == $currentPage) ? "current" : "";
                echo "<a href='chitietphim.php?id=$id&page=$i&sort=$sort' class='$activeClass'>$i</a>";
            }
            echo "</div>";
        }
        ?>
    <?php
    } else {
        echo "Đã xảy ra lỗi khi truy vấn cơ sở dữ liệu.";
    }
} else {
    echo "Không có id phim được truyền vào.";
}

// Đóng kết nối cơ sở dữ liệu
?>
