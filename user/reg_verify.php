<?php
    require '../config/connect.php';
    if(isset($_GET['vkey'])){
        //process verification
        $vkey=$_GET['vkey'];
        $current=date('Y-m-d H:i');

        $sql= "SELECT * FROM customer where verified=0 and vkey='$vkey' and vkeyexpired>='$current' LIMIT 1;";
        $res=mysqli_query($conn,$sql);
        //check if sql return value 
        if(mysqli_num_rows($res)==1){
            //validate the email
            $sql1="UPDATE customer set verified=1 where vkey='$vkey' LIMIT 1;";
            $res1=mysqli_query($conn,$sql1);
            if($res1){ 
                header('location:'.SITEURL."user/verifylink.php?status=success"); 
            }
            
        }else{

            $sql3= "SELECT * FROM customer where verified=0 and vkey='$vkey' and vkeyexpired<'$current' LIMIT 1;";
            $res3=mysqli_query($conn,$sql3);
            if(mysqli_num_rows($res3)==1){
                header('location:'.SITEURL."user/verifylink.php?status=fail");
            }else{
                header("location: ".SITEURL."user/login-register.php");
                $_SESSION['veri']="Your account had been verified. You may log in now ~";
            }
        }
    }else{ 
        header("location: ".SITEURL."user/404page.php");
    }
?>          