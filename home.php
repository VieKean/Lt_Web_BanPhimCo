<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BÁO GEAR</title>
    <link rel="stylesheet" type="text/css" href="./ASSETS/css/base.css">
    <link rel="stylesheet" type="text/css" href="./ASSETS/css/reset.css">
    <link rel="stylesheet" type="text/css" href="./ASSETS/css/style.css">
    <link rel="stylesheet" type="text/css" href="./ASSETS/font/fontawesome/css/all.css">
</head>

<body>
    <!-- HEADER -->
    <?php require_once 'header.php' ?>
    <!-- CLOSE HEADER -->


    <!-- BODY -->
    <?php 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        require_once $page;
    }
    else{
        require_once 'content.php';
    }
    ?>
    <!-- CLOSE BODY -->


    <!-- FOOTER -->
    <?php require_once 'footer.php' ?>
    <!-- CLOSE FOOTER -->

    
</body>

</html>