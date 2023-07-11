<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "manhuamovies";

// Tạo kết nối
    $conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

// Thiết lập bộ ký tự là UTF-8
    mysqli_query($conn, "SET NAMES 'utf8'");

    echo "KNTK.";
?>