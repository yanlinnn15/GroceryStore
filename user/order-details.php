<?php include('partials_front/header.php'); ?>
<?php include('partials_front/loginCheck.php'); ?>
<?php
    if(isset($_GET['oid'])){
        $oid=$_GET['oid'];
    }else{
        header("location: 404page.php");
    }

?>

<div class="site-content">
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin">
                        <a href="index.php">
								<span>
									Home
								</span>
                        </a>
                    </li>
                    <li class="trail-item trail-end active">
							<span>
								Order
							</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="main-content-cart main-content col-sm-12">
                    <h3 class="custom_blog_title">
                        Order Details
                    </h3>
                    <?php 
                        $res=mysqli_query($conn,"SELECT * FROM orderp inner join orderdetail on orderp.orderID=orderdetail.orderID inner join timeslot on orderp.timeslot=timeslot.timeSlot where cusID='".$_SESSION['user']."' and orderdetail.orderID=$oid"); 
                        if(mysqli_num_rows($res)>0){
                        $row=mysqli_fetch_assoc($res); ?>
                        <div class="title">
                        <span>Order ID: #<?php echo $oid; ?></span><br>
                        <span>Order Date: <?php echo $row['orderDate'];?><br>
                        <span>Delivery Time: <?php echo $row['shipDate']." ".$row['timeRange'];?><br>                 

                        </span>
                        <span>Order Status :  <?php 
                            $row2=mysqli_fetch_assoc((mysqli_query($conn,"SELECT * from orderstatus where osID='".$row['status']."'")));
                        ?><strong><?php echo $row2['osName'] ?></strong></span>
                    <br><br>

                    <div>
                        <h3 class="title-form"> <i class="fa fa-map-marker"></i> Delivery Details </h3>
                        <strong><?php echo $row['receiverName']; ?> <?php echo "(".$row['receiverPhoneNo'].")"; ?></strong>
                        <br>
                        <?php echo $row['street']; ?><?php echo " "; echo $row['postcode']; 
                        echo" "; echo $row['city'];  echo", "; echo $row['state']; echo "." ?>

                    </div>
                    <br>
                    <div class="page-main-content">
                        <div class="shoppingcart-content">
                        <div class="row-col-2 row-col">
                        <div class="your-order">
                            <h3 class="title-form">
                                Your Order
                            </h3>
                            <ul class="list-product-order">
                                <?php
                                    $respro=mysqli_query($conn,"SELECT * FROM orderdetail, product, orderp where orderdetail.orderID='$oid' and orderdetail.productID=product.productID and orderdetail.orderID=orderp.orderID"); 
                                    if(mysqli_num_rows($respro)>0){
                                        while($row=mysqli_fetch_assoc($respro)){
                                            $subttl=$row['ttlorder'];
                                            $sf=$row['shipping_fee'];
                                            $sta=$row['status'];
                                            $ttl=$row['totalPrice'];
                                            ?>
                                        
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
                                                    <?php if($row['discount']!=0){?>
                                                    <del style="color:#929292">RM <?php echo number_format($row['price_used'],2); ?></del>
                                                    <span>RM <?php echo number_format($row['oDPrice'],2) ?></span>
                                                    <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
                                                       <?php echo $row['discount']." % OFF"; ?>
                                                    </span>
                                                    <?php }else{ ?>
                                                        <span>RM <?php echo number_format($row['price_used'],2); ?> </span>
                                                   <?php } ?>
                                                    <br>
                                                    <span class="attributes-select attributes-color">Quantity: <?php echo $row['qty']; ?></span>
                                                    <div class="price" style="float: right;">
                                                        RM <?php echo number_format($row['oDttl'],2); ?>
                                                    </div>
                                                    
                                                
                                                </div>
                                            </li>
                                    <?php }?>
                            </ul>
                            <!-- Order Summary -->
                            <div class="order-total">
                               <table style="border: none;">
                                   <tr>
                                        <td style="border: none;">Subtotal : </td>
                                        <td style="float: right;">RM <?php echo $subttl; ?></td>
                                    </tr>
        
                                    <tr>
                                        <td>Shipping Fee : </td>
                                        <td style="float: right;">RM <span class="sp"><?php echo $sf; ?></span></td>
                                    </tr>
                                       
                        
                                    
                                    <tr style="border-top: 0.5px solid #DCDCDC;">
                                        <td>Total : </td>
                                        <td style="float: right;" class="ttl">RM <span class="ttlP"><?php echo $ttl; ?></span></td>
                                    </tr>
                               </table>
                            </div>
                            <div class="control-cart">
                                <a href="index.php" class="button">Back to Shopping</a>
                                <?php switch($sta){ 
                                    case 1:
                                    $res=mysqli_query($conn,"SELECT * FROM")
                                    
                                    ?>
                                    <form action="" method="post">
                                        <?php 

                                        $res7=mysqli_query($conn,"SELECT * FROM payment where orderID='".$oid."'");
                                        $row7=mysqli_fetch_assoc($res7);
                                        if($row7['pmID']==2){ ?>
                                            <a href="walletpayment.php?pID=<?php echo $oid; ?>" class="button">Pay Now</a>
                                        <?php }else{ ?>
                                            <a href="creditcardpayment.php?pID=<?php echo $oid; ?>" class="button">Pay Now</a>
                                        <?php }
                                        ?>
                                        <a href="javascript:void(0);" onclick="cancel(<?php echo $oid; ?>)" class="button btn-btn-info">Cancel Order</a>
                                    </form>
                                    <?php break;
                                    case 4: ?>
                                        <a href="" class="button btn btn-warning">Received</a>
                                    <?php break;
                                    case 5: 
                                        $respro1=mysqli_query($conn,"SELECT * FROM review where orderID=$oid"); //check rated or not rated
                                        if(mysqli_num_rows($respro1)>0){ ?>
                                            <a href="viewreview.php?id=<?php echo $oid; ?>" class="button">View Rating</a>
                                        <?php }else{ ?>
                                            <a href="review.php?id=<?php echo $oid; ?>" class="button">Rate Now</a>
                                        <?php } 
                                        ?>
                                    <?php break; 

                                }
                                        

                                    
                                ?>

                            </div>

                    

                    <?php     }}else{

                        echo "No record Found\n"; ?>
                        <div class="control-cart" style="margin-top: 20px;">
                                    <a href="index.php" class="button">Back to Shopping</a>
                            </div>
                    <?php }
                        
                    ?>
                    </div>
                    </div>
                    
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include('partials_front/footer.php'); ?>