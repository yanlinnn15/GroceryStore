<?php include('../config/connect.php'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="../js/sweetalert2.all.min.js"></script>
<style>
    .swal2-popup { width:500px;
		font-size:16px;
	 }
</style>
<?php
    if(isset($_POST['resetpass'])){
        $email=$_POST['email'];

        $sql="Select * from admin where email='$email' Limit 1";
        $res=mysqli_query($conn,$sql);

        if($res){
            if(mysqli_num_rows($res)==1){    //account exist
                while($row=mysqli_fetch_assoc($res)){
                    $id=$row['adminID'];
                }
               
                $vkey=md5(rand()+time()+$id);
                $current=date('Y-m-d H:i:s');
                $expire_date = date('Y-m-d H:i:s',strtotime('+10 minutes',strtotime($current)));

                $sql1="UPDATE admin SET 
                vkey='$vkey',
                expdate='$expire_date'
                where adminID='$id'
                ";
    
                $res1=mysqli_query($conn,$sql1);
                    
                if($res1){
                    $to =$email;
                    $subject="Reset Password";
                    $message="
                    Hi,<br>

                    <br>Forgot Password?<br>
                    We received your request to reset your password.<br><br>
            
                    To reset password <a href='http://localhost/onlinegrocery/admin/resetpass.php?request=$vkey'>Click Me</a><br>
                    Link will be valid for 10 minutes.<br><br>
            
                    Thanks! &#8211; FreshGrocers<br>
                    ";
                    $headers ="From: ffreshgrocers@gmail.com \r\n";
                    $headers = "MIME-Version: 1.0" . "\r\n"; //set content type when sending html email
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    mail($to,$subject,$message,$headers);
                    $_SESSION['afgpass']="success";

                }else{
                    $_SESSION['afgpass']="wrong";
                }
            }else{
                $_SESSION['afgpass']="notacc";
            }
    
        }else{
            $_SESSION['afgpass']="wrong";
        }
    }
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Fresh Grocers Admin Login</title>
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
.error1{
    padding: 15px;
    color: #ff4d4d;
    margin-bottom: 5px;
    border-radius: 5px;
    border: 1px solid #ff4d4d;
    font-size: 13px;
}
</style>
<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
        style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                
                </div>
                <div class="col-lg-4 col-md-5 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                        <img src="assets/images/favicon.png" alt="wrapkit" style="width:15%;">
                        </div>
                        <h2 class="mt-3 text-center">Forgot Password</h2>
                        <form class="mt-4" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                       <?php
                                        if(isset($error1)){ ?>
                                            <p class="error1"><?php echo $error1; ?></p>
                                       <?php }
                                       ?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="email">Email</label>
                                        <input class="form-control" name="email" type="text"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark" name="resetpass">Reset Password</button>
                                </div>
                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>
</html>
<?php 
if(isset($_SESSION['afgpass'])){

    if($_SESSION['afgpass']=="success"){ ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Reset password email sent!',
                text: 'Click the link that send to you email to reset password!',
            });
        </script>

    <?php }else if($_SESSION['afgpass']=="notacc"){ ?>

        <script>
            Swal.fire({
                title: "<strong>Sorry! Your account not found!</strong>",
                icon: 'error',
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText:
                    'OK!'
            });
        </script>
    <?php }else{ ?>
            <script>
                Swal.fire({
                    title: 'Something went wrong!',
                    icon: 'error',
                    html:
                        'Try again!!',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                        'OK!'
                });

            </script>
            
    <?php }

    unset($_SESSION['afgpass']);
}
?>
<?php 
if(isset($_SESSION['aexpired'])){ ?>
    <script>
    Swal.fire('Your Reset Password Link Expired. Try Again!');
    </script>
<?php unset($_SESSION['aexpired']);} ?>