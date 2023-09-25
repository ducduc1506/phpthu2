
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách dữ liệu</title>
</head>

<?php
session_start();
// Thiết lập kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'mydata');

// Kiểm tra kết nối
if (!$conn) {
    die("Không thể kết nối: " . mysqli_connect_error());
}

if (isset($_SESSION['userid']) && $_SESSION['level'] == 2) {
    // Hiển thị thông báo khi người dùng có level đăng nhập
}
elseif(isset($_SESSION['userid']) && $_SESSION['level'] == 1) {
    // Level = 1 sẽ đưa về trang thành viên
    header('Location: user.php');

} else {
    // Nếu chưa đăng nhập mà vẫn truy cập thẳng vào trang hiển thị sẽ đưa về trang đăng nhập
    header('Location: login.php');
    exit();
}

// Truy vấn để lấy dữ liệu từ bảng
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Kiểm tra và hiển thị dữ liệu
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>LEVEL</th>
            <th>SỬA</th>
            <th>XÓA</th>
        </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['level'] . "</td>";   
        echo "<td><a href='edit_user.php?id=" . $row['id'] . "'>Sửa</a></td>";
        echo "<td><a href='delete_user.php?id=" . $row['id'] . "'>Xóa</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu.";
}

// Đóng kết nối
mysqli_close($conn);
?>


    <div>
        <a href="add_user.php">Thêm thành viên</a>
    </div>
</body>
</html>