<?php include('partials/header.php');?>

<?php

	if(isset($_POST['submit'])){
		
		//get data from register form	
		$fname=$_POST['fname'];
        $id=$_POST['aid'];

		//checkv variable from user input
		if(empty(trim($fname))){
			$fname_error=" Full Name cannot be empty!";
		}

		//if all pass
		if(empty($fname_error)){
			$fname1=mysqli_real_escape_string($conn,$fname);
			$sql1="UPDATE admin SET
				aName='$fname1'
                where adminID='$id';
			";

			$res1=mysqli_query($conn,$sql1);

			if($res1){
				$_SESSION['success']="Updated Successfully!";
                header("Refresh:1");
			}else{
                $_SESSION['wrong']="Something went wrong!";

            }

		}
    }
?>
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
                <?php 
                    $aid=$_SESSION['admin'];
                    $sql2="SELECT * from admin where adminID='$aid'";
                    $res2=mysqli_query($conn,$sql2);
                     if($res2){
                         if(mysqli_num_rows($res2)==1){

                              while($row = mysqli_fetch_assoc($res2)){ ?>
                    
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post">
                                    <?php
                                        if(!isset($fname)){$fname=$row['aName'];}
                                    ?>
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                                        </div>
                                        <?php if(isset($fname_error)){?>
												<div class="error fa fa-exclamation-triangle"><?php echo $fname_error; ?></div>
										<?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control form-control-line" name="email" id="example-email" value="<?php echo $row['email']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Type of Admin</label>
                                        <div class="col-md-6">
                                        <input type="text" value="<?php echo $row['adminType']; ?>" class="form-control form-control-line" disabled>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $aid ?>" name="aid">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <button class="btn btn-primary" name="submit">Update Profile</button>
                                        </div>
                                    </div>
                                    <?php    }}} ?>
                                </form>
                                <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <a class="btn btn btn-danger delete_cat" href="changepass.php" style="color: white;;">Change Password</a>
                                        </div>
                                    </div>
                            </div>
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
include('alert2.php');
?>