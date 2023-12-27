<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../FUNC/conn.php");
include("func.php");
?>

<link rel="stylesheet" href="../ASSETS/css/ADMIN/login.css">
<link rel="stylesheet" href="../ASSETS/font/fontawesome/css/all.min.css">

<?php
if (isset($_POST["btn-login"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $sql = "select * from taikhoan where tendangnhap = '$user'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_array($result);

        if ($row && password_verify($pass, $row['matkhau'])) {
            $_SESSION['user'] = $row['tendangnhap'];
            $_SESSION['pass'] = $row['matkhau'];
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            $thongBao = 'Sai thông tin tài khoản hoặc mật khẩu!';
        }
    } else {
        $thongBao = 'Lỗi truy vấn: ' . mysqli_error($conn);
    }
}
?>
<div class="container">
    <div class="top-form">
        <img src="../ASSETS/img/IMG-Design/logo.png">
        <h1>quản lý cửa hàng của bạn</h1>
    </div>

    <form action="" method="post">
        
            <?php
            if (isset($thongBao)) {
                echo '<div class="error-message">
                <i class="fa-solid fa-circle-exclamation"></i>
                 '.$thongBao.'
                </div>';
            }
            ?>
        
        <div class="form-group">
            <input class="form-input" type="text" name="user" placeholder="Tài khoản của bạn" required>
        </div>
        <div class="form-group">
            <input class="form-input" type="password" name="pass" placeholder="Mật khẩu đăng nhập cửa hàng" required>
            <a href="javascript:;" onclick="Components.Common.toggleShowPassword(this)" class="input-inline-button">
                <img class="icon-eye-slash" src="https://sapo.dktcdn.net/sso-service/images/eye-slash.svg">
                <img class="icon-eye" src="https://sapo.dktcdn.net/sso-service/images/eye.svg">
            </a>
        </div>
        <div class="center-button">
            <button class="btn-login" name="btn-login" type="submit">Đăng nhập</button>
        </div>
    </form>
</div>

<style>
    .error-message {
        color: #ff0000;
        margin: 10px 0 20px 0;
        border: 1px solid #ff9494;
        height: 48px;
        border-radius: 40px;
    padding: 0 20px;
    outline: none;
    font-weight: 500;
    font-size: 16px;
    display: flex;
    align-items: center;
    background-color: rgba(248, 215, 218, 0.3);
    }
    .error-message .fa-circle-exclamation{
        margin-right: 10px;
    }
</style>