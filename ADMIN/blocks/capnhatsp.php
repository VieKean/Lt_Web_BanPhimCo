<link rel="stylesheet" href="css/capnhatsp.css">
<?php
$id = $_GET['masanpham'];
$sp = laychitietSP($conn, $id);
$row = mysqli_fetch_array($sp);

if (isset($_POST['submit'])) {
    $tensp = $_POST['tensanpham'];
    $gia = $_POST['gia'];
    $mota = $_POST['motasp'];
    $loai = $_POST['loai'];

    $date = getdate();
    $a = $date['mday'] . $date['mon'] . $date['year'] . $date['hours'] . $date['minutes'] . $date['seconds']; //học trò ruột Cô Yến

    $hinhanh = $row['hinhanh'];

    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === 0) {
        $hinhanh_tmp_name = $_FILES['hinhanh']['tmp_name'];
        $hinhanh_name = $a . $_FILES['hinhanh']['name'];
        $hinhanh_extension = pathinfo($hinhanh_name, PATHINFO_EXTENSION);
        $hinhanh = uniqid() . '.' . $img_extension;
        move_uploaded_file($hinhanh_tmp_name, "../ASSETS/img/IMG-Product/" . $hinhanh);
    }
    $sql = "UPDATE sanpham SET tensanpham = '$tensp', gia = $gia, hinhanh= '$hinhanh', mota ='$mota' , loai= $loai where masanpham = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Cập nhật sản phẩm thành công!"); 
            window.location.href = "?page=dssanpham";</script>';
    } else {
        echo '<script>alert("Lỗi: ' . mysqli_error($conn) . '");</script>';
    }
}

?>
<div id="update_product_container">
    <h1>Cập Nhật Sản Phẩm</h1>
    <form enctype="multipart/form-data" method="post">
        <div id="product_image_group" class="form_group">
            <img id="product_image" src="../ASSETS/img/IMG-Product/<?php echo $row['hinhanh'] ?>">
            <input type="file" name="hinhanh" onchange="chooseFile(event)" accept="image/*">
        </div>

        <div class="form_group">
            <label for="tensp">Tên Sản Phẩm: </label>
            <input value="<?php echo $row['tensanpham'] ?>" type="text" id="tensp" name="tensanpham" required>
        </div>

        <div class="form_group">
            <label for="gia">Giá: </label>
            <input value="<?php echo $row['gia'] ?>" type="number" id="gia" name="gia" required>
        </div>

        <div class="form_group">
            <label for="loai">Loại: </label>
            <select name="loai">
                <?php
                $dsloai = layLoai($conn);
                while ($rowloai = mysqli_fetch_array($dsloai)) {
                ?>
                    <option value="<?php echo $rowloai["maloai"] ?>"> <?php echo $rowloai["tenloai"] ?> </option>
                <?php    }
                ?>
            </select>
        </div>

        <div class="form_group">
            <label for="motasp">Mô tả: </label>
            <textarea id="motasp" name="motasp" required><?php echo $row['mota'] ?></textarea>
        </div>

        <input id="submit_button" type="submit" value="Sửa" name="submit">
    </form>
</div>