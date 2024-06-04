<?php include('partials_front/header.php');?>
<style>
    form i {
    margin-left: -30px;
    cursor: pointer;
}
</style>

<?php 
function iPass($str){
    $c=0;
    if(preg_match('/[_|\-|+|\|=|*|!|@|#|$|%|^|~|&|(|)]+/',$str)) $c++;
    if(preg_match('/\d/',$str)) $c++;
    if(preg_match('/[A-Z]/',$str)) $c++;
    if(preg_match('/[a-z]/',$str)) $c++;

    $x=strlen($str);
    if(strlen($str)>=8 && $c==4){
        return true;
    }else return false;
}

if(isset($_GET['request'])){
    $request=$_GET['request'];

    $sql="SELECT * from customer where vkey='$request' limit 1";
    $res=mysqli_query($conn,$sql);
    if($res){
        if(mysqli_num_rows($res)==1){
            //vkey exist
            while($row=mysqli_fetch_assoc($res)){
                $v=$row['verified'];
                $expired=$row['vkeyexpired'];
                $id=$row['cusID'];
            }
            //bcs using same column so need to make sure 
            if($v==1){
                //check verify
                $current=date('Y-m-d H:i:s');
                if($expired>=$current){
                    //haven't expired
                    if(isset($_POST['resetpassword'])){

                        $np = $_POST['np'];
                        $cnp = $_POST['cnp'];

                        $sql2="Select passw from customer where cusID='$id'";
                        $res2=mysqli_query($conn,$sql2);
                        $row=mysqli_fetch_assoc($res2);
                        
                        if(password_verify($np,$row['passw'])){
                            $pass_error="Your password cannot be same with the current password.";
                        }

                        if(!(iPass($np))){
                            $pass_error="Your password must be at least 8 character [Special character, Capital and small letter, Number]";
                        }

                        if($np != $cnp){
                            $pass_error1="Your password must be same with the confirm password!";
                        }
                        
                        if(!isset($pass_error) && !isset($pass_error1)){
                            $current1=date('Y-m-d H:i:s');
                            $np=mysqli_real_escape_string($conn,$np);
                            $np=password_hash($np,PASSWORD_DEFAULT,['cost' => 15]);
                            
                            $sql="UPDATE customer set passw='$np', vkeyexpired='$current1' where cusID='$id'";
                            $res=mysqli_query($conn,$sql);
                            if($res){
                                $_SESSION['resetpass']="success";
                            }else{
                                $_SESSION['resetpass']= "error";
                            }
                        }
                    }
                }else{
                    $_SESSION['expired']="Reset Password Link expired!";
                    header('location:'.SITEURL."user/forgotpass.php");
                }
            }else{
                $_SESSION['resetpass']="notv";
            }
        }else{ //not exist
            header("location:".SITEURL."user/404page.php");
        }
    }else{
        echo "error";
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
							Reset Password
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
            
			<div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="site-main">
					
					<h3 class="custom_blog_title">
                        RESET PASSWORD
					</h3>
					<div class="customer_login">
						<div class="row">
                            <div class="col-lg-10 col-md-12 col-sm-8">
                            <form class="login" method="POST">
                            <p class="form-row form-row-wide">
                                <label class="text">New Password* (Your password must be at least 8 character [Special character, Capital and small letter, Number])</label>
                                <input title="new password" name="np" type="password" class="input-text" id="password" required>
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                                <?php if(isset($pass_error)){?>
                                <div class="error fa fa-exclamation-triangle"><?php echo $pass_error; ?></div>
                                <?php } ?>
                            </p>
                            <p class="form-row form-row-wide">
                                <label class="text">Confirm New Password*</label>
                                
                                <input title="new password" name="cnp" type="password" class="input-text" id="password1" required>
                                <i class="bi bi-eye-slash" id="togglePassword1"></i>
                                <?php if(isset($pass_error1)){?>
                                <div class="error fa fa-exclamation-triangle"><?php echo $pass_error1; ?></div>
                                <?php } ?>
                            </p>
                            <p>
                            <input type="submit" class="button-submit" value="Reset Password" name="resetpassword" style="margin-right: 100px;">
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
if(isset($_SESSION['resetpass'])){

    if($_SESSION['resetpass']=="success"){ ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Your password changed successful!',
                html:
                    'Login Now!&nbsp' +
                    '<a href="login-register.php"><strong><u>Click me</u></strong></a> ',
            });
        </script>

    <?php }else if($_SESSION['resetpass']=="error"){ ?>

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong...',
            });
        </script>
    <?php }else{ ?>
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
            
    <?php }

    unset($_SESSION['resetpass']);

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
</script>