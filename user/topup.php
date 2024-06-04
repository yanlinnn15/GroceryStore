<?php include('account-sidebar.php');?>
<style>
    .cus .row{
        margin-bottom: 30px;
    }
</style>

<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <div class="custom_blog_title">
                        <a href="wa.php" class="fa fa-chevron-circle-left" style="margin-left:20px;" data-toggle="popover" title="Back" data-content="BACK"></a>
                        Top Up
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-7" style="margin-top: -20px;">
                    <form action="" class="myaccount-form" method="post">
                        <div>
                            <span>Top Up Amount (RM) : </span>
                            <p style="font-size: 14px; color:orange; float:right">(Min RM 10.00)</p>
                        </div>

                        <div class="single-input">
                            <input type="number" min="10" step='0.01' placeholder="10.00" style="width: 80%;" name="amount"/></p>
                        </div>
                        

                        <p>
                        <div class="checkout-form-steps">
                            <span>Payment Method : Credit/ Debit Card</span>
                        </div>
                        </p>

                        <div>
                            <input type="submit" value="Continue" style="width: 100%;" name="topup"/>
                        </div>
                    </form>
                    </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
    


<?php include('partials_front/footer.php'); ?>

<?php 
    if(isset($_SESSION['fail'])){
        echo "<script type='text/JavaScript'>
        swal.fire('".$_SESSION['fail']."');
        </script>";
        unset($_SESSION['fail']);
    }

?>

<?php

    if(isset($_POST['topup'])){
        $amount=number_format($_POST['amount'], 2, '.', '');

        $res=mysqli_query($conn,"INSERT into wallettransaction (transAmount,transName,cusID) values($amount,'Topup','".$_SESSION['user']."')");
        $transid = mysqli_insert_id($conn);
        if(!empty($transid)){
            header("location: creditcardpayment.php?top=$transid");
        }else{
            $_SESSION['fail']="Something went wrong...";
        }

    }

?>


