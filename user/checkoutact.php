<?php
    include('../config/connect.php');
    if(isset($_SESSION['user'])){
        $id=$_SESSION['user'];

        if(isset($_POST["action"])){
            if($_POST["action"]=="price"){
               $date=$_POST['date'];
               $subttl=$_POST['subttl'];

               $a=explode(":",$date);
               $p=$a[1];
               $res=mysqli_query($conn, "SELECT dprice from timeslot where timeslot='$p'");
               $row=mysqli_fetch_assoc($res);
               $sp=$row['dprice'];

               $ttl=$subttl+$sp;

               echo $sp;

            }

            if($_POST["action"]=="checkWallet"){
                $ttl=$_POST['ttl'];
 
                $res1=mysqli_query($conn, "SELECT * from customer  where cusID='$id' and walletAmount>='$ttl' limit 1");
                $row1=mysqli_num_rows($res1);
 
                echo $row1;
 
            }

            if($_POST["action"]=="checkout"){
                $ad=$_POST['ad'];
                $payment=$_POST['payment'];
                $countP=$_POST['countP'];
                $time=$_POST['time'];
                $a=explode(":",$time);
                $date=$a[0];
                $timeSlot=$a[1];

                $cerror=0;

                //check address
                $res3=mysqli_query($conn,"SELECT * FROM address where cusID='$id' and addressID='$ad'");
                if(mysqli_num_rows($res3)!=1){
                    //invalid address;
                    $data= "AE";
                    $cerror++;
                }
                
                //checktime slot
                $res4=mysqli_query($conn, "select count(*) as total from orderp where shipDate=CURDATE()+$date and timeSlot='$timeSlot' and status!=7");
                $row4=mysqli_fetch_assoc($res4);
                $res5=mysqli_query($conn, "select * from timeslot where timeSlot='$timeSlot'");
                $row5=mysqli_fetch_assoc($res5);
                if($row4['total']>=$row5['numberOfSlot']){
                    $data= 'TSE';
                    $cerror++;
                }
            
                //both ok
                if($cerror==0){
                    $row3=mysqli_fetch_assoc($res3);
                    $rn=$row3['receiverName'];
                    $pn=$row3['receiverPhoneNo'];
                    $st=$row3['street'];
                    $city=$row3['city'];
                    $pc=$row3['postcode'];
                    $state=$row3['state'];
                    $gttl=0;

                    //get address
                    $row3=mysqli_fetch_assoc($res3);

                    //create an order
                    $res6=mysqli_query($conn,"INSERT into orderp (cusID,receiverName,receiverPhoneNo,street,city,postcode,state)
                    VALUES('$id','$rn','$pn','$st','$city','$pc','$state')");

                    $oid = mysqli_insert_id($conn);

                    //insert into order detail
                    $res7=mysqli_query($conn,"SELECT * FROM cart inner join product on cart.productID=product.productID where cusID='$id' and pQty>=qty");
                    if(mysqli_num_rows($res7)==$countP){
                        while($row7=mysqli_fetch_assoc($res7)){
                            $cid=$row7['cartID'];
                            $pqty=$row7['pQty'];
                            $qty=$row7['qty'];
                            $quan=$pqty-$qty;
                            $price=$row7['pPrice'];
                            if($row7['discountPercent']!=null){
                                $dis=$row7['discountPercent'];
                            }else{
                                $dis=0.00;
                            }
                            $disprice=number_format((float)$price*(((float)$dis)/100), 2, '.', '');
                            $dip=$price-$disprice;
                            $fttlprice=number_format((((float)$price-(float)$disprice)*$qty), 2, '.', '');
                            $pid=$row7['productID'];

                            //drop shopping cart
                            $res12=mysqli_query($conn,"DELETE FROM cart WHERE cusID=$id and cartID=$cid and $pqty>=qty");


                            //update new quantity
                            $res8=mysqli_query($conn,"INSERT into orderdetail (qty,price_used,discount,oDPrice,productID,orderID,oDttl)
                            VALUES ($qty,$price,$dis,$dip,$pid,$oid,$fttlprice)");

                            $res11=mysqli_query($conn,"UPDATE product set pQty='$quan' where productID='$pid'");

                            $gttl+=$fttlprice;
                        }
                    }

                    if($gttl>=90){
                        $sf=0.00;
                    }else{
                        $sf=$row5['dprice'];
                    }


                    $ttlA=(float)$gttl+(float)$sf;

                    //create a payment
                    $res9=mysqli_query($conn,"INSERT INTO payment (pAmount, orderID,pmID)
                        VALUES ($ttlA,$oid,$payment);
                    ");
                    $paymentid = mysqli_insert_id($conn);
                    
                    //update to order
                    $res11=mysqli_query($conn,"UPDATE orderp set totalPrice='$ttlA',shipping_fee='$sf',ttlorder='$gttl',shipDate=curdate()+$date,timeslot=$timeSlot where orderID='$oid'");

                    //if payment method is cash
                    if($payment==1){
                        $res12=mysqli_query($conn,"UPDATE orderp set status=2 where orderID='$oid'");
                    }
                    $data=$paymentid;
                }
 
                echo $data;
 
            }

            
        }

    }

?>