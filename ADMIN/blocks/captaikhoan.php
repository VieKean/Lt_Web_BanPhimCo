<link rel="stylesheet" href="css/captaikhoan.css">

<form method="post" id="account-form">
    <fieldset id="account-info">
        <legend>Cấp Tài Khoản</legend>
        <div class="form-group">
            <label for="tendangnhap">Tên Đăng Nhập:</label>
            <input type="text" name="tendangnhap" id="tendangnhap" pattern="[A-Za-z0-9]+" maxlength="16" title="Tên đăng nhập không được vượt quá 16 ký tự và chỉ bao gồm chữ cái và số" required>

        </div>
        <div class="form-group">
            <label for="matkhau">Mật Khẩu:</label>
            <input type="password" name="matkhau" id="matkhau" required>
        </div>
        <div class="form-group">
            <label for="hoten">Họ Tên:</label>
            <input type="text" name="hoten" id="hoten" pattern="[A-Za-zÀ-ỹ ]+" title="Họ tên chỉ bao gồm chữ cái" required>

        </div>
        <div class="form-group">
            <label for="diachi">Địa chỉ:</label>
            <input type="text" name="diachi" id="diachi" required>
        </div>
        <div class="form-group">
            <label for="sodienthoai">Số Điện Thoại:</label>
            <input type="tel" name="sodienthoai" id="sodienthoai" pattern="0[0-9]{9}" title="Vui lòng nhập số điện thoại gồm 10 chữ số" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="quyen">Vai trò: </label>
            <select name="quyen" id="quyen">
                <option value="0" selected>Nhân Viên</option>
                <option value="1">Quản Lý</option>
            </select>
        </div>
        <input type="hidden" name="ngaytao" id="ngaytao">
    </fieldset>
    <div id="container-capTK">
        <input id="btn-capTK" type="submit" name="submit" value="Tạo">
    </div>
</form>


<?php
if (isset($_POST['submit'])) {
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau = password_hash($_POST['matkhau'], PASSWORD_DEFAULT);
    $hoten = $_POST['hoten'];
    $diachi = $_POST['diachi'];
    $sodienthoai = $_POST['sodienthoai'];
    $email = $_POST['email'];
    $quyen = $_POST['quyen'];
    $ngaytao = date('Y-m-d');


    $sql = "SELECT * FROM taikhoan WHERE tendangnhap = '$tendangnhap'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Tên đăng nhập đã được sử dụng. Vui lòng chọn một tên đăng nhập khác.";
    } else {
        // Tên đăng nhập chưa tồn tại, thêm tài khoản mới
        $insert_sql = "INSERT INTO taikhoan (tendangnhap, matkhau, hoten, diachi, sodienthoai, email, quyen, ngaytao) 
        VALUES ('$tendangnhap', '$matkhau', '$hoten', '$diachi', '$sodienthoai', '$email', $quyen, '$ngaytao')";

        if (mysqli_query($conn, $insert_sql)) {
            echo '<script>alert("Tạo tài khoản thành công!"); 
        window.location.href = "?page=dstaikhoan";</script>';
        } else {
            echo '<script>alert("Lỗi: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
?>