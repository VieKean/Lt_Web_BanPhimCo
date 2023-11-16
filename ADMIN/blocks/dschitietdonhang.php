<table class="main-table">
    <thead>
        <td>STT</td>
        <td>Mã Đơn Hàng</td>
        <td>Tên Sản Phẩm</td>
        <td>Số Lượng</td>
    </thead>
    
    <?php
    // Kiểm tra xem có tham số madonhang trong URL không
    if(isset($_GET['madonhang'])){
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
        $sql = "select ct.madonhang, sp.tensanpham, ct.soluong FROM chitietdonhang ct, sanpham sp
        WHERE sp.masanpham = ct.masanpham AND ct.madonhang = '$madon' LIMIT $startinglimit, $numberPages";

        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
    ?>

        <tbody>
            <td><?php echo $i ?></td>
            <td><?php echo $row['madonhang'] ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo $row['soluong'] ?></td>
        </tbody>
    <?php $i++;
        }
    } else {
        $result = layCTDH($conn, $madon=null);
        
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
        $sql = "select ct.madonhang, sp.tensanpham, ct.soluong FROM chitietdonhang ct, sanpham sp
        WHERE sp.masanpham = ct.masanpham LIMIT $startinglimit, $numberPages";

        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
    ?>

        <tbody>
            <td><?php echo $i ?></td>
            <td><?php echo $row['madonhang'] ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo $row['soluong'] ?></td>
        </tbody>
    <?php $i++;
        }
    }
    ?>
</table>