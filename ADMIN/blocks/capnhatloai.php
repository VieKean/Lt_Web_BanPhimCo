<?php
    $id=$_GET['maloai'];
    $ds=layMaloai($conn,$id);
    $row=mysqli_fetch_array($ds);

    if(isset($_POST['submit'])){
        $tenloai = $_POST['tenloai'];

        $sql="UPDATE loai SET tenloai = '$tenloai' WHERE maloai = $id";
        if(mysqli_query($conn, $sql)){
            header("location: ?page=dsloai");
            exit();
        }
        else{
            echo "Lỗi rồi ní!!!". mysqli_error($conn);
        }
    }
?>
<div class="contain-form">
<h1>Sửa Loại</h1>
<form method="post">
    <label>Tên Loại</label>
    <input type="text" name="tenloai" value="<?php echo $row['tenloai'] ?>">

    <input type="submit" value="Sửa" name="submit">
</form>
</div>
<style>
    .contain-form{
    width: 500px;
    height: 250px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    max-width: 400px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 64px;
    height: 36px;
    display: block;
   margin: 0 auto;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>