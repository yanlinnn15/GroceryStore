<?php

include('../config/connect.php');

    if(isset($_POST['setpass'])){

        $value=$_POST['v1'].$_POST['v2'].$_POST['v3'].$_POST['v4'].$_POST['v5'].$_POST['v6'];
        $value1= $_POST['cv1'].$_POST['cv2'].$_POST['cv3'].$_POST['cv4'].$_POST['cv5'].$_POST['cv6'];

        //both pin is the same
        if($value==$value1){
            

            $pin=password_hash($value,PASSWORD_DEFAULT,['cost' => 15]);

            $res=mysqli_query($conn,"UPDATE customer set wPin='$pin', wActivate=1 where cusID='".$_SESSION['user']."'");

            if(mysqli_affected_rows($conn)>0){
                $_SESSION['success']="Wallet Pin Set!";
                header("location: wa.php");

            }else{
                $_SESSION['fail']="Something went wrong!";
                header("location: setpass.php");
            }

        }else{

            //different 
            $_SESSION['fail']="Two Pin Must be the Same!";
            header("location: setpass.php");
        }
    }
?>

<?php

    if(isset($_POST['resetpin'])){

        $cuvalue=$_POST['cuv1'].$_POST['cuv2'].$_POST['cuv3'].$_POST['cuv4'].$_POST['cuv5'].$_POST['cuv6'];
        $value=$_POST['v1'].$_POST['v2'].$_POST['v3'].$_POST['v4'].$_POST['v5'].$_POST['v6'];
        $value1= $_POST['cv1'].$_POST['cv2'].$_POST['cv3'].$_POST['cv4'].$_POST['cv5'].$_POST['cv6'];

        $getpin=mysqli_query($conn,"SELECT * FROM customer where cusID='".$_SESSION['user']."'");

        $rowget=mysqli_fetch_assoc($getpin);

        if(password_verify($cuvalue,$rowget['wPin'])==true){

            if(password_verify($value,$rowget['wPin'])==false){

                if($value==$value1){

                    $pin=password_hash($value,PASSWORD_DEFAULT,['cost' => 15]);
        
                    $res=mysqli_query($conn,"UPDATE customer set wPin='$pin' where cusID='".$_SESSION['user']."'");
        
                    if(mysqli_affected_rows($conn)>0){
                        
                        $_SESSION['success']="Wallet Pin Changed!";
                        header("location: wa.php");
        
                    }else{
                        $_SESSION['fail']="Something went wrong!";
                        header("location: resetpin.php");
                    }
        
                }else{
        
                    //different 
                    $_SESSION['fail']="New Pin and Confirm Pin Must be the Same!";
                    header("location: resetpin.php");
                }
                
            }else{
                $_SESSION['fail']="New Pin cannot same with Current Pin!";
                header("location: resetpin.php");
            }

        }else{
            $_SESSION['fail']="Current pin is wrong!";
            header("location: resetpin.php");
            
        }
    }
?>