<?php 
$conn = mysqli_connect('localhost', 'root', '', 'mydata');

if (!$conn) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
}

$id = $_GET['id'];

if (isset($_POST['ok'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $rp = $_POST['repass'];
    $l = $_POST['level'];

    if (!empty($u) && !empty($l)) {
        if ($p === $rp) {
            if (!empty($p)) {
                $sql = "UPDATE users SET username='$u', password='$p', level='$l' WHERE id='$id'";
            } else {
                $sql = "UPDATE users SET username='$u', level='$l' WHERE id='$id'";
            }

            mysqli_query($conn, $sql);
            header("Location: hienthi.php");
            exit();
        } else {
            echo "Mật khẩu và mật khẩu nhập lại không trùng khớp.";
        }
    }
}

$sql = "SELECT * FROM users WHERE id='$id'";
$query = mysqli_query($conn, $sql);
if ($query) {
    $row = mysqli_fetch_assoc($query);
   
} else {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>

<form action="edit_user.php?id=<?= $id ?>" method="post">
    Level:
    <select name="level">
        <option value="1" <?= ($row['level'] == 1) ? "selected" : "" ?>>Thành viên</option>
        <option value="2" <?= ($row['level'] == 2) ? "selected" : "" ?>>Quản trị viên</option>
    </select><br />

    Username: <input type="text" name="username" size="20" value="<?= $row['username'] ?>" /><br />
    Password: <input type="password" name="password" size="20" /> <br />
    Re-password: <input type="password" name="repass" size="20" /><br />
    <input type="submit" name="ok" value="Edit User" />
</form>