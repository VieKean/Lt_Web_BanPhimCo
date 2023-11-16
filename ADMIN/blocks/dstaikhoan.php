<link rel="stylesheet" href="css/captaikhoan.css">

<div>
    <a id="captk" href="?page=captaikhoan">Cấp Tài Khoản</a>
</div>
<table class="main-table">
    <thead>
        <td>STT</td>
        <td class="matk">Mã TK</td>
        <td class="tendangnhap">Tài Khoản</td>
        <td class="hoten">Họ Tên</td>
        <td class="diachi">Địa Chỉ</td>
        <td class="sdt">SĐT</td>
        <td class="email">Email</td>
        <td class="quyen">Quyền</td>
        <td class="ngaytao">Ngày Tạo</td>
    </thead>
    <?php
    $result = layTK($conn);

    $num = mysqli_num_rows($result);
    // số lượng sản phẩm 1 trang
    $numberPages = 10;
    
    $totalPages = ceil($num / $numberPages);
    echo '<div class="btn-pagination">';
    echo '<span>Trang: </span>';
    for ($btn = 1; $btn <= $totalPages; $btn++) {
        echo '<button class="btn-page"><a href="index.php?page=dstaikhoan&npage=' . $btn . '">' . $btn . '</a></button>';
    }
    echo '</div>';
    if (isset($_GET['npage'])) {
        $npage = $_GET['npage'];
    } else {
        $npage = 1;
    }

    $startinglimit = ($npage - 1) * $numberPages;
    $sql = "select * from taikhoan limit " . $startinglimit . ',' . $numberPages;
    $result = mysqli_query($conn, $sql);

    $i = $startinglimit + 1;
    while ($row = mysqli_fetch_array($result)) {
    ?>

        <tbody>
            <td><?php echo $i ?></td>
            <td class="matk"><?php echo $row['mataikhoan'] ?></td>
            <td class="tendangnhap"><?php echo $row['tendangnhap'] ?></td>
            <td class="hoten"><?php echo $row['hoten'] ?></td>
            <td class="diachi"><?php echo $row['diachi'] ?></td>
            <td class="sdt"><?php echo $row['sodienthoai'] ?></td>
            <td class="email"><?php echo $row['email'] ?></td>
            <td class="quyen"><?php echo $row['quyen'] ?></td>
            <td class="ngaytao"><?php echo date('d/m/Y', strtotime($row['ngaytao'])) ?></td>
        </tbody>
    <?php $i++;
    }
    ?>
</table>
