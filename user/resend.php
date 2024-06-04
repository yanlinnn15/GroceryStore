<?php include('partials_front/header.php');?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
    .swal2-popup { width:500px;
		font-size:16px;
	 }
</style>
<?php
    if(isset($_POST['resendemail'])){
        $secret="6LfZShkcAAAAAJ420tI4s4rLMwwlxk7PFo4_rUnW";
		$response=$_POST['g-recaptcha-response'];
		$remoteip = $_SERVER['REMOTE_ADDR'];
		$url ="https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
		$data = file_get_contents($url);
		$row=json_decode($data,true);

        //if human verification is success
		if($row["success"]==false){
			$human_error1=" Human Verification is Needed";
		}

        if(isset($_POST['email']) && empty($human_error1)){
            $sql="SELECT * FROM customer where cusEmail='".$_POST['email']."' LIMIT 1";
            $res=mysqli_query($conn,$sql);
            if($res){
                if(mysqli_num_rows($res)==1){
                    while($row1=mysqli_fetch_assoc($res)){
                        $v=$row1['verified'];
                        $id=$row1['cusID'];
                        $fname=$row1['cusFName'];
                    }

                    if($v==0){
                        $vkey=md5($_POST['email'].time());
                        $current=date('Y-m-d H:i');
                        $expire_date = date('Y-m-d H:i',strtotime('+10 minutes',strtotime($current)));

                        $sql1="UPDATE CUSTOMER SET 
                        vkey='$vkey',
                        vkeyexpired='$expire_date'
                        where cusID='$id'
                        ";

                        $res1=mysqli_query($conn,$sql1);

                        if($res1){
                            $to=$_POST['email'];
                            $subject="Email Verification";
                            $message="
                                Hi $fname,<br>

                                We just need to verify your email address before you can access to FreshGrocers.<br>
                        
                                Verify your email address by <a href='http://localhost/onlinegrocery/user/reg_verify.php?vkey=$vkey'>Click Me</a><br>
                                Verification Link will be vaild for 10 minutes.
                        
                                Thanks! &#8211; FreshGrocers<br>
                            ";
                            $headers ="From: ffreshgrocers@gmail.com \r\n";
                            $headers = "MIME-Version: 1.0" . "\r\n"; //set content type when sending html email
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                            mail($to,$subject,$message,$headers);

                            $_SESSION['resend']="success";
                        }

                    }else{
                        $_SESSION['resend']="verified";
                    }
                }else{
                    $_SESSION['resend']="notexist";
                }
            }
        }
    }
?>
<div class="main-content main-content-login">
	<div class="container">
    <?php 
                        if(isset($_SESSION['resend'])){

                            if($_SESSION['resend']=="success"){ ?>
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Your verification email sent!',
                                        text: 'Click the link that send to you email to verify your account!',
                                    });
                                </script>

                            <?php }else if($_SESSION['resend']=="verified"){ ?>

                                <script>
                                    Swal.fire({
                                        title: '<strong>Your account had verified</strong>',
                                        icon: 'info',
                                        html:
                                            'Sign In now! &nbsp' +
                                            '<a href="login-register.php"><strong>Sign in</strong></a> ',
                                        showCloseButton: true,
                                        focusConfirm: false,
                                        confirmButtonText:
                                            '<i class="fa fa-thumbs-up"></i> OK!'
                                    });
                                </script>
                            <?php }else{ ?>
                                    <script>
                                        Swal.fire({
                                            title: '<strong>Your account not exist</strong>',
                                            icon: 'info',
                                            html:
                                                'Register now! &nbsp ' +
                                                '<a href="login-register.php"><strong>Register</strong></a> ',
                                            showCloseButton: true,
                                            focusConfirm: false,
                                            confirmButtonText:
                                                '<i class="fa fa-thumbs-up"></i> OK!'
                                        });

                                    </script>
                                   
                           <?php }

                           unset($_SESSION['resend']);

                        }
                    ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-trail breadcrumbs">
					<ul class="trail-items breadcrumb">
						<li class="trail-item trail-begin">
							<a href="index.php">Home</a>
						</li>
						<li class="trail-item trail-end active">
							Resend Verification Email
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="site-main">
					<h3 class="custom_blog_title">
                        Resend Verification Email
					</h3>
					<div class="customer_login">
						<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-top:20px; padding-bottom:20px;">
                                <p class="form-row form-row-wide">
                                <strong>Why I can't get the verification email ?</strong>
                                <ul>   
                                    <li>Make sure your email address is correct</li>
                                    <li>Please check your SPAM or JUNK Folder</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <form class="login" method="POST">
                            <p class="form-row form-row-wide">
                                <label class="text">Email*</label>
                                <input title="email" name="email" type="email" class="input-text" required>
                            </p>
                            <p class="form-row form-row-wide">
                                <div class="g-recaptcha" data-sitekey="6LfZShkcAAAAADGhja_0ZFbRdhkIUbL6e0TPIY0c"></div>
                                <?php if(isset($human_error1)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $human_error1; ?></div>
                                <?php } ?>
							</p>
                            <p>
                            <input type="submit" class="button-submit" value="Resend" name="resendemail" style="margin-right: 100px;">
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
</div>

<?php include('partials_front/footer.php');?>