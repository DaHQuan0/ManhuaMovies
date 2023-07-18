<?php
// Kết nối đến cơ sở dữ liệu
include 'db_connection.php';

// Kiểm tra xem id phim và số tập đã được truyền vào hay chưa
if (isset($_GET['id']) && isset($_GET['episode'])) {
    $id = $_GET['id'];
    $episode = $_GET['episode'];

    // Truy vấn thông tin phim dựa trên id phim
    $sql_movie = "SELECT title FROM movies WHERE id = $id";
    $result_movie = $connection->query($sql_movie);

    // Kiểm tra xem có kết quả trả về hay không
    if ($result_movie->num_rows > 0) {
        $row_movie = $result_movie->fetch_assoc();
        $title = $row_movie['title'];

        // Truy vấn danh sách tập phim dựa trên id phim
        $sql_episodes = "SELECT episode_number, video_link FROM episodes WHERE movie_id = $id";
        $result_episodes = $connection->query($sql_episodes);

        // Kiểm tra xem có kết quả trả về hay không
        if ($result_episodes->num_rows > 0) {
            // Lưu trữ danh sách tập phim
            $episodes = array();

            // Lặp qua kết quả truy vấn và lấy thông tin các tập phim
            while ($row_episodes = $result_episodes->fetch_assoc()) {
                $episodeNumber = $row_episodes['episode_number'];
                $videoLink = $row_episodes['video_link'];
                $episodes[] = array('number' => $episodeNumber, 'link' => $videoLink);
            }

            // Kiểm tra xem số tập phim có hợp lệ hay không
            if (isset($_GET['episode']) && is_numeric($_GET['episode']) && $_GET['episode'] >= 1 && $_GET['episode'] <= count($episodes)) {
                $episode = $_GET['episode'];
            } else {
                $episode = 1; // Mặc định hiển thị tập đầu tiên
            }

            // Hiển thị trang
            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Xem Tập Phim - ' . $title . ' - Tập ' . $episode . '</title>
                <link rel="stylesheet" href="css/style.css">
                <link rel="shortcut icon" href="img/fav-icon.png" type="image/x-icon">
                <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
                <link rel="stylesheet" type="text/css" href="dropdown.css">
                <style>
                /* CSS cho phần khung xem phim */
                .video-container {
                    position: relative;
                    width: 100%;
                    height: 0;
                    padding-bottom: 56.25%; /* Tỷ lệ 16:9 */
                }
                
                .video-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }
                
                .movie-details.container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    align-items: flex-start;
                    margin-top: 60px;
                }
                
                .episode-list {
                    margin-top: 20px;
                    padding: 15px 20px;
                    background-color: #272735;
                    border-radius: 8px;
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                }
                
                .episode-list h3 {
                    font-size: 24px;
                    margin-bottom: 5px;
                    color: #E91A46;
                }
                
                .episode-list ul {
                    padding: 0;
                    display: flex;
                    flex-direction: row;
                    flex-wrap: wrap;
                }
                
                .episode-list li {
                    padding: 10px 15px;
                    border-radius: 10px;
                    margin-right: 10px;
                    background-color: #272735;
                    color: white;
                }
                
                .episode-list li:hover {
                    background-color: #E91A46;
                    color: white;
                    cursor: pointer;
                }
                
                .episode-list li.current-episode {
                    background-color: #E91A46;
                    color: white;
                }
            
                
                .episode-list li a {
                    color: white; /* Màu chữ trắng */
                }
                
                .current-episode {
                    color: white; /* Màu chữ trắng */
                }
                
                .comment-section {
                    margin-top: 20px;
                    padding: 10px;
                    background-color: #272735;
                }
                .current-episode-title {
                    margin-top: 20px;
                    font-weight: bold;
                    font-size: 28px;
                    margin-bottom: 20px;
                }
                </style>
            </head>
            <body>
                <header>
                    <div class="nav container">
                        <a href="TrangChu.html" class="logo">
                            Movie<span>Manhwa</span>
                        </a>
                        <div class="search-box">
                            <form method="post" action="Search.php" style="display: flex;">
                                <input type="text" name="noidung" autocomplete="off" id="search-input" placeholder="Search Movies">
                                <button style="background-color: #2D2E37; border: none;" class="search-button" type="submit" name="btn">
                                    <i class="bx bx-search"></i>
                                </button>
                            </form>
                        </div>
                        <a href="<?php echo isset($_SESSION['user_id']) ? 'UserInfo.php?user_id=' . $_SESSION['user_id'] : 'Dangnhap.php'; ?>" class="user">
                            <img src="<?php echo $user !== null ? $user['avatar_link'] : 'img/images.png'; ?>" alt="" class="user-img">
                        </a>
            <div class="navbar">
                <a href="Trangchu.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link">
                    <i class="bx bx-home nav-link-icon"></i>
                    <span class="nav-link-title">Trang chủ</span>
                </a>
                <a href="#home" class="nav-link">
                    <i class="bx bxs-hot nav-link-icon"></i>
                    <span class="nav-link-title">Thịnh hành</span>
                </a>
                <a href="PhimBo.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link nav-active">
                    <i class="bx bxs-movie nav-link-icon"></i>
                    <span class="nav-link-title">Phim bộ</span>
                </a>
                <a href="PhimLe.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link">
                    <i class="bx bxs-film nav-link-icon"></i>
                    <span class="nav-link-title">Phim lẻ</span>
                </a>
                <div class="dropdown-toggle-container" id="genre-dropdown-toggle">
                    <a href="#" class="nav-link dropdown">
                        <i class="bx bx-category nav-link-icon"></i>
                        <span class="nav-link-title">Thể loại</span>
                    </a>
                    <div class="dropdown-content">
                        <div class="column">
                            <a href="Theloai.php?genre=Hài hước&user_id=<?php echo $_SESSION['user_id']; ?>">Hài hước</a>
                            <a href="Theloai.php?genre=Hành động&user_id=<?php echo $_SESSION['user_id']; ?>">Hành động</a>
                            <a href="Theloai.php?genre=Phiêu lưu&user_id=<?php echo $_SESSION['user_id']; ?>">Phiêu lưu</a>
                            <a href="Theloai.php?genre=Tình cảm&user_id=<?php echo $_SESSION['user_id']; ?>">Tình cảm</a>
                            <a href="Theloai.php?genre=Học đường&user_id=<?php echo $_SESSION['user_id']; ?>">Học đường</a>
                            <a href="Theloai.php?genre=Võ thuật&user_id=<?php echo $_SESSION['user_id']; ?>">Võ thuật</a>
                            <a href="Theloai.php?genre=Tài liệu&user_id=<?php echo $_SESSION['user_id']; ?>">Tài liệu</a>
                        </div>
                        <div class="column">
                            <a href="Theloai.php?genre=Viễn tưởng&user_id=<?php echo $_SESSION['user_id']; ?>">Viễn tưởng</a>
                            <a href="Theloai.php?genre=Hoạt hình&user_id=<?php echo $_SESSION['user_id']; ?>">Hoạt hình</a>
                            <a href="Theloai.php?genre=Thể thao&user_id=<?php echo $_SESSION['user_id']; ?>">Thể thao</a>
                            <a href="Theloai.php?genre=Âm nhạc&user_id=<?php echo $_SESSION['user_id']; ?>">Âm nhạc</a>
                            <a href="Theloai.php?genre=Gia đình&user_id=<?php echo $_SESSION['user_id']; ?>">Gia đình</a>
                            <a href="Theloai.php?genre=Kinh dị&user_id=<?php echo $_SESSION['user_id']; ?>">Kinh dị</a>
                            <a href="Theloai.php?genre=Tâm lý&user_id=<?php echo $_SESSION['user_id']; ?>">Tâm lý</a>
                        </div>
                    </div>
                </div>
                <a href="#home" class="nav-link">
                    <i class="bx bx-heart nav-link-icon"></i>
                    <span class="nav-link-title">Yêu thích</span>
                </a>
            </div>
        </div>
                </header>
                <section class="movie-details container">
                  <div class="container">
                    <div class="current-episode-title">
                        <!-- Hiển thị tên bộ phim và số tập -->
                        <p>Phim ' . $title . ' - Tập ' . $episode . '</p>
                    </div>
                    <div class="video-container">
                        <!-- Khung xem tập phim -->
                        <iframe src="' . $episodes[$episode-1]['link'] . '" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="episode-list">
                        <!-- Danh sách các tập phim -->
                        <h3>Danh sách tập phim</h3>
                        <ul>';

                        echo '<li><a href="XemTrailer.php?id=' . $id . '">Trailer</a></li>';
                        foreach ($episodes as $episodeItem) {
                            $currentClass = ($episodeItem['number'] == $episode) ? 'current-episode' : '';
                            echo '<li class="' . $currentClass . '"><a href="XemTap.php?id=' . $id . '&episode=' . $episodeItem['number'] . '">Tập ' . $episodeItem['number'] . '</a></li>';
                            
                        }
                       

                        echo '
                        </ul>
                    </div>

                    <div class="comment-section">
                        <!-- Khung bình luận -->
                        <h3>Bình luận</h3>
                        <!-- Thêm form bình luận hoặc hiển thị danh sách bình luận -->
                    </div>

                  </div>
                </section>
                <script src="js/main.js"></script>
                <script src="dropdown.js"></script>
            </body>
            </html>';
        } else {
            echo "Không tìm thấy tập phim.";
        }
    } else {
        echo "Không tìm thấy thông tin phim.";
    }
} else {
    echo "Không có đủ thông tin để xem tập phim.";
}

// Đóng kết nối cơ sở dữ liệu
$connection->close();
?>
