<?php 
$conn = mysqli_connect('localhost', 'root', '', 'mydata');
if (!$conn) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
}
$id = $_GET['id'];

if (isset($_GET['confirm'])) {
    $sql = "DELETE FROM users WHERE id='" . $id . "'";
    if (mysqli_query($conn, $sql)) {
        header("Location: hienthi.php");
        exit();
    } else {
        echo "Lỗi khi xóa người dùng: " . mysqli_error($conn);
    }
} else {
    // Hiển thị hộp thoại xác nhận
    echo "<script>
        if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
            window.location.href = 'delete_user.php?id=" . $id . "&confirm=1';
        } else {
            window.location.href = 'hienthi.php';
        }
    </script>";
}

mysqli_close($conn);
?>