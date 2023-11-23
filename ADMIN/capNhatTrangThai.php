<?php
include ('../FUNC/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $madonhang = $_POST["madonhang"];
    $trangthai = $_POST["trangthai"];

    $updateQuery = "UPDATE donhang SET trangthai = '$trangthai' WHERE madonhang = '$madonhang'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo '<script>alert("Trạng thái đơn hàng đã được cập nhật thành công.");</script>';
        echo '<script>window.location.href = "http://localhost/webthuchanh/ADMIN/?page=dsdonhang";</script>';
    } else {
        echo "Có lỗi xảy ra khi cập nhật trạng thái đơn hàng: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
