<?php
    include('../config/connect.php');
    include("partials_front/loginCheck.php");
    if(isset($_POST['action'])){

        if($_POST['action']=='cancel'){
            $data=$_POST['orderID'];
            //check order id exist or not
            $res=mysqli_query($conn,"SELECT * FROM orderp where orderID='".$_POST['orderID']."'");

            if(mysqli_num_rows($res)>0){
                //order exist and check status
                $row=mysqli_fetch_assoc($res);
                if($row['status']==1){
                    $res1=mysqli_query($conn,"Update orderp set status=7 where orderID='".$_POST['orderID']."'");
                    if(mysqli_affected_rows($conn)>0){
                        $data=0;
                    }
                }
            }
            echo $data;
        }
    }



?>