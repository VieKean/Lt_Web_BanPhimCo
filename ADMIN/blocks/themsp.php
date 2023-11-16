<div class="add_product">
    <h1>Thêm Sản Phẩm</h1>
    <form enctype="multipart/form-data" method="post">
        <div class="in_img">
            <img id="hinhanh" width="200px" height="150px">
            <input type="file" name="hinhanh" onchange="chooseFile(event)" accept="image/*" required>
        </div><br>
        <div class="in_text">
            <div class="form-gr">
                <label>Tên Sản Phẩm: </label><br>
                <input type="text" id="tensp" name="tensanpham" required>
            </div>

            <div class="form-gr">
                <label>Giá: </label><br>
                <input type="text" id="gia" name="gia" pattern="[0-9]*" title="Vui lòng nhập đúng định dạng TIỀN" required><br>
            </div>

            <div class="form-gr">
                <label>Loại: </label><br>
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
            <div class="form-gr">
                <label>Mô tả: </label><br>
                <textarea id="motasp" name="motasp" required></textarea>
            </div>
        </div>
        <button class="my_button" type="submit" name="submit">Thêm</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $tensanpham = $_POST['tensanpham'];
        $gia = $_POST['gia'];
        $mota = $_POST['motasp'];
        $loai = $_POST['loai'];

        $date = getdate();
        $a = $date['mday'] . $date['mon'] . $date['year'] . $date['hours'] . $date['minutes'] . $date['seconds']; //học trò ruột Cô Yến
        $hinhanh = $a . $_FILES['hinhanh']['name'];
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], "../ASSETS/img/IMG-Product/" . $hinhanh);

        $sql = "INSERT INTO sanpham VALUES (null, '$tensanpham', $gia, '$hinhanh', '$mota', $loai);";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Thêm sản phẩm thành công");</script>';
        } else {
            echo '<script>alert("Lỗi: ' . mysqli_error($conn) . '");</script>';
        }
    }
    ?>
</div>
<!-- Ví dụ sử dụng thư viện Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('select').select2();
    });
</script>


<style>
    .add_product h1 {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-bottom: 15px;
        color: var(--main_color)
    }
    .in_img{
        max-height: 150px;
        display: flex;
        align-items: flex-end;
    }

    input[type="file"]{
        margin-left: 20px;
    }

    .add_product {
        margin: 0 auto;
        width: 600px;
        background: none;
        border: 1px solid #ccc;
        padding: 20px;
        position: relative;
    }

    .add_product>form {
        display: flex;
        flex-direction: column;
        max-width: 500px;
        margin: 0 auto;
    }

    /* lớp của input và select */
    .in_text input,
    select {
        height: 34px;
        width: 100%;
        border: thin rgba(0, 0, 0, 0.4) solid;
        border-radius: 5px;
        outline: none;
        padding-left: 15px;
    }

    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .add_product>form textarea {
        width: 100%;
        min-height: 80px;
        padding: 10px;
        resize: none;
        border: thin solid rgba(0, 0, 0, 0.4);
    }

    .my_button {
        width: 160px;
        height: 50px;
        margin: 20px auto 0;
        background-color: #fff;
        border: thin solid rgba(0, 0, 0, 0.4);
        border-radius: 36px 0px;
        color: #001c44;
        font-size: 18px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.4s;
    }

    .my_button:hover {
        background-color: #254753;
        color: #fff;
        transition: 0.4s;

    }


    .form-gr{
        margin: 16px 0;
    }
    </style>