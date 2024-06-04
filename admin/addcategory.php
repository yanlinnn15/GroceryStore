<?php include('partials/header.php');?>
<?php
if(isset($_POST['submit']))	
{
	$cname = $_POST["categoryName"];

	if(empty(trim($cname))){
		$error=" Category Name cannot be empty!";
	}

	if(empty($error)){
		//check cate name with other cate
		$cname1=mysqli_real_escape_string($conn,$cname);
		$res1=mysqli_query($conn,"SELECT * FROM category where categoryName='$cname1'");
		if(mysqli_num_rows($res1)<=0){
			$res2=mysqli_query($conn,"INSERT INTO category (categoryName) VALUES ('$cname1')");
			if($res2){
				$_SESSION['success']="Updated Successful!";
				header('location: category.php');
			}else{
				$_SESSION['wrong']="Something went wrong!";
			}
		}else{
            $error=" Category Existed!";
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
                <h3 class="text-themecolor">Add New Category</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="category.php">Category</a></li>
                    <li class="breadcrumb-item active">Add New Category</li>
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
                    <h4 class="card-title">New Category</h4>
                    <div class="table-responsive">
                    <div class="card">
                    <div class="card-body">
                    <form name="addfrm" method="post" action="">
                        <?php if(!isset($cname)){
                            $cname="";
                        }	?>

                      <div class="form-group">
                        <label for="example-email" class="col-md-6">New Category Name</label>
                        <div class="col-md-6">
                        <input type="text" name="categoryName" class="form-control form-control-line" value="<?php echo $cname;?>"required>
                        <?php 
                            if(isset($error)){?>
                            <div class="error fa fa-exclamation-triangle"><?php echo $error; ?></div>
                            <?php
                            }
                        ?>
                        </div>
                      </div>
                      
                      <div style="padding-left:10px;">
                      <button class="btn btn btn-primary check_out"input type="submit" name="submit" value="Save" >Add</button>
                      
                      <a href="category.php"><button class="btn btn btn-primary check_out" type="button">Back</button></a>
                      </div>

                      </form>
                    </div>
                </div>
                        </div>
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

<style>
      .sidebar-nav ul li a.active, .sidebar-nav ul li a:hover {
    color: #6772e5;
}

</style>
