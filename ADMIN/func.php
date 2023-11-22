<?php
function layKH($conn)
{
    $sql = "select * from khachhang";
    return mysqli_query($conn, $sql);
}

function laySP($conn)
{
    $sql = "select * from sanpham sp, loai l where sp.loai = l.maloai";
    return mysqli_query($conn, $sql);
}

function laychitietSP($conn, $id)
{
    $sql = "select * from sanpham where masanpham = '$id'";
    return mysqli_query($conn, $sql);
}

function layDH($conn)
{
    $sql = "select * from donhang";
    return mysqli_query($conn, $sql);
}

function layCTDH($conn, $madon)
{
    if (isset($_GET['madonhang'])) {
        $madon = $_GET['madonhang'];
        $sql = "select ct.madonhang, sp.tensanpham, ct.soluong from chitietdonhang ct, sanpham sp
            where sp.masanpham = ct.masanpham and ct.madonhang = '$madon'";
    } else {
        $sql = "select ct.madonhang, sp.tensanpham, ct.soluong from chitietdonhang ct, sanpham sp
            where sp.masanpham = ct.masanpham ";
    }
    return mysqli_query($conn, $sql);
}
function layCTDHfull($conn)
{
    $sql = "select ct.madonhang, sp.tensanpham, ct.soluong from chitietdonhang ct, sanpham sp
            where sp.masanpham = ct.masanpham ";
    return mysqli_query($conn, $sql);
}


function layTK($conn)
{
    $sql = "select * from taikhoan";
    return mysqli_query($conn, $sql);
}

function layLoai($conn)
{
    $sql = "select * from loai";
    return mysqli_query($conn, $sql);
}

function layMaloai($conn, $id)
{
    $sql = "select * from loai where maloai = '$id'";
    return mysqli_query($conn, $sql);
}


?>

<!-- text area -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<!-- Thêm hình -->
<script>
    function chooseFile(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("hinhanh");
            preview.src = src;
            preview.style.display = "inline-block";
        }
    }
</script>

<!-- Giảm số ký tự in ra bằng chữ xem thêm, bấm vô mới coi hết đc -->
<script>
    function toggleDescription(id) {
        var moreText = document.getElementById("more" + id);
        var btnText = document.getElementById("myBtn" + id);

        if (moreText.style.display === "none") {
            moreText.style.display = "inline";
            btnText.innerHTML = "Ẩn";
        } else {
            moreText.style.display = "none";
            btnText.innerHTML = "Xem Thêm";
        }
    }
</script>

<!-- ẩn hiện con mắt chỗ input mật khẩu -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        function toggleShowPassword(element) {
            var passwordInput = document.querySelector('input[name="pass"]');
            var isPasswordVisible = passwordInput.type === 'text';

            passwordInput.type = isPasswordVisible ? 'password' : 'text';

            var eyeIcon = element.querySelector('.icon-eye');
            var eyeSlashIcon = element.querySelector('.icon-eye-slash');

            if (isPasswordVisible) {
                eyeIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            } else {
                eyeIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            }
        }

        var toggleLink = document.querySelector('.input-inline-button');
        toggleLink.addEventListener('click', function() {
            toggleShowPassword(this);
        });
    });
</script>

<!-- ràng buộc chỉ được nhập số thôi -->
<script>
    function validateNumber(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }
</script>

