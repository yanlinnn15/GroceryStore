<?php

    include("../config/connect.php");

    //1.destroy the session
    unset($_SESSION['admin']);

    //2.redirect to login page
    header("location:".SITEURL."admin/login.php");

?>