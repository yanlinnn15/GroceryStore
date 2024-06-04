<?php include('partials/header.php');?>
<?php 
if(isset($_GET['oid'])){
    $oid=$_GET['oid'];
}else{
    header("location: pages-error-404.php");
}?>
<link rel="stylesheet" href="css/od.css">
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Order</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Order</a></li>
                            <li class="breadcrumb-item active"><a href="allorder.php">All Orders</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="wrapper">
                                <?php 
                                
                                $res=mysqli_query($conn,"SELECT * FROM orderp inner join timeslot on orderp.timeslot=timeslot.timeSlot inner join payment on payment.orderID=orderp.orderID inner join paymentmethod on payment.pmID=paymentmethod.pmID inner join customer on customer.cusID=orderp.cusID where orderp.orderID=$oid");
                                $row=mysqli_fetch_assoc($res);
                                
                                
                                ?>
                                <div class="h5 large"> <!--<a href=""><i class="btn fa fa-arrow-circle-left"></i></a>--> Order # <?php echo $oid ?> <a href="print.php?id=<?php echo $row['orderID']?>" target="_blank" style="float: right;"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-file-pdf-o"></i></button></a> </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-10 offset-lg-0 offset-md-2 offset-sm-1"> 
                                        <div id="address" class="bg-light rounded mt-3">
                                                <div class="h5 font-weight-bold text-primary">Order Detail </div>
                                                <div class="d-md-flex ">
                                                    <div>
                                                    <br>
                                                    <label><strong>Order Date</strong>&nbsp;</label><br><?php echo $row['orderDate']; ?> <br><br>
                                                    
                                                    <label><strong>Payment Method </strong>&nbsp;</label><br><?php echo $row['pmName']; ?><br><br>

                                                    <label><strong>Shipping Date </strong>&nbsp;</label><br><?php echo $row['shipDate']; ?><br><br>

                                                    <label><strong>Shipping Time </strong>&nbsp;</label><br><?php echo $row['timeRange']; ?><br><br>
                                            
                                                    <form action="" method="post"> 
                                                        <label><strong>Order Status</strong></label> <select name="status" id="status">
                                                            <?php  
                                                                $res3=mysqli_query($conn,"select * from orderstatus");
                                                                while($row3=mysqli_fetch_assoc($res3)){
                                                             ?>
                            
                                                            <option value="<?php echo $row3['osID']; ?>" <?php if($row['status']==$row3['osID']){?> selected <?php } ?> ><?php echo $row3['osName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <br><br>
                                                        <input type="submit" class="btn btn-primary" value="Update" name="updstatus">
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <div id="address" class="bg-light rounded mt-3">
                                            <div class="h5 font-weight-bold text-primary"> Shipping Detail </div>
                                            <div class="d-md-flex justify-content-md-start align-items-md-center pt-3">
                                                <div class="mr-auto"> <b>Address</b>
                                                    <p class="text-justify"><?php echo $row['street']; ?></p>
                                                    <p class="text-justify "><?php echo $row['postcode']." ".$row['city']; ?></p>
                                                    <p class="text-uppercase"><?php echo $row['state']; ?></p>
                                                </div>
                                                <div class="rounded py-2 px-3" id="register"> <a href="#"> <b>Contact Detail</b> </a>
                                                    <p class="text-justify"><strong>Name : </strong><?php echo $row['receiverName']; ?></p>
                                                    <p class="text-justify "><strong>Phone No : </strong><?php echo $row['receiverPhoneNo'];?></p>
                                            
                                                </div>
                                            </div>
                                        </div>
                                        <div id="address" class="bg-light rounded mt-3">
                                            <div class="h5 font-weight-bold text-primary">Customer Detail </div>
                                            <div class="d-md-flex ">
                                                <div class="mr-auto">
                                                        <label><strong>ID : </strong>&nbsp;</label><?php echo $row['cusID']; ?><br>

                                                        <label><strong>First Name : </strong>&nbsp;</label><?php echo $row['cusFName']; ?><br>

                                                        <label><strong>Email : </strong>&nbsp;</label><?php echo $row['cusEmail']; ?><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-8 col-sm-10 offset-lg-0 offset-md-2 offset-sm-1 pt-lg-0 pt-3">
                                        <div id="cart" class="bg-white rounded">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="h6">Order Summary</div>
                                            </div>

                                            <ul class="list-product-order">
                                            <?php
                                                $res=mysqli_query($conn,"SELECT * FROM orderdetail inner join product on product.productID=orderDetail.productID where orderID=$oid");
                                                $countP=mysqli_num_rows($res);
                                                if(mysqli_num_rows($res)>0){
                                                    while($row1=mysqli_fetch_assoc($res)){?>
                                                    <div class="product-item-order">
                                                        <div class="d-flex jusitfy-content-between align-items-center pt-3 pb-2 border-bottom">
                                                <div class="item pr-2"> <img src="<?php echo $row1['pImage1']; ?>" alt="" width="80" height="80">
                                                </div>
                                                <div class="d-flex flex-column px-3"> 
                                                        <div class="product-order-inner">
                                                            <h5 class="product-name">
                                                            <?php echo $row1['pName']; ?>
                                                            </h5>
                                                            <?php if(!empty($row1['discount'])){?>
                                                            <del style="color:#929292">RM <?php echo number_format($row1['price_used'],2) ?></del>
                                                            <span>RM <?php echo $row1['oDPrice'] ?></span><br>
                                                            <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; margin-left:5px;" >
                                                            <?php echo $row1['discount']." % OFF"; ?>
                                                            </span>
                                                            <?php }else{ ?>
                                                                <span>RM <?php echo number_format($row1['oDPrice'],2); ?> </span>
                                                        <?php } ?>
                                                            <br>
                                                            <span class="attributes-select attributes-color">Quantity: <?php echo $row1['qty']; ?></span>
                                                        </div>
                                                </div>
                                                            <div class="ml-auto">RM&nbsp;<?php echo number_format($row1['oDttl'],2); ?> </div>
                                                            </div>    
                                                        </div>
                                                        <hr>
                                                <?php }?>
                                                
                                            <?php }
                                            ?>  
                                        </ul>
                                            <div class="my-3"></div>
                                            <div class="d-flex align-items-center">
                                                <div class="display-5">Subtotal</div>
                                                <div class="ml-auto font-weight-bold">RM <?php echo $row['ttlorder'];?></div>
                                            </div>
                                            <div class="d-flex align-items-center py-2 border-bottom">
                                                <div class="display-5">Shipping</div>
                                                <div class="ml-auto font-weight-bold">RM <?php echo $row['shipping_fee'];?></div>
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <div class="display-5">Total</div>
                                                <div class="ml-auto d-flex">
                                                    <div class="font-weight-bold">RM  <?php echo $row['totalPrice'];?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                
                            </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php 
    include('partials/footer.php');
    require('alert2.php');
?>

<?php 
    if(isset($_POST['updstatus'])){

        $currentDateTime = date('Y-m-d H:i:s');
        $currentDateTime=mysqli_real_escape_string($conn,$currentDateTime);
        $res7=mysqli_query($conn,"update orderp set status='".$_POST['status']."',updated_Time='$currentDateTime' where orderID='$oid'");
        if(mysqli_affected_rows($conn)>0){

            $_SESSION['success']="Update Succesfully!";
            header("Refresh:0");

        }
    }
?>