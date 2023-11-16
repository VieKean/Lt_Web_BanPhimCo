<form method="post">
    <button name="submit" type="submit"><a href="?page=themsp">Thêm Sản Phẩm</a></button>
</form>
<?php 
    if(isset($_POST['del'])){
        $id = $_POST['masanpham'];
        $sql = "DELETE FROM sanpham WHERE masanpham = '$id'";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Xóa sản phẩm thành công");</script>';
        } else {
            echo '<script>alert("Lỗi: ' . mysqli_error($conn) . '");</script>';
        }
        
    }
?>
<table class="main-table">
    <thead>
        <td>STT</td>
        <td>Mã SP</td>
        <td>Tên</td>
        <td>Giá</td>
        <td>Ảnh</td>
        <td>Mô Tả</td>
        <td>Loại</td>
        <td>Chức Năng</td>
        
    </thead>
    <?php
        $result = laySP($conn);
        $num = mysqli_num_rows($result);
        // số lượng sản phẩm 1 trang
        $numberPages = 4;
        $totalPages = ceil($num/$numberPages);
        echo '<div class="btn-pagination">';
        echo '<span>Trang: </span>';
        for ($btn=1; $btn<=$totalPages; $btn++) { 
            echo '<button class="btn-page"><a href="index.php?page=dssanpham&npage='.$btn.'">'.$btn.'</a></button>';
        }
        echo '</div>';
        if(isset($_GET['npage'])){
            $npage =$_GET['npage'];
        }else{
            $npage=1;
        }
        
        $startinglimit = ($npage-1)*$numberPages;
        $sql = "select * from sanpham sp, loai l where sp.loai = l.maloai limit ".$startinglimit.','.$numberPages;
        $result = mysqli_query($conn, $sql);

        $i = $startinglimit + 1;
        while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <td><?php echo $i?></td>
        <td><?php echo $row['masanpham'] ?></td>
        <td><?php echo $row['tensanpham'] ?></td>
        <td><?php echo number_format($row['gia']) ?></td>
        <td>
            <img width="100px" height="100px" src="../ASSETS/img/IMG-Product/<?php echo $row['hinhanh']?>">
        </td>
        <td id="mota">
        <?php 
            $mota = $row['mota'];
            $lim = 50;
            if (mb_strlen($mota, 'UTF-8') > $lim) {
                $mota = mb_substr($mota, 0, $lim, 'UTF-8') . '<span id="more'.$i.'" style="display:none;">'.mb_substr($mota, $lim, null, 'UTF-8').'</span><a href="javascript:void(0);" onclick="toggleDescription('.$i.')" id="myBtn'.$i.'">Xem Thêm</a>';
            }
            echo $mota;
        ?>
    </td>
        <td><?php echo $row['tenloai'] ?></td>
        <td class="my_button">
        <a href="?page=capnhatsp&masanpham=<?php echo $row['masanpham'] ?>" class="fa-solid fa-screwdriver-wrench"></a>
            <form method="post">
                <input type="hidden" name="masanpham" value="<?php echo $row['masanpham'] ?>">
                <button type="submit" name="del"><i class="fa-solid fa-trash-can"></i></button>
            </form>
        </td>
        
    </tbody>
    <?php $i++; }
    ?>

</table>

<style>
    #mota{
        text-align: justify;
    }
</style>