<table class="main-table">
    <thead>
        <td>STT</td>
        <td>Mã Đơn Hàng</td>
        <td>Mã Khách Hàng</td>
        <td>Ngày Đặt Hàng</td>
        <td>Tổng Giá</td>
        <td>Phương Thức Thanh Toán</td>
        <td>Trạng Thái</td>
        <td>Chi Tiết Đơn</td>
    </thead>
    <?php
        $result = layDH($conn);
        $num = mysqli_num_rows($result);
        // số lượng sản phẩm 1 trang
        $numberPages = 10;
        $totalPages = ceil($num/$numberPages);
        echo '<div class="btn-pagination">';
        echo '<span>Trang: </span>';
        for ($btn=1; $btn<=$totalPages; $btn++) { 
            echo '<button class="btn-page"><a href="index.php?page=dsdonhang&npage='.$btn.'">'.$btn.'</a></button>';
        }
        echo '</div>';
        if(isset($_GET['npage'])){
            $npage =$_GET['npage'];
        }else{
            $npage=1;
        }
        
        $startinglimit = ($npage-1)*$numberPages;
        $sql = "select * from donhang limit ".$startinglimit.','.$numberPages;
        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <td><?php echo $i?></td>
        <td><?php echo $row['madonhang'] ?></td>
        <td><?php echo $row['makhachhang'] ?></td>
        <td><?php echo date('d/m/Y', strtotime($row['ngaydathang'])) ?></td>
        <td><?php echo $row['tonggia'] ?></td>
        <td><?php echo $row['phuongthucthanhtoan'] ?></td>
        <td><?php echo $row['trangthai'] ?></td>
        <td><a class="fa-solid fa-list" href="?page=dschitietdonhang&madonhang=<?php echo 
        $row['madonhang'];
        ?>"></a></td>
    </tbody>
    <?php $i++; }
    ?>

</table>

<style>
    a{
        text-decoration: none;
        color: #000;
    }
    a:hover{
        color: #ee6457;
    }
</style>