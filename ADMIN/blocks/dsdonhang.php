<div id="filterOrder-container">
    <label for="ngaydathang">Ngày đặt hàng:</label>
    <input type="date" id="ngaydathang" name="ngaydathang">

    <label for="trangthai">Trạng thái đơn:</label>
    <select id="trangthai" name="trangthai">
        <option value="">Tất cả</option>
        <option value="Chưa xác nhận">Chưa xác nhận</option>
        <option value="Đã xác nhận">Đã xác nhận</option>
        <option value="Đang giao">Đang giao</option>
    </select>

    <button onclick="filterOrders()">Lọc</button>
</div>

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
    $totalPages = ceil($num / $numberPages);
    echo '<div class="btn-pagination">';
    echo '<span>Trang: </span>';
    for ($btn = 1; $btn <= $totalPages; $btn++) {
        echo '<button class="btn-page"><a href="index.php?page=dsdonhang&npage=' . $btn . '">' . $btn . '</a></button>';
    }
    echo '</div>';
    if (isset($_GET['npage'])) {
        $npage = $_GET['npage'];
    } else {
        $npage = 1;
    }

    $startinglimit = ($npage - 1) * $numberPages;
    $sql = "SELECT * FROM donhang";

    if (isset($_GET['ngaydathang']) && !empty($_GET['ngaydathang'])) {
        $selectedDate = $_GET['ngaydathang'];
        $sql .= " WHERE DATE(ngaydathang) = '$selectedDate'";
    }

    if (isset($_GET['trangthai']) && !empty($_GET['trangthai'])) {
        $selectedStatus = $_GET['trangthai'];
        if (strpos($sql, 'WHERE') !== false) {
            $sql .= " AND trangthai = '$selectedStatus'";
        } else {
            $sql .= " WHERE trangthai = '$selectedStatus'";
        }
    }

    $sql .= " LIMIT " . $startinglimit . ',' . $numberPages;

    $result = mysqli_query($conn, $sql);

    $i = $startinglimit + 1;
    while ($row = mysqli_fetch_array($result)) {
    ?>

        <tbody>
            <td><?php echo $i ?></td>
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
    <?php $i++;
    }
    ?>

</table>

<style>
    a {
        text-decoration: none;
        color: #000;
    }

    a:hover {
        color: #ee6457;
    }

    #filterOrder-container {
    float: right;
    padding: 0 50px 10px 0;
}

#filterOrder-container input[type='date'] {
    margin: 0 4px;
    height: 24px;
    line-height: 24px;
}

#filterOrder-container button {
    padding: 2px 5px;
    color: #fff;
    background-color: #254753;
    border: thin solid #254753;
    cursor: pointer;
    min-height: 24px;
}

#filterOrder-container button:hover {
    color: #254753;
    background-color: #fff;
    border: thin solid #254753;
}

#filterOrder-container select{
    height: 24px;
    width: 120px;
    padding: 0 10px;
}

</style>
<script>
    function filterOrders() {
        var selectedDate = document.getElementById("ngaydathang").value;
        var selectedStatus = document.getElementById("trangthai").value;

        // Chuyển hướng đến trang với tham số ngaydathang và trangthai được chọn
        var url = 'index.php?page=dsdonhang';

        if (selectedDate) {
            url += '&ngaydathang=' + selectedDate;
        }

        if (selectedStatus) {
            url += '&trangthai=' + selectedStatus;
        }

        window.location.href = url;
    }
</script>