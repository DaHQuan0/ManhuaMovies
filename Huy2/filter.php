<?php
include 'db_connection.php';

// Lấy danh sách các tham số đã chọn
$selectedGenre = isset($_GET['genre']) ? $_GET['genre'] : '';
$selectedCountry = isset($_GET['country']) ? $_GET['country'] : '';
$selectedYear = isset($_GET['year']) ? $_GET['year'] : '';

// Xây dựng câu truy vấn dựa trên các tham số đã chọn
$sql = "SELECT * FROM movies WHERE 1=1";


if (!empty($selectedGenre)) {
    $selectedGenre = mysqli_real_escape_string($connection, $selectedGenre);
    $sql .= " AND genre = '$selectedGenre'";
}


if (!empty($selectedCountry)) {
    $selectedCountry = mysqli_real_escape_string($connection, $selectedCountry);
    $sql .= " AND country = '$selectedCountry'";
}

if (!empty($selectedYear)) {
    $selectedYear = mysqli_real_escape_string($connection, $selectedYear);
    $sql .= " AND release_year = '$selectedYear'";
}

// Thực hiện truy vấn
$result = $connection->query($sql);

// Hiển thị danh sách phim
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="movie">';
        echo '<a href="movie_detail.php?id=' . $row["id"] . '">';
        echo '<img src="' . $row["image"] . '" alt="' . $row["title"] . '">';
        echo '<h3>' . $row["title"] . '</h3>';
        echo '</a>';
        echo '</div>';
    }
} else {
    echo "Không có phim phù hợp với tiêu chí lọc.";
}

mysqli_close($connection);
?>
