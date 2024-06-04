<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<link rel="icon" type="image" href="assets/images/favicon.png">
<script src="../js/sweetalert2.all.min.js"></script>
<?php include('../config/connect.php'); ?>
<?php 
	if(isset($_SESSION['user'])){
		$rescheck=mysqli_query($conn,"SELECT * from customer where cstatus=1 and cusID='".$_SESSION['user']."'");
		if(mysqli_num_rows($rescheck)!=1){
			unset($_SESSION['user']);
			$_SESSION['inactive']="Your account is inactive!";
			header("location:".SITEURL."user/login-register.php");
		}
	}
?>

<script>
    $("input").keyup(function() {
    if($(this).val().length >= 1) {
      var input_flds = $(this).closest('form').find(':input');
      input_flds.eq(input_flds.index(this) + 1).focus();
    }
});
</script>
<style>
.container {
    width: 100%;
    background-color: #fff;
    padding-top: 100px;
    padding-bottom: 100px
}

.card {
    background-color: #fff;
    width: 60%;
    border-radius: 15px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

.name {
    font-size: 15px;
    color: #403f3f;
    font-weight: bold
}

.cross {
    font-size: 11px;
    color: #b0aeb7
}

.pin {
    font-size: 14px;
}

.first {
    border-radius: 8px;
    border: 1.5px solid #78b9ff;
    color: #000;
    background-color: #eaf4ff
}

.second {
    border-radius: 8px;
    border: 1px solid #acacb0;
    color: #000;
    background-color: #fff
}

.head {
    font-size: 12px
}

.dollar {
    font-size: 18px;
}

.amount {
    font-weight: bold;
    font-size: 18px
}

.form-control {
    font-size: 18px;
    font-weight: bold;
    width: 60px;
    height: 28px
}

.back {
    color: #aba4a4;
    font-size: 15px;
    line-height: 73px;
    font-weight: 400
}

.button {
    width: 150px;
    height: 60px;
    border-radius: 8px;
    font-size: 17px
}

input[type=password] {
    padding: 10px;
    border: 1px solid #ddd;
    width: 50px;
    height: 50px;
    text-align: center;
    font-size: 30px;
}
</style>
<?php
    //set only had paymentid then can acess this site
    if($_GET['payID']){
        //check if payID is exist and it haven't paid and order status is to pay and payment method is wallet
        $res=mysqli_query($conn,"SELECT * FROM payment,orderp where payment.orderID=orderp.orderID and paymentID='".$_GET['payID']."' and status=1 and cusID='".$_SESSION['user']."' and pmID=2 limit 1");
        if(mysqli_num_rows($res)==1){ 
            $row=mysqli_fetch_assoc($res);
            //payID is exist and it haven't paid and order status is to pay ?>
            <div class="container d-flex justify-content-center mt-5">
        <div class="card">
            <div>
                <div class="d-flex pt-3 pl-3">
                    <div class="mt-3 pl-2"><span class="name">Wallet Payment</span>
                    </div>
                </div>
                <div class="py-2 px-3">
                    <div class="second pl-2 d-flex py-2">
                        <div class="border-left pl-2"><span class="head">Total amount : </span>
                            <div><span class="dollar">RM </span><span class="amount"><?php echo $row['totalPrice']; ?></span></div>
                        </div>
                    </div>
                </div>
                <form method="post">
                    <div class="py-2 px-3">
                        <div class="second pl-2 d-flex py-2">
                            <div class="border-left pl-2"><span class="head">Enter Pin</span>
                            <p>
                                <input type="password" maxlength="1" name="v1" required pattern="[0-9]{1}"/>
                                <input type="password" maxlength="1" name="v2" required pattern="[0-9]{1}"/>
                                <input type="password" maxlength="1" name="v3" required pattern="[0-9]{1}"/>
                                <input type="password" maxlength="1" name="v4" required pattern="[0-9]{1}"/>
                                <input type="password" maxlength="1" name="v5" required pattern="[0-9]{1}"/>
                                <input type="password" maxlength="1" name="v6" required pattern="[0-9]{1}"/>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-3 pt-4 pb-3">
                        <div></div><input class="btn  button"  type="submit" value="Pay Now" name="paywallet"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
            


    <?php   }else{
            header("location: 404page.php");
        }

    }else{
        header("location: 404page.php");
    }

?>

<?php

    if(isset($_POST['paywallet'])){

        $pin=$_POST['v1'].$_POST['v2'].$_POST['v3'].$_POST['v4'].$_POST['v5'].$_POST['v6'];

        $res1=mysqli_query($conn,"SELECT * FROM customer where cusID='".$_SESSION['user']."'");
        $row1=mysqli_fetch_assoc($res1);

        if(password_verify($pin, $row1['wPin'])){
            //pin correct 
            //update table payment
            $res2=mysqli_query($conn,"UPDATE payment set payDay=NOW() where paymentID='".$_GET['payID']."' and pAmount<=(SELECT walletAmount from customer where cusID='".$_SESSION['user']."')");
            if(mysqli_affected_rows($conn)>0){
                //if updated
                //update transaction
                $res3=mysqli_query($conn,"INSERT into wallettransaction (transAmount,transName,status,cusID,paymentID) values ('".$row['totalPrice']."','Payment','1','".$_SESSION['user']."','".$_GET['payID']."')");
                if(mysqli_affected_rows($conn)>0){
                    //update wallet amount
                    $res2=mysqli_query($conn,"UPDATE customer set walletAmount=walletAmount-(SELECT pAmount from payment where paymentID='".$_GET['payID']."') where cusID='".$_SESSION['user']."' and walletAmount>=(SELECT pAmount from payment where paymentID='".$_GET['payID']."')");
                    if(mysqli_affected_rows($conn)>0){
                        $res2=mysqli_query($conn,"UPDATE orderp set status=2, updated_Time=current_timestamp where cusID='".$_SESSION['user']."' and orderID=(SELECT orderID from payment where paymentID='".$_GET['payID']."')");
                        $res2=mysqli_query($conn,"UPDATE payment set payDay=current_timestamp where paymentID='".$_GET['payID']."'");
                        header("location: paymentsuccess.php");
                    }else{
                        echo "<script type='text/JavaScript'>
                        swal.fire('Error!', 'wallet', 'error');
                        </script>";
                    }
                }else{
                    echo "<script type='text/JavaScript'>
                    swal.fire('Error!', 'trans', 'error');
                    </script>";
                }
                
            }else{
                echo "<script type='text/JavaScript'>
                swal.fire('Error!', 'Payment', 'error');
                </script>";
            }
            

        }else{
            echo "<script type='text/JavaScript'>
            swal.fire('Error!', 'Your Pin is invalid! Please Try Again', 'error');
            </script>";
        }
    }
?>

