<?php include('partials_front/header.php');?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
    if(isset($_POST['resetpass'])){
        $email=$_POST['email'];

        $sql="Select * from customer where cusEmail='$email' Limit 1";
        $res=mysqli_query($conn,$sql);

        //account exist
        if(mysqli_num_rows($res)==1){
            while($row=mysqli_fetch_assoc($res)){
                $id=$row['cusID'];
                $fname=$row['cusFName'];
                $v=$row['verified'];
                $status=$row['cstatus'];
            }
            if($status==1){
                if($v==1){
                    $vkey=md5(rand()+time()+$id);
                    $current=date('Y-m-d H:i:s');
                    $expire_date = date('Y-m-d H:i:s',strtotime('+10 minutes',strtotime($current)));
    
                    $sql1="UPDATE CUSTOMER SET 
                    vkey='$vkey',
                    vkeyexpired='$expire_date'
                    where cusID='$id'
                    ";
    
                    $res1=mysqli_query($conn,$sql1);
                    
                    if($res1){
                        $to =$email;
                        $subject="Reset Password";
                        $message="
                        Hi $fname,<br>
    
                        <br>Forgot Password?<br>
                        We received your request to reset your password.<br><br>
                
                        To reset password <a href='http://localhost/onlinegrocery/user/resetpass.php?request=$vkey'>Click Me</a><br>
                        This link will valid for 10 minutes. <br>
                
                        Thanks! &#8211; FreshGrocers<br>
                        ";
                        $headers ="From: ffreshgrocers@gmail.com \r\n";
                        $headers = "MIME-Version: 1.0" . "\r\n"; //set content type when sending html email
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
                        mail($to,$subject,$message,$headers);
                        $_SESSION['fgpass']="success";
    
                    }else{
                        echo "Something went wrong";
                    }
                }else{
                    $_SESSION['fgpass']="notv";
                }
    
                }else{
                    //account not exist
                    $_SESSION['fgpass']="notreg";
                }
            }else{
                $_SESSION['inactive']="Your account is inactive!";
            }
    }
?>

<div class="main-content main-content-login">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-trail breadcrumbs">
					<ul class="trail-items breadcrumb">
						<li class="trail-item trail-begin">
							<a href="index.php">Home</a>
						</li>
						<li class="trail-item trail-end active">
							Forgot Password
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
            
			<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="site-main">
					
					<h3 class="custom_blog_title">
						Forgot Password
					</h3>                   
					<div class="customer_login">
						<div class="row">
                            <div class="col-lg-10 col-md-12 col-sm-8">
                            <form class="login" method="POST">
                            <p class="form-row form-row-wide">
                                <label class="text">Email*</label>
                                <input title="email" name="email" type="email" class="input-text" required>
                            </p>
                            <p>
                            <input type="submit" class="button-submit" value="Reset Password" name="resetpass" style="margin-right: 100px;">
							</p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?php include('partials_front/footer.php');?>
<?php 
if(isset($_SESSION['fgpass'])){

    if($_SESSION['fgpass']=="success"){ ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Reset password email sent!',
                text: 'Click the link that sent to your email to reset password!',
            });
        </script>

    <?php }else if($_SESSION['fgpass']=="notv"){ ?>

        <script>
            Swal.fire({
                title: "<strong>Your account haven't verify!</strong>",
                icon: 'info',
                html:
                    'Verified Now!&nbsp' +
                    '<a href="resend.php"><strong><u>Click me</u></strong></a> ',
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText:
                    'OK!'
            });
        </script>
    <?php }else{ ?>
            <script>
                Swal.fire({
                    title: '<strong>Your account not exist</strong>',
                    icon: 'info',
                    html:
                        'Register now!&nbsp' +
                        '<a href="login-register.php"><strong><u>Register</u></strong></a> ',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                        'OK!'
                });

            </script>
            
    <?php }

    unset($_SESSION['fgpass']);
}
?>
<?php 
if(isset($_SESSION['expired'])){ ?>
    <script>
    Swal.fire('Your Reset Password Link Expired. Try Again!');
    </script>
<?php unset($_SESSION['expired']);} ?>

<?php if(isset($_SESSION['inactive'])){

?><script>
    Swal.fire({
    icon: 'error',
    html:
    '<?php echo $_SESSION['inactive']; ?>!',
    showCloseButton: true,
    focusConfirm: false,
    confirmButtonText:
    'Ok!',
});	
</script>

<?php

unset($_SESSION['inactive']);
} 
?>