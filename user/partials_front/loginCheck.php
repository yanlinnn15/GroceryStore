<?php
    //check whether user is login or not
    if(!isset($_SESSION['user'])){
        header("location:".SITEURL."user/login-register.php");
    }else{
        //check the account status
        $rescheck=mysqli_query($conn,"SELECT * from customer where cstatus=1 and cusID='".$_SESSION['user']."'");
        if(mysqli_num_rows($rescheck)!=1){
            unset($_SESSION['user']);
            $_SESSION['inactive']="Your account is inactive!";
            header("location:".SITEURL."user/login-register.php");
        }
    }
?>