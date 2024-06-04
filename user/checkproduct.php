<?php
    include('../config/connect.php');
    if(isset($_SESSION['user'])){

        if(isset($_POST["action"])){
            if($_POST["action"]=="check"){
                $res=mysqli_query($conn,"SELECT * FROM cart inner join product on product.productID=cart.productID where cusID='".$_SESSION['user']."' and pQty>=qty and productStatus='A'");
                $data=mysqli_num_rows($res);
                echo $data;
            }

        }
    }

?>