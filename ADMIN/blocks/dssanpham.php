<div class="top-table">
    <form id="form-container" method="post">
        <button id="themSP" name="submit" type="submit"><a href="?page=themsp">Thêm Sản Phẩm</a></button>
    </form>
    <div id="search-container">
        <input type="text" id="keyword" name="keyword" placeholder="Nhập tên sản phẩm hoặc mô tả...">
        <button onclick="searchProducts()">Tìm kiếm</button>
    </div>

    <div id="filter-container">
        <label for="loai">Lọc theo loại:</label>
        <select id="loai" name="loai">
            <option value="">Tất cả</option>
            <?php
            $result_loai = mysqli_query($conn, "SELECT * FROM loai");
            while ($row_loai = mysqli_fetch_array($result_loai)) {
                echo '<option value="' . $row_loai['maloai'] . '">' . $row_loai['tenloai'] . '</option>';
            }
            ?>
        </select>
        <button onclick="filterProducts()">Lọc</button>
    </div>
</div>
<style>
    * {
        box-sizing: border-box;
    }

    #mota {
        text-align: justify;
    }

    .top-table {
        display: flex;
        justify-content: space-between;
        padding: 5px 60px 10px 20px;
        align-items: center;
    }

    #search-container input[type="text"]{
        width: 350px;
        min-height: 30px;
        padding: 10px 20px;
        outline: none;
        border: none;
        border-bottom: thin solid #222;
        background: none;
    }

    #search-container button{
        height: 36px;
        width: 90px;
        border: thin solid #222;
        border-radius: 16px 0;
        font-size: 14px;
        font-weight: bold;
        margin-left: -4px;
        background: none;
        transition: 0.3s;
    }

    #search-container button:hover{
        background-color: #254753;
        color: #fff;
        transition: 0.3s;
    }

    #filter-container {
        display: flex;
        text-align: center;
        align-items: center;
    }

    #filter-container select {
        margin: 0 4px;
        font-size: 16px;
        width: max-content;
        padding: 2px 10px;
        background: none;
        min-height: 24px;
        outline: none;
    }

    #filter-container button {
        padding: 2px 5px;
        color: #fff;
        background-color: #254753;
        border: thin solid #254753;
        cursor: pointer;
        min-height: 24px;
    }

    #filter-container button:hover {
        color: #254753;
        background-color: #fff;
        border: thin solid #254753;
    }
</style>
<?php
if (isset($_POST['del'])) {
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
    $totalPages = ceil($num / $numberPages);
    echo '<div class="btn-pagination">';
    echo '<span>Trang: </span>';
    for ($btn = 1; $btn <= $totalPages; $btn++) {
        echo '<button class="btn-page"><a href="index.php?page=dssanpham&npage=' . $btn . '">' . $btn . '</a></button>';
    }
    echo '</div>';
    if (isset($_GET['npage'])) {
        $npage = $_GET['npage'];
    } else {
        $npage = 1;
    }

    $startinglimit = ($npage - 1) * $numberPages;
    if (isset($_GET['loai']) && !empty($_GET['loai'])) {
        $selectedLoai = $_GET['loai'];
        $sql = "SELECT * FROM sanpham sp, loai l WHERE sp.loai = l.maloai AND l.maloai = $selectedLoai";
    } else {
        $sql = "SELECT * FROM sanpham sp, loai l WHERE sp.loai = l.maloai";
    }
    
    if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $sql .= " AND (sp.tensanpham LIKE '%$keyword%' OR sp.mota LIKE '%$keyword%')";
    }
    
    $sql .= " LIMIT " . $startinglimit . ',' . $numberPages;
    
    $result = mysqli_query($conn, $sql);

    $i = $startinglimit + 1;
    while ($row = mysqli_fetch_array($result)) {
    ?>

        <tbody>
            <td><?php echo $i ?></td>
            <td><?php echo $row['masanpham'] ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo number_format($row['gia']) ?></td>
            <td>
                <img width="100px" height="100px" src="../ASSETS/img/IMG-Product/<?php echo $row['hinhanh'] ?>">
            </td>
            <td id="mota">
                <?php
                $mota = $row['mota'];
                $lim = 50;
                if (mb_strlen($mota, 'UTF-8') > $lim) {
                    $mota = mb_substr($mota, 0, $lim, 'UTF-8') . '<span id="more' . $i . '" style="display:none;">' . mb_substr($mota, $lim, null, 'UTF-8') . '</span><a href="javascript:void(0);" onclick="toggleDescription(' . $i . ')" id="myBtn' . $i . '">Xem Thêm</a>';
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
    <?php $i++;
    }
    ?>

</table>
<script>
    function filterProducts() {
        var selectedLoai = document.getElementById("loai").value;

        window.location.href = 'index.php?page=dssanpham&loai=' + selectedLoai;
    }

    function searchProducts() {
        var keyword = document.getElementById("keyword").value;

        window.location.href = 'index.php?page=dssanpham&keyword=' + keyword;
    }
</script>