<?php
// conn sql
require_once '../conn.php';
?>

<?php

$username = $_POST['username'];
$password = $_POST['password'];
// handle login guest
if (isset($_POST['btn-login'])) {

    function login_guest($username, $password)
    {

        if (!empty($username)) {
            echo $username;
            echo $password;
        }
    }

    login_guest($username,$password);
}




?>
