<?php 
$conn = mysqli_connect('localhost', 'root', '', 'mydata');

if (!$conn) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
}

echo "Đây là trang của thành viên";
?>