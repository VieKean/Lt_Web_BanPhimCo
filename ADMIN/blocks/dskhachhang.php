<div id="filterDate-container">
    <label for="ngaytao">Ngày tạo:</label>
    <input type="date" id="ngaytao" name="ngaytao">
    <button onclick="filterCustomersByDate()">Lọc</button>
</div>

<style>
    #filterDate-container{
        float: right;
        padding: 0 50px 10px 0;
    }

    #filterDate-container input[type='date']{
        margin: 0 4px;
        height: 24px;
        line-height: 24px;
    }

    #filterDate-container button{
        padding: 2px 5px;
        color: #fff;
        background-color: #254753;
        border: thin solid #254753;
        cursor: pointer;
        min-height: 24px;
    }

    #filterDate-container button:hover{
        color: #254753;
        background-color: #fff;
        border: thin solid #254753;
    }
</style>

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
        if (isset($_GET['ngaytao']) && !empty($_GET['ngaytao'])) {
            $selectedDate = $_GET['ngaytao'];
            $sql = "SELECT * FROM khachhang WHERE DATE(ngaytao) = '$selectedDate' LIMIT " . $startinglimit . ',' . $numberPages;
        } else {
            $sql = "SELECT * FROM khachhang LIMIT " . $startinglimit . ',' . $numberPages;
        }        
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
<script>
    function filterCustomersByDate() {
        var selectedDate = document.getElementById("ngaytao").value;

        // Chuyển hướng đến trang với tham số ngaytao được chọn
        window.location.href = 'index.php?page=dskhachhang&ngaytao=' + selectedDate;
    }
</script>
