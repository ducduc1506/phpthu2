<?php
session_start();

if(isset($_SESSION['userid']) && $_SESSION['level'] == 2) {
    if(isset($_POST['adduser'])) {
        $u = $p = "";

        if(empty($_POST['username'])) {
            echo "Vui lòng nhập tên người dùng<br />";
        } else {
            $u = $_POST['username'];
        }

        if($_POST['password'] != $_POST['re-password']) {
            echo "Mật khẩu và xác nhận mật khẩu không khớp<br />";
        } else {
            if(empty($_POST['password'])) {
                echo "Vui lòng nhập mật khẩu<br />";
            } else {
                $p = $_POST['password'];
            }
        }

        $l = $_POST['level'];

        if($u && $p && $l) {
            $conn = mysqli_connect("localhost", "root", "", "mydata") or die("Không thể kết nối đến cơ sở dữ liệu");
            $sql = "SELECT * FROM users WHERE username='$u'";
            $query = mysqli_query($conn, $sql);

            if(mysqli_num_rows($query) != 0) {
                echo "Tên người dùng đã tồn tại<br />";
            } else {
                $sql2 = "INSERT INTO users (username, password, level) VALUES ('$u', '$p', '$l')";
                $query2 = mysqli_query($conn, $sql2);
                
                if($query2) {
                    echo "Thêm người dùng mới thành công";
                    header("Location: hienthi.php");
                    exit();
                } else {
                    echo "Lỗi truy vấn: " . mysqli_error($conn);
                }
            }
        }
    }
} else {
    header("location: hienthi.php");
    exit();
}
?>

<form action="add_user.php" method="POST">
    Level: <select name="level">
        <option value="1">Thành viên</option>
        <option value="2">Quản trị viên</option>
    </select><br />

    Username: <input type="text" name="username" size="25" /><br />
    Password: <input type="password" name="password" size="25" /><br />
    Re-Password: <input type="password" name="re-password" size="25" /><br />

    <input type="submit" name="adduser" value="Thêm người dùng mới" />
</form>