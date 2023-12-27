<?php
$servername = "localhost";
$database = "banphimco";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die(mysqli_connect_error());
    exit();
}

?>