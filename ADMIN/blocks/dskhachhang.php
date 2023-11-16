<table class="main-table">
    <thead>
        <td>STT</td>
        <td>Mã Khách Hàng</td>
        <td>Tên Đăng Nhập</td>
        <td>Họ Tên</td>
        <td>Địa Chỉ</td>
        <td>Số Điện Thoại</td>
        <td>Email</td>
        <td>Ngày Tạo</td>
    </thead>
    <?php
        $result = layKH($conn);

        $num = mysqli_num_rows($result);
        // số lượng sản phẩm 1 trang
        $numberPages = 10;
        $totalPages = ceil($num/$numberPages);
        echo '<div class="btn-pagination">';
        echo '<span>Trang: </span>';
        for ($btn=1; $btn<=$totalPages; $btn++) { 
            echo '<button class="btn-page"><a href="index.php?page=dskhachhang&npage='.$btn.'">'.$btn.'</a></button>';
        }
        echo '</div>';
        if(isset($_GET['npage'])){
            $npage =$_GET['npage'];
        }else{
            $npage=1;
        }
        
        $startinglimit = ($npage-1)*$numberPages;
        $sql = "select * from khachhang limit ".$startinglimit.','.$numberPages;
        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <td><?php echo $i?></td>
        <td><?php echo $row['makhachhang'] ?></td>
        <td><?php echo $row['tendangnhap'] ?></td>
        <td><?php echo $row['hoten'] ?></td>
        <td><?php echo $row['diachi'] ?></td>
        <td><?php echo $row['sodienthoai'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo date('d/m/Y', strtotime($row['ngaytao'])) ?></td>
    </tbody>
    <?php $i++; }
    ?>

</table>