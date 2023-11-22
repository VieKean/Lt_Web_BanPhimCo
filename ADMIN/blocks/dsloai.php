<form method="post">
    <button name="submit" type="submit" id="themLoai"><a href="?page=themloai">Thêm Loại</a></button>
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
    $numberPages = 6;
    $totalPages = ceil($num / $numberPages);
    echo '<div class="btn-pagination">';
    echo '<span>Trang: </span>';
    for ($btn = 1; $btn <= $totalPages; $btn++) {
        echo '<button class="btn-page"><a href="index.php?page=dsloai&npage=' . $btn . '">' . $btn . '</a></button>';
    }
    echo '</div>';
    if (isset($_GET['npage'])) {
        $npage = $_GET['npage'];
    } else {
        $npage = 1;
    }

    $startinglimit = ($npage - 1) * $numberPages;
    $sql = "select * from loai limit " . $startinglimit . ',' . $numberPages;
    $result = mysqli_query($conn, $sql);

    $i = $startinglimit + 1;
    while ($row = mysqli_fetch_array($result)) {
    ?>

        <tbody>
            <td><?php echo $i ?></td>
            <td><?php echo $row['maloai'] ?></td>
            <td><?php echo $row['tenloai'] ?></td>
            <td><a href="?page=capnhatloai&maloai=<?php echo $row['maloai'] ?>" class="fa-solid fa-screwdriver-wrench"></a></td>
        </tbody>
    <?php $i++;
    }
    ?>

</table>

<style>
    #themLoai {
        height: 50px;
        width: 140px;
        background-color: var(--main_color);
        border: none;
        border-radius: 30px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s;
    }

    #themLoai a {
        text-decoration: none;
        color: white;
        font-size: 15px;
        transition: 0.3s;
    }

    #themLoai:hover {
        background-color: #fff;
        border: 1px solid var(--main_color);
        transition: 0.3s;
    }

    #themLoai:hover a {
        color: var(--main_color);
        transition: 0.3s;
    }
</style>