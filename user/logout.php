<?php

    include("../config/connect.php");

    //1.destroy the session of user
    unset($_SESSION['user']);

    //2.redirect to login page
    header("location:".SITEURL."user/login-register.php");

?>