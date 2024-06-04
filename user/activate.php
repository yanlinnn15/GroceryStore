<?php
    include('../config/connect.php');

    if(isset($_POST['activate'])){

        $a=1;
        $row=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from customer where cusID='".$_SESSION['user']."'"));
        //$limit=$row['limitrequest'];
        //$limit=$limit-1;
        $hash= rand(100000, 999999);
        $current=date('Y-m-d H:i');
        $expire_date = date('Y-m-d H:i',strtotime('+10 minutes',strtotime($current)));
        $sql1="UPDATE CUSTOMER SET 
                walletKey='$hash',
                walletKeyExpired='$expire_date'
                where cusID='".$_SESSION['user']."' and wActivate=0
                ";

        $res1=mysqli_query($conn,$sql1);

        if(mysqli_affected_rows($conn)>0){
            $to=$row['cusEmail'];
            $subject="Fresh Grocers Wallet Verification";
            $message="

                We have received your request for wallet activation.<br>
        
                Your Activation Code is <strong>$hash</strong><br>

                This code will valid for 10 minutes!

                **Please Do not share your code to others<br>
        
                Thanks! &#8211; FreshGrocers<br>
            ";
            $headers ="From: ffreshgrocers@gmail.com \r\n";
            $headers = "MIME-Version: 1.0" . "\r\n"; //set content type when sending html email
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            mail($to,$subject,$message,$headers);
            header("location:acti.php");
            }else{
                header("location:wa.php");
                $_SESSION['ac']="Fail";
                
            }

    }
    
?>