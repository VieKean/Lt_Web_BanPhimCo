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

    <tbody>
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
            $sql = "SELECT ctd.madonhang, kh.hoten, kh.sodienthoai, kh.diachi, sp.tensanpham,ctd.soluong,dh.tonggia,dh.phuongthucthanhtoan,dh.trangthai FROM chitietdonhang ctd, khachhang kh, donhang dh, sanpham sp 
            WHERE ctd.madonhang = dh.madonhang
            AND ctd.masanpham = sp.masanpham
            AND dh.makhachhang = kh.makhachhang AND ctd.madonhang = '$madon' LIMIT $startinglimit, $numberPages";

            $result = mysqli_query($conn, $sql);

            $i = $startinglimit + 1;
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <tr>
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
                </tr>
        <?php
                $i++;
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
                echo '<button class="btn-page"><a href="index.php?page=dschitietdonhang&npage=' . $btn . '">' . $btn . '</a></button>';
            }
            echo '</div>';

            if (isset($_GET['npage'])) {
                $npage = $_GET['npage'];
            } else {
                $npage = 1;
            }

            $startinglimit = ($npage - 1) * $numberPages;
            $sql = "SELECT ctd.madonhang, kh.hoten, kh.sodienthoai, kh.diachi, sp.tensanpham,ctd.soluong,dh.tonggia,dh.phuongthucthanhtoan,dh.trangthai FROM chitietdonhang ctd, khachhang kh, donhang dh, sanpham sp 
            WHERE ctd.madonhang = dh.madonhang
            AND ctd.masanpham = sp.masanpham
            AND dh.makhachhang = kh.makhachhang
            LIMIT $startinglimit, $numberPages";

            $result = mysqli_query($conn, $sql);

            $i = $startinglimit + 1;
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <tr>
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
                </tr>
        <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>
