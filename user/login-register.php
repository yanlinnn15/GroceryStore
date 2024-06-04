<?php 
	include('partials_front/header.php');
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php if(isset($_SESSION['user'])){
	header('location:'.SITEURL."user/index.php");
}?>

<?php
	if(isset($_POST['user-login'])){
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

        $Lemail=$_POST['email'];
        $Lpass=$_POST['password'];

		if(empty($human_error1)){
            $Lemail=mysqli_real_escape_string($conn,$Lemail);
			$Lpass=mysqli_real_escape_string($conn,$Lpass);
			$sql7="SELECT * FROM customer where cusEmail='$Lemail'";
			$res7=mysqli_query($conn,$sql7);
			//check return row
			if(mysqli_num_rows($res7)==1){ //gmail exist
				while($row = mysqli_fetch_assoc($res7)) {
					$id=$row['cusID'];
					$verified=$row['verified'];
					$status=$row['cstatus'];
					$dbpass=$row['passw'];
				}
				if($verified==1){
					if($status==1){
						if(password_verify($Lpass, $dbpass)){
							$_SESSION['user']=$id;  //check user is login or not and logout will unset
							header("location:".SITEURL."user/index.php");
						}else{
							$error1=" Login Failed! Your Password or Email is invalid !";
						}
					}else{
						$error1=" Your account is inactive!";
					}
				}else{
					$error2=" Your email haven't verify <a href='resend.php' style='color: #8eb359;'>Click Me</a> to resend verification email.";
				}
			}else{
				$error1=" Login Failed! Your Password or Email is invalid !";
			}
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
							Authentication
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="site-main">
					
					<h3 class="custom_blog_title">
						Authentication
					</h3>
					<div class="customer_login">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="login-item">
									<h5 class="title-login">Login your Account</h5>
									<form class="login" method="POST">
										<div class="form-row form-row-wide">
											<?php
												if(!(isset($Lemail))){ $Lemail="";}
												if(isset($error2)){ ?>
												<div class="error1 fa fa-exclamation-triangle"><?php echo $error2; ?></div>
												<?php } ?>
										
											<?php if(isset($error1)){?>
												<div class="error1 fa fa-exclamation-triangle"><?php echo $error1; ?></div>
											<?php } ?>
										</div>
										
										<p class="form-row form-row-wide">
											<label class="text">Email*</label>
											<input title="email" name="email" type="email" class="input-text" required value="<?php echo htmlspecialchars($Lemail) ?>">
										</p>
										<p class="form-row form-row-wide">
											<label class="text">Password*</label>
											<input title="password" name="password" type="password" id="password" class="input-text" required>
											<i class="bi bi-eye-slash" id="togglePassword"></i>
										</p>
										<p class="lost_password">
											<a href="forgotpass.php" class="forgot-pw">Forgot password?</a>
										</p>
										<p class="form-row form-row-wide">
											<div class="g-recaptcha" data-sitekey="6LfZShkcAAAAADGhja_0ZFbRdhkIUbL6e0TPIY0c"></div>
											<?php if(isset($human_error1)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $human_error1; ?></div>
											<?php } ?>
										</p>
										<p class="form-row">
											<input type="submit" class="button-submit" value="Login" name="user-login">
										</p>
									</form>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="login-item">
									<h5 class="title-login">Register now</h5>
									<form class="register" method="POST" action="register.php">
										<?php if(!(isset($fname)) && !(isset($lname)) && !(isset($email))){ $fname=$lname=$email="";} ?>
										<?php
												if(isset($_SESSION['signup'])){ ?>
													<script>
													Swal.fire({
														title: '<strong>A verification email has been sent to your email account</strong>',
														icon: 'success',
														html:
														'Please click on the link that sent to your email account to verify your email!<br>',
														showCloseButton: true,
														focusConfirm: false,
														confirmButtonText:
														'Great!',
														footer: ' Not received email?&nbsp<a href="resend.php" style="color: #8eb359;"><strong>Click Me</strong></a>',
													});	
													</script>
																									
													<?php unset($_SESSION['signup']);
												}

												if(isset($_SESSION['exist'])){ ?>
													<script>
													Swal.fire({
														title: 'Your account already existed',
														icon: 'info',
														html:
														'Login Now!',
														showCloseButton: true,
														focusConfirm: false,
														confirmButtonText:
														'Ok!',
													});	
													</script>
																									
													<?php unset($_SESSION['exist']);
												}


										?>
										<p class="form-row form-row-wide">
											<label class="text">First Name *</label>
											<input type="text" class="input-text" name="fname" value="<?php echo htmlspecialchars($fname)?>" required>
											<?php if(isset($fname_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $fname_error; ?></div>
											<?php } ?>
											
										</p>
										<p class="form-row form-row-wide">
											<label class="text">Last Name *</label>
											<input type="text" class="input-text" name="lname" value="<?php echo htmlspecialchars($lname)?>" required>
											<?php if(isset($lname_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $lname_error; ?></div>
											<?php } ?>
								
										</p>
										<p class="form-row form-row-wide">
											<label class="text">Your email *</label>
											<input type="email" class="input-text" name="email" value="<?php echo htmlspecialchars($email)?>" required>
											<?php if(isset($email_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $email_error; ?></div>
											<?php } ?>
								
										</p>
										<p class="form-row form-row-wide">
											<label class="text">Password* <span style="color: orange; font-size:12px;">(At least 8 character [Special Character, Number, Capital and Small Letter])</span></label>
											<input type="password" class="input-text" name="pass" id="password1" required> 
											<i class="bi bi-eye-slash" id="togglePassword1"></i>
											<?php if(isset($pas_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $pas_error; ?></div>
											<?php } ?>
								
										</p>
										
										<p class="form-row form-row-wide">
											<label class="text">Comfirm Password*</label>
											<input type="password" class="input-text" name="cpass" id="password2" required>
											<i class="bi bi-eye-slash" id="togglePassword2"></i>
											<?php if(isset($pas_error1)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $pas_error1; ?></div>
											<?php } ?>
										</p>
										<p class="form-row form-row-wide">
											<div class="g-recaptcha" data-sitekey="6LfZShkcAAAAADGhja_0ZFbRdhkIUbL6e0TPIY0c"></div>
											<?php if(isset($human_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $human_error; ?></div>
											<?php } ?>
										</p>
										<p>
											<input type="submit" class="button-submit" value="Register Now" name="register">
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

<?php include('partials_front/footer.php'); ?>

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

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

<script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});

const togglePassword1 = document.querySelector('#togglePassword1');
const password1 = document.querySelector('#password1');
togglePassword1.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});

const togglePassword2 = document.querySelector('#togglePassword2');
const password2 = document.querySelector('#password2');
togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});
</script>