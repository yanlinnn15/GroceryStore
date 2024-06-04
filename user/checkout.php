<?php 
    include('partials_front/header.php');
    include('partials_front/loginCheck.php');
?>
<script>
    document.getElementById('minicart').style.display="none";   
</script>
<style>
.styled-table thead tr {
    background-color: #39ac39;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
    .checkout-form-steps label{
        width: 100%;
        float: left;
        border:2px solid #d0d0d0;
        border-radius: 4px;
        margin-bottom: 15px;
        padding: 10px;
    }
    .checkout-form-steps label:hover {
        border-color: green;
    }   
</style>

<div class="main-content main-content-checkout">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            Checkout 
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <h3 class="custom_blog_title">
            Checkout
        </h3>
        <div class="checkout-wrapp">
        <div class="shipping-address-form-wrapp">
<?php
    $res=mysqli_query($conn,"SELECT * FROM cart inner join product on product.productID=cart.productID where cusID='".$_SESSION['user']."' and pQty>=qty");
    if(mysqli_num_rows($res)<=0){?>
        <div style="text-align: center;">
            Something went wrong..<br><br>
            <a href="index.php" class="button">Back to Shopping</a>
        </div>      
        <?php  }else{
?>
                <div class="shipping-address-form  checkout-form">
                    <div class="row-col-1 row-col">
                    <div class="shipping-address">
                            <div>
                                <h3 class="title-form"> <i class="fa fa-map-marker"></i> Delivery Address </h3>
                            </div>
                                <?php 
                                    $id=$_SESSION['user']; 
                                    $numad=0;
                                    $ad;
                                    if(isset($_GET['choosed'])){
                                        $ad=$_GET['choosed'];
                                    }else{
                                        $resad=mysqli_query($conn,"SELECT * FROM address where cusID='$id' and defaultad=1");
                                        $numad=mysqli_num_rows($resad);
                                        if($numad==1){
                                            $rowad=mysqli_fetch_assoc($resad);
                                            $ad=$rowad['addressID'];
                                        }
                                    }
                                    ?>
                                    <?php 
                                        if($numad>=1 || !empty($ad)){ 
                                                if(isset($_POST['change'])){ ?>
                                                    <form action="">
                                                    <?php
                                                        $res1=mysqli_query($conn,"SELECT * FROM address where cusID='$id'"); //check address
                                                        if(mysqli_num_rows($res1)>0){ ?>
                                                            <a href="checkout.php?add=1" style="float: right;" class="btn-purple">+ Add New Address</a>
                                                            <div class="checkout-form-steps" style="margin-bottom: 20px;">
                                                            <?php

                                                            while($row3=mysqli_fetch_assoc($res1)){ ?>
                                                            <label for="<?php echo $row3['addressID'];?>">
                                                                <input type="radio" class="choosed" name="choosed" <?php if($row3['addressID']==$_POST['change']){?> checked <?php } ?> id="<?php echo $row3['addressID'];?>" value="<?php echo $row3['addressID'];?>">
                                                                <strong><?php echo $row3['receiverName']; echo " (". $row3['receiverPhoneNo'].") "; ?></strong>
                                                            <?php echo $row3['street']; ?><?php echo " "; echo $row3['postcode']; 
                                                                echo" "; echo $row3['city'];  echo", "; echo $row3['state']; echo "." ?>
                                                            </label>
                                                    <?php }} ?>
                                                        <button style="float:right; padding:5px 10px; margin-bottom: 10px;" onclick="confirmad()">Confirm Address</button>
                                                        </div>

                                               <?php  }else if(isset($_GET['add'])){
                                                include('checkout-addAddress.php'); ?>
                                                
                                         <?php  }
 
                                               else{
                                                    //address selected
                                                    $res4=mysqli_query($conn,"SELECT * FROM address where cusID='$id' and addressID='$ad'");
                                                    $row4=mysqli_fetch_assoc($res4); ?>
                                                    <div class="checkout-form-steps">
                                                        <label for="<?php echo $row4['addressID'];?>">
                                                            <input type="radio" class="choosed" name="choosed" disabled checked id="<?php echo $row4['addressID'];?>" value="<?php echo $row4['addressID'];?>">
                                                            <strong><?php echo $row4['receiverName']; echo " (". $row4['receiverPhoneNo'].") "; ?></strong>
                                                        <?php echo $row4['street']; ?><?php echo " "; echo $row4['postcode']; 
                                                            echo" "; echo $row4['city'];  echo", "; echo $row4['state']; echo "."?>
                                                        </label>
                                                    
                                                    </div>
                                                    
                                                    <form action="" method="post">
                                                        <button name="change" value="<?php echo $ad; ?>">Change</button>
                                                    </form>


                                                    
                                                <!-- Time Slot -->
                                                <hr>
                                                <div>
                                                    <h3 class="title-form"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Delivery Schedule </h3>
                                                </div>
                                                <p>
                                                **Delivery fee will be waived if your order more than RM 90.00
                                                <div class="table">
                                                    <table class="styled-table">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <?php 
                                                                for($i=1;$i<=3;$i++){
                                                                    $tday= date("d-m-Y", strtotime("+$i day")); ?>
                                                                    <th style="text-align: center;"><?php echo $tday;?></th>
                                                                <?php } 
                                                            ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php
                                                                    $res=mysqli_query($conn,"select * from timeslot");
                                                                    while($row=mysqli_fetch_assoc($res)){
                                                                        $value=1;?>                            
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $row['timeRange']; ?></td>
                                                                <?php 
                                                                    for($i=1;$i<=3;$i++){
                                                                    
                                                                    
                                                                    $tday= date("Y-m-d", strtotime("+$i day"));
                                                                    $res1=mysqli_query($conn,"select count(*) as total from orderp where shipDate='$tday' and status!=7 and timeslot='".$row['timeSlot']."'");
                                                                    $row1=mysqli_fetch_assoc($res1);
                                                                    if($row1['total']==$row['numberOfSlot']){?>
                                                                    <td>Unavailable</td> 

                                                                    <?php }else{ ?>
                                                                    <td><input type="radio" value="<?php echo $value.":".$row['timeSlot']; ?>" id="button1" name="buttontime" class="button1"><?php echo "RM ".$row['dprice'];?></button></td>

                                                                    <?php }?>

                                                                <?php $value++; } ?>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </p>
                                        <!-- end of timeslot -->
                                        <hr>

                                        <!-- Payment Method -->
                                        <div class="Payment" id="payment">
                                            <div class="checkout-form-steps">
                                                <h3 class="title-form">Payment Method </h3>
                                                <p>
                                                    <label for="radio1">
                                                        <?php $checkorder=mysqli_query($conn,"select * from orderp where cusID='".$_SESSION['user']."' and status!=7 and status!=1");
                                                        if(mysqli_num_rows($checkorder)>=5){ ?>
                                                        <input type="radio" name="payment" id="radio1" value="1">
                                                        In Cash
                                                        <?php }else{ ?>
                                                        <input type="radio" name="payment" id="radio1" value="1" disabled style="opacity: 0.6;"> In Cash (Enjoy COD while purchased 5 orders with us!)
                                                         
                                                        <?php } ?>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label for="radio2">
                                                        <input type="radio" name="payment" id="radio2" value="3">
                                                        Credit/ Debit Card
                                                    </label>
                                                </p>
                                                <p>
                                                    <!-- wallet -->
                                                    <?php
                                                        //check wallet activation status
                                                        $res=mysqli_query($conn, "select * from customer where cusID='$id' and wActivate=1 limit 1");
                                                        if(mysqli_num_rows($res)==1){ 
                                                            $row=mysqli_fetch_assoc($res); //activate ?>
                                                            <label for="radio3">
                                                            <?php 
                                                                $res7=mysqli_query($conn,"SELECT FORMAT(sum(pPrice*((1-(discountPercent/100))*qty)), 2) as 'ttlPrice' FROM cart inner join product on product.productID=cart.productID where cusID=100036 and pQty>=qty and discountPercent is not null;");
                                                                $res8=mysqli_query($conn,"SELECT FORMAT(sum(pPrice*qty), 2) as 'ttlPrice1' FROM cart inner join product on product.productID=cart.productID where cusID=100036 and pQty>=qty and discountPercent is null;");                                                           
                                                                $row7=mysqli_fetch_assoc($res7);
                                                                $row8=mysqli_fetch_assoc($res8);
                                                                $subttl=$row7['ttlPrice']+$row8['ttlPrice1'];
                                                            ?>
                                                            <?php if($row['walletAmount']>=$subttl){ ?>
                                                                <input type="radio" name="payment" id="radio3" value="2">
                                                                <span>

                                                            <?php }else{ ?>
                                                                <input type="radio" name="payment" id="radio3" disabled style="opacity: 0.6;">
                                                                
                                                        <?php  } ?>
                                                            Wallet (RM <?php echo number_format($row['walletAmount'],2); ?>)</span>
                                                            </label>
                                                        <?php }else{
                                                            $res66=mysqli_query($conn, "select * from customer where cusID='$id' and wActivate=2 limit 1");
                                                            if(mysqli_num_rows($res66)==1){ ?>

                                                                <label for="radio3">
                                                                <input type="radio" name="payment" id="radio3" disabled style="opacity: 0.6;">
                                                                <span style="opacity: 0.6;">Wallet</span>
                                                                <a href="wa.php" class="button" style="margin-bottom:0px; margin-left: 10px; padding:5px 18px;">Set Pin</a>
                                                                </label>

                                                           <?php }else{
                                                                //wallet haven't activate ?>
                                                            <label for="radio3">
                                                                <input type="radio" name="payment" id="radio3" disabled style="opacity: 0.6;">
                                                                <span style="opacity: 0.6;">Wallet</span>
                                                                <a href="wa.php" class="button" style="margin-bottom:0px; margin-left: 10px; padding:5px 18px;">Activate Now</a>
                                                            </label>

                                                        <?php    } ?>
                                                            
                                                        <?php }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                  <!-- End Payment -->

                                <!-- Order -->
                                <div class="row-col-2 row-col">
                                    <div class="your-order">
                                        <h3 class="title-form">
                                            Your Order
                                        </h3>
                                        <ul class="list-product-order">
                                            <?php
                                                $res=mysqli_query($conn,"SELECT * FROM cart inner join product on product.productID=cart.productID where cusID='".$_SESSION['user']."' and pQty>=qty");
                                                $countP=mysqli_num_rows($res);
                                                if(mysqli_num_rows($res)>0){
                                                    $ttlPrice=0;
                                                    while($row=mysqli_fetch_assoc($res)){?>
                                                    <li class="product-item-order">
                                                        <div class="product-thumb">
                                                            <a href="productdetails.php?productid=<?php echo $row['productID']; ?>">
                                                                <img src="<?php echo $row['pImage1']; ?>" alt="img">
                                                            </a>
                                                        </div>
                                                        <div class="product-order-inner">
                                                            <h5 class="product-name">
                                                            <a href="productdetails.php?productid=<?php echo $row['productID']; ?>"><?php echo $row['pName']; ?></a>
                                                            </h5>
                                                            <?php if(!empty($row['discountPercent'])){
                                                            $disp=number_format(($row['pPrice']*(100-$row['discountPercent'])/100),2);?>
                                                            <del style="color:#929292">RM <?php echo number_format($row['pPrice'],2) ?></del>
                                                            <span>RM <?php echo $disp ?></span>
                                                            <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
                                                            <?php echo $row['discountPercent']." % OFF"; ?>
                                                            </span>
                                                            <?php }else{ 
                                                                $disp=$row['pPrice']; ?>
                                                                <span>RM <?php echo number_format($row['pPrice'],2); ?> </span>
                                                        <?php } ?>
                                                            <br>
                                                            <span class="attributes-select attributes-color">Quantity: <?php echo $row['qty']; ?></span>
                                                            <div class="price">
                                                                RM <?php echo number_format($disp*$row['qty'],2); ?>
                                                            </div>
                                                            
                                                        
                                                        </div>
                                                    </li>

                                                    <?php 
                                                    $p=number_format((float)$disp*(int)$row['qty'], 2, '.', '');
                                                    $ttlPrice+=$p;
                                                    ?>
                                                <?php }?>
                                                
                                            <?php }
                                            ?>  
                                        </ul>
                                        <!-- Order Summary -->
                                        <div class="order-total">
                                            <h3 class="title-form">
                                                Order Summary
                                            </h3>
                                        <table style="border: none;">
                                            <tr>
                                                    <td style="border: none;">Subtotal : </td>
                                                    <td style="float: right;">RM <?php echo number_format($ttlPrice,2, '.', ''); ?></td>
                                                </tr>
                    
                                                <tr>
                                                    <td>Shipping Fee : </td>
                                                    <td style="float: right;">RM <span class="sp">0.00</span></td>
                                                </tr>
                                                
                                    
                                                
                                                <tr style="border-top: 0.5px solid #DCDCDC;">
                                                    <td>Total : </td>
                                                    <td style="float: right;" class="ttl">RM <span class="ttlP"><?php echo number_format($ttlPrice,2, '.', ''); ?></span></td>
                                                </tr>
                                        </table>
                                        </div>

                                    </div>
                                    
                                </div>
                                
                            </div>
                            <p id="button-payment">
                                <a class="button button-payment">Continue to Payment</a>
                            </p>

                                                
                            <?php }}else{
                                //no address
                                include('checkout-addAddress.php');
                                
                            }} ?>

<script>
$(document).on('change', '.button1', function(){
    var button1 = $(this).val();
    var subttl="<?php echo number_format((float)$ttlPrice, 2, '.', ''); ?>";
    
    $.ajax({
        type: "POST",
        url: 'checkoutact.php',
        data:{action:'price',date:button1, subttl:subttl},
        success:function(data) {
            var ttl=parseFloat(subttl);
            if(subttl<90){
                ttl=parseFloat(data)+parseFloat(subttl);
                ttl=parseFloat(ttl).toFixed(2);
                $('.sp').text(data);
                $('.ttlP').text(ttl);
            }

            $.ajax({
                type: "POST",
                url: 'checkoutact.php',
                data:{action:'checkWallet',ttl:ttl},
                success:function(data) {
                   if(data!=1){
                        document.getElementById("radio3").disabled = true;  
                        document.getElementById("radio3").checked = false;  
                   }else{
                        document.getElementById("radio3").disabled = false; 
                   }
                        
                },error:function(data){
                    alert(error);
                }
            });	
                
        },error:function(data){
            alert(error);
        }
    });	
});
$(document).on('click', '.button-payment', function(){
    var time=$('input[name="buttontime"]:checked').val();
    var payment=$('input[name="payment"]:checked').val();
    if(time==undefined){
        Swal.fire(
            'Sorry',
            'Please Choose the Time Slot',
            'info'
        );
    }

    if(payment==undefined){
        Swal.fire(
            'Sorry',
            'Please Choose the Payment Method',
            'info'
        );
    }
    if(time!=undefined && payment!=undefined){
         //check product
         var countP='<?php echo $countP; ?>';
        $.ajax({
			type: "POST",
			url: 'checkproduct.php',
			data:{action:'check'},
			success:function(data) {
			  if(data==countP){
                    //product not change
                    var ad="<?php echo $ad; ?>";
                    $.ajax({
                        type: "POST",
                        url: 'checkoutact.php',
                        data:{action:'checkout',ad:ad,time:time,payment:payment,countP:countP},
                        success:function(data) {
                            if(data=="AE"){
                                Swal.fire(
                                    'Sorry',
                                    'Invalid Address',
                                    'info'
                                );
                            }else if(data=="TSE"){
                                Swal.fire(
                                    'Sorry',
                                    'Delivery Time Slot Error',
                                    'info'
                                );
                            }else{
                                if(payment==1){
                                    window.location="paymentsuccess.php";
                                }
                                if(payment==2){
                                    window.location="walletpayment.php?payID="+data;
                                }
                                if(payment==3){
                                    window.location="creditcardpayment.php?payID="+data;
                                }

                            }
                        },error(data){
                            alert(data);
                        }
                });
			  }else{
				Swal.fire({
					icon: 'info',
					title: 'Oops...',
					text: 'Your cart had changed! Click Yes to Reload the Page !',
					showDenyButton: true,
					confirmButtonText: 'Yes',
				  }).then((result) => {
					if (result.isConfirmed) {
						location.reload();
					}
				});
			  }
			}
	   });
    }   
});

</script>
<script>
        
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
  </script>