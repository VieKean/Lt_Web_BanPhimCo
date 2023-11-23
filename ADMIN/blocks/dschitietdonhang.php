<table class="main-table">
    <thead>
        <td>STT</td>
        <td>Mã Đơn Hàng</td>
        <td>Họ Tên</td>
        <td>Số Điện Thoại</td>
        <td>Địa Chỉ</td>
        <td>Tên Sản Phẩm</td>
        <td>Số Lượng</td>
        <td>Tổng Giá</td>
        <td>Phương Thức Thanh Toán</td>
        <td>Trạng Thái Đơn</td>
    </thead>

    <?php
    // Kiểm tra xem có tham số madonhang trong URL không
    if (isset($_GET['madonhang'])) {
        $madon = $_GET['madonhang'];
        $result = layCTDH($conn, $madon);

        // số lượng sản phẩm 1 trang
        $numberPages = 10;
        $num = mysqli_num_rows($result);
        $totalPages = ceil($num / $numberPages);

        echo '<div class="btn-pagination">';
        echo '<span>Trang: </span>';
        for ($btn = 1; $btn <= $totalPages; $btn++) {
            echo '<button class="btn-page"><a href="index.php?page=dschitietdonhang&madonhang=' . $madon . '&npage=' . $btn . '">' . $btn . '</a></button>';
        }
        echo '</div>';

        if (isset($_GET['npage'])) {
            $npage = $_GET['npage'];
        } else {
            $npage = 1;
        }

        $startinglimit = ($npage - 1) * $numberPages;
        $sql = "sELECT ctd.madonhang, kh.hoten, kh.sodienthoai, kh.diachi, sp.tensanpham,ctd.soluong,dh.tonggia,dh.phuongthucthanhtoan,dh.trangthai FROM chitietdonhang ctd, khachhang kh, donhang dh, sanpham sp 
        WHERE ctd.madonhang = dh.madonhang
        AND ctd.masanpham = sp.masanpham
        AND dh.makhachhang = kh.makhachhang AND ctd.madonhang = '$madon' LIMIT $startinglimit, $numberPages";

        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
    ?>

            <tbody>
                <td><?php echo $i ?></td>
                <td><?php echo $row['madonhang'] ?></td>
                <td><?php echo $row['hoten'] ?></td>
                <td><?php echo $row['sodienthoai'] ?></td>
                <td><?php echo $row['diachi'] ?></td>
                <td><?php echo $row['tensanpham'] ?></td>
                <td><?php echo $row['soluong'] ?></td>
                <td><?php echo $row['tonggia'] ?></td>
                <td><?php echo $row['phuongthucthanhtoan'] ?></td>
                <td>
                    <form method="post" action="capNhatTrangThai.php" id="statusForm">
                        <select name="trangthai" id="trangthaiSelect">
                            <option value="Chờ xác nhận" <?php echo ($row['trangthai'] == 'Chờ xác nhận') ? 'selected' : ''; ?>>Chờ xác nhận</option>
                            <option value="Đã xác nhận" <?php echo ($row['trangthai'] == 'Đã xác nhận') ? 'selected' : ''; ?>>Đã xác nhận</option>
                            <option value="Đang giao hàng" <?php echo ($row['trangthai'] == 'Đang giao hàng') ? 'selected' : ''; ?>>Đang giao hàng</option>
                            <option value="Đã giao hàng" <?php echo ($row['trangthai'] == 'Đã giao hàng') ? 'selected' : ''; ?>>Đã giao hàng</option>
                        </select>
                        <input type="hidden" name="madonhang" value="<?php echo $row['madonhang']; ?>" id="madonhangInput">
                        <button type="submit" id="submitButton">Sửa</button>
                    </form>

                </td>
            </tbody>
        <?php $i++;
        }
    } else {
        $result = layCTDH($conn, $madon = null);

        // số lượng sản phẩm 1 trang
        $numberPages = 10;
        $num = mysqli_num_rows($result);
        $totalPages = ceil($num / $numberPages);

        echo '<div class="btn-pagination">';
        echo '<span>Trang: </span>';
        for ($btn = 1; $btn <= $totalPages; $btn++) {
            echo '<button class="btn-page"><a href="index.php?page=dschitietdonhang&madonhang=' . $madon . '&npage=' . $btn . '">' . $btn . '</a></button>';
        }
        echo '</div>';

        if (isset($_GET['npage'])) {
            $npage = $_GET['npage'];
        } else {
            $npage = 1;
        }

        $startinglimit = ($npage - 1) * $numberPages;
        $sql = "sELECT ctd.madonhang, kh.hoten, kh.sodienthoai, kh.diachi, sp.tensanpham,ctd.soluong,dh.tonggia,dh.phuongthucthanhtoan,dh.trangthai FROM chitietdonhang ctd, khachhang kh, donhang dh, sanpham sp 
        WHERE ctd.madonhang = dh.madonhang
        AND ctd.masanpham = sp.masanpham
        AND dh.makhachhang = kh.makhachhang LIMIT $startinglimit, $numberPages";

        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
        ?>

            <tbody>
                <td><?php echo $i ?></td>
                <td><?php echo $row['madonhang'] ?></td>
                <td><?php echo $row['hoten'] ?></td>
                <td><?php echo $row['sodienthoai'] ?></td>
                <td><?php echo $row['diachi'] ?></td>
                <td><?php echo $row['tensanpham'] ?></td>
                <td><?php echo $row['soluong'] ?></td>
                <td><?php echo $row['tonggia'] ?></td>
                <td><?php echo $row['phuongthucthanhtoan'] ?></td>
                <td><?php echo $row['trangthai'] ?></td>
            </tbody>
    <?php $i++;
        }
    }
    ?>
</table>

<style>
#trangthaiSelect {
    width: 150px; 
    min-height: 32px;
    padding: 0px 10px; 
    outline: none;
}


#submitButton {
    background-color: #254753;
    color: white;
    min-height: 32px;
    padding: 0 16px;
    border: none; 
    border-radius: 5px; 
    cursor: pointer; 
}

#submitButton:hover {
    background-color: #667E86;
}

</style>