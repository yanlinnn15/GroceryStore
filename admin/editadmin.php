<?php include('partials/header.php');?>
<?php
	if(isset($_POST['updateadmin'])){
		
        $status=$_POST['status'];
        $id=$_POST['aid'];

        $sql1="UPDATE admin SET
            aStatus='$status'
            where adminID='$id';
        ";

		$res1=mysqli_query($conn,$sql1);

        if($res1){
            $_SESSION['success']="Edit Successful";
            header("location:".SITEURL."admin/adminlist.php");
        }else{
            $_SESSION['wrong']="Something went wrong!";

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
                        <h3 class="text-themecolor">Edit Admin</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="adminlist.php">Admin List</a></li>
                            <li class="breadcrumb-item active">Edit Admin</li>
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
                                <h4 class="card-title">Edit Admin</h4>
                               <form action="" method="post">

                                <div class="table-responsive">
                                <div class="card">
                            <!-- Tab panes -->
                           <?php if(isset($_GET['id'])){
                               $aid=$_GET['id'];
                               $sql2="SELECT * from admin where adminID='$aid'";
                               $res2=mysqli_query($conn,$sql2);
                               if($res2){
                                   if(mysqli_num_rows($res2)==1){

                                        $row = mysqli_fetch_assoc($res2);
                                            $type = $row['adminType'];
                                            $status = $row['aStatus'];
                                            
                                            ?>

                            
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" name="fname" value="<?php echo $row['aName']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" class="form-control form-control-line" name="email" id="example-email" value="<?php echo $row['email']; ?>" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Type of Admin</label>
                                        <div class="col-md-6">
                                        <select name="type" class="form-control form-control-line" disabled>
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

                                    <div class="form-group">
                                        <label class="col-md-12">Status</label>
                                        <div class="col-md-6">
                                        <select name="status" class="form-control form-control-line">
                                            <option value="A" <?php if($status=="A"){ ?> selected <?php } ?>>Active</option>
                                            <option value="I" <?php if($status=="I"){ ?> selected <?php } ?>>Inactive</option>
                                            
                                        </select>
                                        </div>
                                    </div>

                                    <input type="hidden" value="<?php echo $aid ?>" name="aid">
                                <?php }

                            }
                        }

                    ?>
        
                                    <div class="form-group"  style="float: right;">
                                        <div class="col-sm-12">
                                            <a href="adminlist.php" class="btn btn-warning">Back</a>
                                            <button class="btn btn-success" name="updateadmin">Update</button>
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
include('alert.php')
?>