<?php include("../config/connect.php"); ?>
<?php include('partials_front/loginCheck.php'); ?>
<head>
	 <link rel="icon" type="image" href="assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="assets/css/jquery.scrollbar.min.css">
    <link rel="stylesheet" href="assets/css/mobile-menu.css">
    <link rel="stylesheet" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/card.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link href="../user/assets/css/card-js.min.css" rel="stylesheet" type="text/css" />
	<script src="../user/assets/js/card-js.min.js"></script>
	<style type="text/css">
    .my-custom-class {
      border: 1px dashed #f00 !important;
    }
  </style>
</head>


<?php
    if(isset($_GET['top']) || isset($_GET['payID'])){ 
        
    if(isset($_GET['top'])){
        $c=0;

        $res=mysqli_query($conn,"SELECT * FROM wallettransaction where transID='".$_GET['top']."' and status='0' and cusID='".$_SESSION['user']."'");
        if(mysqli_num_rows($res)>0){
            $c=1;
        }

    }

    if(isset($_GET['payID'])){
        $c=0;

        $res=mysqli_query($conn,"SELECT * FROM payment,orderp where paymentID='".$_GET['payID']."' and orderp.orderID=payment.orderID and status='1'");
        if(mysqli_num_rows($res)>0){
            $c=1;
        }

    }
    if($c==1){ 
        $row=mysqli_fetch_assoc($res);
        
        ?>
        <div class="container">
                <div class="page-header text-center" style="color:green">
                <i class="fa fa-shield" aria-hidden="true"></i> Your Purchase are protected !
                </div>
                <!-- Credit Card Payment Form - START -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <h3 class="text-center">Payment Details</h3>     
                                </div>
                                <form action="" method="post">
                                    <div class="card-js">
                                        <input class="card-number my-custom-class" required>
                                        <input class="name" id="the-card-name-element" required>
                                        <input class="expiry-month" required>
                                        <input class="expiry-year" required>
                                        <input class="cvc" required>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-xs-12">Amount to pay: <strong><?php if(isset($_GET['top'])){  echo "RM ".$row['transAmount']; }else{ echo "RM ".$row['pAmount'];} ?> </strong> </div><hr>
                                            <div class="col-xs-12"> <button class="btn btn-success btn-lg btn-block" name="confirm">Confirm Payment</button> </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php }else{
        header("location:404page.php");
    }
    ?>

    
    <?php }else{
        header("location:404page.php");
    }
?>

<?php

    if(isset($_POST['confirm'])){
        if(isset($_GET['top'])){
            $id=$_GET['top'];

            $res1=mysqli_query($conn,"UPDATE wallettransaction set status=1 where transID='$id' and status=0");

            if(mysqli_affected_rows($conn)>0){

                $res1=mysqli_query($conn,"UPDATE customer set walletAmount=(walletAmount+(SELECT transAmount from wallettransaction where transID='$id')) where cusID='".$_SESSION['user']."'");
                header("Refresh: 0.5;url=https://localhost/onlinegrocery/user/wa.php");
                $_SESSION['success']="Top Up Successful!";
            }else{
                header("location:404page.php");
            }
        }

        if(isset($_GET['payID'])){

            $id=$_GET['payID'];

            $res1=mysqli_query($conn,"UPDATE orderp set status=2,updated_Time=current_timestamp where orderID=(SELECT orderID FROM payment where paymentID='$id') and status=1");
            $res2=mysqli_query($conn,"UPDATE payment set payDay=current_timestamp where paymentID='$id'");

            if(mysqli_affected_rows($conn)>0){
                header("Refresh: 0.5;url=paymentsuccess.php");
            }else{
                header("location:404page.php");
            }




        }
    }
?>