<?php include('../config/connect.php'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="../js/sweetalert2.all.min.js"></script>
<style>
    .swal2-popup { width:500px;
		font-size:16px;
	 }
    form i {
    margin-top: -25px;
    margin-right: 10px;
    float: right;
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

    if(strlen($str)>=8 && $c==4){
        return true;
    }else return false;
}

if(isset($_GET['request'])){
    $request=$_GET['request'];

    $sql="SELECT * from admin where vkey='$request' limit 1";
    $res=mysqli_query($conn,$sql);
    if($res){
        if(mysqli_num_rows($res)==1){
            //vkey exist
            while($row=mysqli_fetch_assoc($res)){
                $expired=$row['expdate'];
                $id=$row['adminID'];
            }

            $current=date('Y-m-d H:i:s');
            if($expired>=$current){
                //haven't expired
                if(isset($_POST['resetpassword'])){

                    $np = $_POST['np'];
                    $cnp = $_POST['cnp'];

                    $sql2="Select aPassword from admin where adminID='$id'";
                    $res2=mysqli_query($conn,$sql2);
                    $row=mysqli_fetch_assoc($res2);
                    
                    if(password_verify($np,$row['aPassword'])){
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
                        
                        $sql="UPDATE admin set aPassword='$np', expdate='$current1' where adminID='$id'";
                        $res=mysqli_query($conn,$sql);
                        if($res){
                            $_SESSION['aresetpass']="success";
                        }else{
                            $_SESSION['aresetpass']= "error";
                        }
                    }
                
                }
            }else{
                $_SESSION['aexpired']="Reset Password Link expired!";
                header('location:'.SITEURL."admin/forgotpass.php");}
        }else{ //not exist
            header("location:".SITEURL."user/pages-error-404.php");
        }
    }else{
        $_SESSION['aresetpass']= "error";
    }
}else{ //not exist
    header("location:".SITEURL."user/pages-error-404.php");
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
                        <h2 class="mt-3 text-center">Reset Password</h2>
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
                                        <label class="text-dark" for="np">New Password</label>
                                        <input title="new password" name="np" type="password" class="form-control" id="password" required>
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        <?php if(isset($pass_error)){?>
                                        <div style="color: red;"><?php echo $pass_error; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="cnp">Confirm Password</label>
                                        <input title="new password" name="cnp" type="password" class="form-control" id="password1" required>
                                        <i class="bi bi-eye-slash" id="togglePassword1"></i>
                                        <?php if(isset($pass_error1)){?>
                                        <div style="color: red;"><?php echo $pass_error1; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark" name="resetpassword">Reset Password</button>
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
if(isset($_SESSION['aresetpass'])){

    if($_SESSION['aresetpass']=="success"){ ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Your password changed successful!',
                html:
                    'Login Now!&nbsp' +
                    '<a href="login.php"><strong><u>Click me</u></strong></a> ',
            });
        </script>

    <?php }else if($_SESSION['aresetpass']=="error"){ ?>

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong...',
            });
        </script>
    <?php } 
        
    unset($_SESSION['aresetpass']);

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