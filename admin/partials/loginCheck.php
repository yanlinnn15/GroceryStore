<?php
    
    //check whether user is login or not
    if(!isset($_SESSION['admin'])){
        header("location:".SITEURL."admin/login.php");
    }else{
        $adminID=$_SESSION['admin'];
        $sqlll="SELECT * FROM admin where adminID='$adminID' and aStatus='A'";
        $resss=mysqli_query($conn,$sqlll);
        if($resss){
            if(mysqli_num_rows($resss)<=0){
                $_SESSION['accinactive']="Inactive";
                unset($_SESSION['admin']);
                unset($_SESSION['adminType']);
                header("location:".SITEURL."admin/login.php");
            }
        }
    }



?>