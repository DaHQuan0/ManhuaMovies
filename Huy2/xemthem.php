<?php
include 'db_connection.php';

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $query = "SELECT * FROM movies WHERE genre LIKE '%$type%'";
    $result = mysqli_query($connection, $query);

    echo "<h2>Toàn bộ $type</h2>";
    echo "<div class='movie-list'>";
    $counter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($counter % 3 == 0 && $counter != 0) {
            echo "</div><div class='movie-row'>";
        }
        echo "<div class='movie-item'>";
        echo "<a href='movie_detail.php?id=" . $row['id'] . "'>";
        echo "<img class='movie-image' src='" . $row['image'] . "'>";
        echo "<div class='movie-title'>" . $row['title'] . "</div>";
        echo "</a>";
        echo "</div>";
        $counter++;
    }
    echo "</div>";

    mysqli_close($connection);
} else {
    echo "Loại phim không hợp lệ.";
}
?>
