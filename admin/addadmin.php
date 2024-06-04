<?php include('partials/header.php');?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<style>
    form i {
    margin-left: -30px;
    height: 30px;
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

		if($x>=8 && $c==4){
			return true;
		}else return false;
	}

	if(isset($_POST['addadmin'])){
		
		//get data from register form	
		$fname=$_POST['fname'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$cpass=$_POST['cpass'];
        $type=$_POST['type'];

		//checkv variable from user input
		if(empty(trim($fname))){
			$fname_error=" Full Name cannot be empty!";
		}

        if(empty(trim($email))){
			$email_error=" Email cannot be NULL~";
		}

        if(!empty(trim($email))){
            $sql="SELECT * FROM admin WHERE email='$email' LIMIT 1";
            $res=mysqli_query($conn,$sql);

            if(mysqli_num_rows($res)==1){
                $email_error=" Sorry, this email already exist.";
            }
        }
		
		//passing password to check the strength
		$value=iPass($pass);
		if($value==false) {
			$pas_error=" Your password should contain at least 8 character [Special Character, Number, Capital and Small Letter]";
		}
		if(!($pass==$cpass)){
			$pas_error1=" Password and Confirm Password Must be the Same!";
		}

		//if all pass
		if(empty($fname_error) && empty($pas_error) && empty($pas_error1) && empty($email_error)){
            $pass=password_hash($pass,PASSWORD_DEFAULT,['cost' => 15]);
			$fname=mysqli_real_escape_string($conn,$fname);
			$email=mysqli_real_escape_string($conn,$email);
			$pass=mysqli_real_escape_string($conn,$pass);
            $type=mysqli_real_escape_string($conn,$type);

			$sql1="INSERT INTO admin SET
				aName='$fname',
				email='$email',
				aPassword='$pass',
				adminType='$type'
			";

			$res1=mysqli_query($conn,$sql1);

			if($res1){
				$_SESSION['success']="Admin Added Successful";
				header("location:".SITEURL."admin/adminlist.php");
			}else{
                $_SESSION['wrong']="Something went wrong, Please Try again!";
            }

		}
    }
?>
<style>

    .error{
        color: red;
    }

</style>

        <!-- ============================================================== -->
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
                        <h3 class="text-themecolor">Add New Admin</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="adminlist.php">Admin List</a></li>
                            <li class="breadcrumb-item active">Add Admin</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Admin</h4>
                                
                               <form action="" method="post">

                                <div class="table-responsive">
                                <div class="card">
                            <!-- Tab panes -->
                            <?php if(!isset($fname) && !isset($uname) && !isset($email) && !isset($type)){$fname=$uname=$email=""; $type="SuperAdmin";} ?>
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="New Admin Name" class="form-control form-control-line" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                                        </div>
                                        <?php if(isset($fname_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $fname_error; ?></div>
										<?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="New Admin Email" class="form-control form-control-line" name="email" id="example-email" value="<?php echo htmlspecialchars($email); ?>">
                                        </div>
                                        <?php if(isset($email_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $email_error; ?></div>
										<?php } ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Password [Your password should contain at least 8 character [Special Character, Number, Capital and Small Letter]]</label>
                                        <div class="col-md-12">
                                            <input type="password" value="" class="form-control form-control-line" name="pass" id="password">
                                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        </div>
                                        <?php if(isset($pas_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $pas_error; ?></div>
										<?php } ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="" class="form-control form-control-line" name="cpass" id="password1">
                                            <i class="bi bi-eye-slash" id="togglePassword1"></i>
                                        </div>
                                        <?php if(isset($pas_error1)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $pas_error1; ?></div>
										<?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Type of Admin</label>
                                        <div class="col-md-6">
                                        <select name="type" class="form-control form-control-line">
                                            <?php if($type=="SuperAdmin"){ ?>
                                                <option value="SuperAdmin" selected>SuperAdmin</option>
                                            <?php }else{?>
                                                <option value="SuperAdmin">SuperAdmin</option>

                                            <?php }
                                                if($type==="Admin"){ ?>
                                                    <option value="Admin" selected>Admin</option>
                                                <?php }else{ ?>
                                                    <option value="Admin">Admin</option>
                                                <?php } ?>
                                        </select>
                                        </div>
                                    </div>
        
                                    <div class="form-group"  style="float: right;">
                                        <div class="col-sm-12">
                                            <a href="adminlist.php" class="btn btn-warning">Back</a>
                                            <button class="btn btn-success" name="addadmin">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                                </div>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
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

</script>