<?php include('account-sidebar.php'); ?>
<style>
    form i {
    margin-left: -30px;
    cursor: pointer;
}
</style>

<?php 
    $id=$_GET['id'];

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

    if(isset($_POST['submit'])){
        $cp = $_POST['cp'];
        $np = $_POST['np'];
        $cnp = $_POST['cnp'];

        $sql2="Select passw from customer where cusID='$id'";
        $res2=mysqli_query($conn,$sql2);
        $row=mysqli_fetch_assoc($res2);
        
        //compare old password
        if(password_verify($cp,$row['passw'])==false){
            $pass_error2="Your current password is wrong!";
        }

        if(password_verify($np,$row['passw'])){
            $pass_error="Your password cannot be same with the current password.";
        }

        if(!(iPass($np))){
            $pass_error="Your password must be at least 8 character [Special character, Capital and small letter, Number]";
        }

        if($np != $cnp){
            $pass_error1="Your password must be same with the confirm password!";
        }
        
        if(!isset($pass_error) && !isset($pass_error1) && !isset($pass_error2)){
            $np=mysqli_real_escape_string($conn,$np);
            $np=password_hash($np,PASSWORD_DEFAULT,['cost' => 15]);
            
            $sql="UPDATE customer set passw='$np' where cusID='$id'";
            $res=mysqli_query($conn,$sql);
            if($res){
                $_SESSION['changepass']="Password changed successful";
                header('location:'.SITEURL."user/account.php");
            }else{
                $error = "Something went wrong.. Please Try again ";
            }
        }
    }
?>

<?php if(isset($_GET['id'])){ ?>
<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <h1 class="custom_blog_title">
                            <a href="account.php" class="fa fa-chevron-circle-left" style="margin-left:20px;" data-toggle="popover" title="Back" data-content="BACK"></a>
                            Change Password
                        </h1>
                    </div>
                    <?php if(isset($error)){?>
                        <div class="error1 fa fa-exclamation-triangle"><?php echo $error; ?></div>
                    <?php } ?>
                    <form class="myaccount-form" method="POST">
                        <div class="myaccount-form-inner">
                        <div class="single-input">
                            <label>Current Password</label>
                            <input type="password" name="cp" id="password" required>
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                            <?php if(isset($pass_error2)){?>
                                <div class="error fa fa-exclamation-triangle"><?php echo $pass_error2; ?></div>
                            <?php } ?>

                        </div>
                        <div class="single-input">
                            <label>New Password</label>
                            <input type="password" name="np" id="password1" required>
                            <i class="bi bi-eye-slash" id="togglePassword1"></i>
                            <?php if(isset($pass_error)){?>
                                <div class="error fa fa-exclamation-triangle"><?php echo $pass_error; ?></div>
                            <?php } ?>
                        </div>
                        <div class="single-input">
                            <label>Confirm New Password</label>
                            <input type="password" name="cnp" id="password2" required>
                            <i class="bi bi-eye-slash" id="togglePassword2"></i>
                            <?php if(isset($pass_error1)){?>
                                <div class="error fa fa-exclamation-triangle"><?php echo $pass_error1; ?></div>
                            <?php } ?>
                        </div>
                        <div class="single-input">
                            <button class="btn btn-custom-size lg-size btn-secondary btn-primary-hover rounded-0" type="submit" name="submit">
                                <span>SAVE CHANGES</span>
                            </button>
                            </div>
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
<?php }else{
    header('location:'.SITEURL."user/404page.php");
}?>
<?php include('partials_front/footer.php'); ?>
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