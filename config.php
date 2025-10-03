<?php
$servername = "localhost";
$username   = "root"; 
$password   = "";     
$dbname     = "vietbook"; 

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đặt charset để so khớp tiếng Việt chính xác
$conn->set_charset('utf8mb4');
?>