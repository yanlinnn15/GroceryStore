<?php include('partials/header.php');?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
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

    if(strlen($str)>=8 && $c==4){
        return true;
    }else return false;
}

if(isset($_POST['submit'])){
    $cp = $_POST['cp'];
    $np = $_POST['np'];
    $cnp = $_POST['ncp'];
    $id=$_SESSION['admin'];

    $sql2="Select aPassword from admin where adminID='$id'";
    $res2=mysqli_query($conn,$sql2);
    $row=mysqli_fetch_assoc($res2);

    if(!password_verify($cp,$row['aPassword'])){
        $cp_error=" Your current password is wrong...";
    }
    
    if(password_verify($np,$row['aPassword'])){
        $np_error=" Your password cannot be same with the current password.";
    }

    if(!(iPass($np))){
        $np_error=" Your password must be at least 8 character [Special character, Capital and small letter, Number]";
    }

    if($np != $cnp){
        $cnp_error=" Your password must be same with the confirm password!";
    }
    
    if(!isset($cp_error) && !isset($np_error1) && !isset($cnp_error)){
        $np=mysqli_real_escape_string($conn,$np);
        $np=password_hash($np,PASSWORD_DEFAULT,['cost' => 15]);
        
        $sql="UPDATE admin set aPassword='$np' where adminID='$id'";
        $res=mysqli_query($conn,$sql);
        if($res){
            $_SESSION['success']="Password Changed Successful!";
            header("location:".SITEURL."admin/pages-profile.php");
        }else{
            $_SESSION['wrong']= "Something went wrong...";
        }
    }

}
?>    <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Profile</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Current Password</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control form-control-line" name="cp" id="password">
                                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        </div>
                                        <?php if(isset($cp_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $cp_error; ?></div>
										<?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control form-control-line" name="np" id="password1">
                                            <i class="bi bi-eye-slash" id="togglePassword1"></i>
                                        </div>
                                        <?php if(isset($np_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $np_error; ?></div>
										<?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">New Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control form-control-line" name="ncp" id="password2">
                                            <i class="bi bi-eye-slash" id="togglePassword2"></i>
                                        </div>
                                        <?php if(isset($cnp_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $cnp_error; ?></div>
										<?php } ?>
                                    </div>
                                    
                                    
                                    <input type="hidden" value="<?php echo $aid ?>" name="aid">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <button class="btn btn-primary" name="submit">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                               
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php 
    include('partials/footer.php');
    include('alert.php');
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