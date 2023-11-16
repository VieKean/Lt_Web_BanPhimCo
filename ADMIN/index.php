<?php
require("../FUNC/conn.php");
require("func.php");
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $hello = $_SESSION['user'];
?>

    <title>Trang Quản Trị - ADMIN</title>
    <link rel="stylesheet" href="../ASSETS/font/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">

    <body>
        <div class="container">
            <div class="menu"><?php require("blocks/menu.php") ?></div>
            <div class="content row">
                <div class="toggle">
                    <a class="fa-solid fa-bars"></a>
                </div>
                <?php
                if (isset($_GET["page"])) {
                    $page = "blocks/" . $_GET["page"] . ".php";
                    require("$page");
                }
                ?>
            </div>
        </div>
    </body>
<?php
} else {
    header('location: login.php');
}
?>
<script>
    let toggle = document.querySelector(".toggle");
    let menu = document.querySelector(".menu");
    let content = document.querySelector(".content");

    toggle.onclick = function() {
        menu.classList.toggle("active");
        content.classList.toggle("active");
    };
</script>

<!-- lưu lại trang đang active(đổi màu nó) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các button có class 'btn-page'
    var buttons = document.querySelectorAll('.btn-page');

    // Khôi phục trạng thái active từ sessionStorage 
    var activeButtonIndex = sessionStorage.getItem('activeButtonIndex');
    if (activeButtonIndex !== null) {
        buttons[activeButtonIndex].classList.add('btn-page-active');
    } else {
        // Nếu không có trạng thái active nào được lưu, áp dụng trạng thái active cho button đầu tiên
        buttons[0].classList.add('btn-page-active');
    }

    // Lặp qua từng button và thêm sự kiện click
    buttons.forEach(function (button, index) {
        button.addEventListener('click', function () {
            // Loại bỏ class 'btn-page-active' từ tất cả các button
            buttons.forEach(function (btn) {
                btn.classList.remove('btn-page-active');
            });

            // Thêm class 'btn-page-active' cho button được click
            this.classList.add('btn-page-active');

            // Lưu trạng thái active vào sessionStorage
            sessionStorage.setItem('activeButtonIndex', index);

            // Lấy href từ thẻ a và chuyển hướng trang
            var href = this.querySelector('a').getAttribute('href');
            window.location.href = href;
        });
    });
});
</script>