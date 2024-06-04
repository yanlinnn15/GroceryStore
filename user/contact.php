<?php include('partials_front/header.php'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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

<?php
	if(isset($_POST['sendcontact'])){
        $secret="6LfZShkcAAAAAJ420tI4s4rLMwwlxk7PFo4_rUnW";
		$response=$_POST['g-recaptcha-response'];
		$remoteip = $_SERVER['REMOTE_ADDR'];
		$url ="https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
		$data = file_get_contents($url);
		$row=json_decode($data,true);

        //if human verification is success
		if($row["success"]==false){
			$human_error1="This is Needed!";
		}

        $name=$_POST['your-name'];
        $email=$_POST['your-email'];
        $phone=$_POST['your-phone'];
        $message=$_POST['your-message'];

        
		if(empty($human_error1)){
            $name=mysqli_real_escape_string($conn,$name);
			$email=mysqli_real_escape_string($conn,$email);
            $phone=mysqli_real_escape_string($conn,$phone);
            $message=mysqli_real_escape_string($conn,$message);
			$sql7="INSERT INTO contact (email,pNum,cname,cmessage) values ('$email','$phone','$name','$message')";
			$res7=mysqli_query($conn,$sql7);

            if(mysqli_affected_rows($conn)>0){
                $_SESSION['success']="Message Sent!";
            }else{
                $_SESSION['fail']="Something went wrong!";
            }

        }
	}
?>
<div class="main-content main-content-contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            Contact us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-contact col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">Contact us</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-main-content">
        <div class="google-map">
                <iframe width="100%" height="400" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.458823919472!2d103.76182875537324!3d1.4957617994386048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da6d3d540d2117%3A0xb74365f4b66ec5cd!2s50%2C%20Jalan%20Kemunting%2C%20Taman%20Kebun%20Teh%2C%2080250%20Johor%20Bahru%2C%20Johor!5e0!3m2!1sen!2smy!4v1636672259402!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-contact">
                        <div class="col-lg-8 no-padding">
                            <div class="form-message">
                                <h2 class="title">
                                    Send us a Message!
                                </h2>
                                <form method="post" class="gnash-contact-fom">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>
                                                <span class="form-label">Your Name *</span>
                                                <span class="form-control-wrap your-name">
														<input title="your-name" type="text" name="your-name" size="40"
                                                               class="form-control form-control-name" required>
													</span>
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p>
													<span class="form-label">
														Your Email *
													</span>
                                                <span class="form-control-wrap your-email">
														<input title="your-email" type="email" name="your-email" size="40"
                                                               class="form-control form-control-email" required>
													</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>
                                                <span class="form-label">Phone *</span>
                                                <span class="form-control-wrap your-phone">
														<input title="your-phone" type="text" name="your-phone"
                                                               class="form-control form-control-phone" required pattern="[0-9]{3}-[0-9]{3}[0-9]{4,5}">
													</span>
                                            </p>
                                        </div>
                                    </div>
                                    <p>
											<span class="form-label">
												Your Message *
											</span>
                                        <span class="wpcf7-form-control-wrap your-message">
												<textarea title="your-message" name="your-message" cols="40" rows="9"
                                                          class="form-control your-textarea" required></textarea>
											</span>
                                    </p>
                                    <p class="form-row form-row-wide">
											<div class="g-recaptcha" data-sitekey="6LfZShkcAAAAADGhja_0ZFbRdhkIUbL6e0TPIY0c" required></div>
											<?php if(isset($human_error1)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $human_error1; ?></div>
											<?php } ?>
										</p>
                                    <p>
                                        <input type="submit" value="SEND MESSAGE" name="sendcontact"
                                               class="form-control-submit button-submit">
                                    </p>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 no-padding">
                            <div class="form-contact-information">
                                <form action="#" class="gnash-contact-info">
                                    <h2 class="title">
                                        Contact information
                                    </h2>
                                    <div class="info">
                                        <div class="item address">
												<span class="icon">
													
												</span>
                                            <span class="text">
                                                50, Jalan Kemunting, Taman Kebun Teh, 80250 Johor Bahru, Johor
												</span>
                                        </div>
                                        <div class="item phone">
												<span class="icon">
													
												</span>
                                            <span class="text">
													(+60) 16 612 2132
												</span>
                                        </div>
                                        <div class="item email">
												<span class="icon">
													
												</span>
                                            <span class="text">
													ffreshgrocers@gmail.com
												</span>
                                        </div>
                                    </div>
                                    <div class="socials">
                                        
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

<?php include('partials_front/footer.php'); ?>

<?php
    if(isset($_SESSION['fail'])){ ?>
            <script>
   
                Swal.fire(
                    'Error',
                    '<?php echo $_SESSION['fail'];?>',
                    'error'
                );

            </script>
        <?php 
            unset($_SESSION['fail']);
} ?>


<?php
    if(isset($_SESSION['success'])){ ?>
            <script>
   
                Swal.fire(
                    'Successful!',
                    '<?php echo $_SESSION['success'];?>',
                    'success'
                );

            </script>
        <?php 
            unset($_SESSION['success']);
} ?>