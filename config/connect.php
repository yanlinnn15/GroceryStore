<?php
    //Start session
    session_start();
    date_default_timezone_set('Asia/Kuala_Lumpur');
    //Create constants to store non repeating values
    define('SITEURL','https://localhost/onlinegrocery/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','onlinegrocery');

    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error($conn));
?>