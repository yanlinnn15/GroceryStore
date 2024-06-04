<?php
include('../config/connect.php');

if(isset($_POST['submitcode'])){

    $value=$_POST['v1'].$_POST['v2'].$_POST['v3'].$_POST['v4'].$_POST['v5'].$_POST['v6'];
    $current=date('Y-m-d H:i');

    $res=mysqli_query($conn,"SELECT * FROM customer where cusID='".$_SESSION['user']."'");

    if($res){

        $row=mysqli_fetch_assoc($res);

        if($row['walletKeyExpired']<$current){
            $_SESSION['fail']="The Code already Expired. Please try again!";
            header("location:acti.php");
        }else{

            if($row['walletKey']==$value){

                $res1=mysqli_query($conn,"UPDATE customer set wActivate=2 where cusID='".$_SESSION['user']."'");
                if(mysqli_affected_rows($conn)>0){
                    header("location:setpass.php");
                }else{
                    $_SESSION['fail']="Something went wrong... Please Try again!";
                    header("location:acti.php");
                }
            }else{
                $_SESSION['fail']="Please Enter a valid Code!";
                header("location:acti.php");
                
            }
        }

    }else{
        echo "error";
    }
}

?>