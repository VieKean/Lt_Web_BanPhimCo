<form method="post">
    <button name="submit" type="submit"><a href="?page=themloai">Thêm Loại</a></button>
</form>
<table class="main-table">
    <thead>
        <td>STT</td>
        <td>Mã Loại</td>
        <td>Tên Loại</td>
        <td>Cập Nhật</td>
    </thead>
    <?php
        $result = layLoai($conn);

        $num = mysqli_num_rows($result);
        // số lượng sản phẩm 1 trang
        $numberPages =3;
        $totalPages = ceil($num/$numberPages);
        echo '<div class="btn-pagination">';
        echo '<span>Trang: </span>';
        for ($btn=1; $btn<=$totalPages; $btn++) { 
            echo '<button class="btn-page"><a href="index.php?page=dsloai&npage='.$btn.'">'.$btn.'</a></button>';
        }
        echo '</div>';
        if(isset($_GET['npage'])){
            $npage =$_GET['npage'];
        }else{
            $npage=1;
        }
        
        $startinglimit = ($npage-1)*$numberPages;
        $sql = "select * from loai limit ".$startinglimit.','.$numberPages;
        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <td><?php echo $i?></td>
        <td><?php echo $row['maloai'] ?></td>
        <td><?php echo $row['tenloai'] ?></td>
        <td><a href="?page=capnhatloai&maloai=<?php echo $row['maloai']?>" class="fa-solid fa-screwdriver-wrench"></a></td>
    </tbody>
    <?php $i++; }
    ?>

</table>