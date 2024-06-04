<?php include('../config/connect.php');?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="../js/sweetalert2.all.min.js"></script>
<style>
    form i {
    margin-top: -25px;
    margin-right: 10px;
    float: right;
    cursor: pointer;
}
</style>
<?php 

if(!isset($_SESSION['admin'])){ ?>
    <?php 
    if(isset($_POST['signin'])){
        $email=$_POST['email'];
        $pwd=$_POST['pwd'];

      
        $email=mysqli_escape_string($conn,$email);
        $pwd=mysqli_escape_string($conn,$pwd);

        $sql="SELECT * FROM admin where email='$email'";
        $res=mysqli_query($conn,$sql);

        if($res){
            if(mysqli_num_rows($res)==1){
                while($row=mysqli_fetch_assoc($res)){
                    $id=$row['adminID'];
                    $type=$row['adminType'];
                    $pass=$row['aPassword'];
                    $status=$row['aStatus'];
                }
                if($status=='A'){
                    if(password_verify($pwd, $pass)){
                        $_SESSION['admin']=$id;
                        $_SESSION['adminType']=$type;
                        header("location:".SITEURL."admin/index.php");
                    }else{
                        $error1=" Email or Password is Invalid !";
                    }
                }else{
                    $error1=" Your account is inactive!";
                }
               
            }else{
                $error1=" Email or Password is Invalid !";
            }
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
                <?php if(!isset($email)){$email="";} ?>
                </div>
                <div class="col-lg-4 col-md-5 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/favicon.png" alt="wrapkit" style="width:15%;">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center">Sign in to access admin panel.</p>
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
                                            placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        
                                        <input class="form-control" name="pwd" type="password" placeholder="Password" required id="password">
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                      <a href="forgotpass.php">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark" name="signin">Sign In</button>
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
}else{
    header('location:'.SITEURL."admin/index.php");
}
?>
<?php
    if(isset($_SESSION['accinactive'])){ ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You Account is Inactive',
            });
        </script>
        <?php

        unset($_SESSION['accinactive']);
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
</script>