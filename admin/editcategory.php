<?php include('partials/header.php');?>
<?php
if(isset($_POST['savebtn']))	
{
	$cid=$_POST["cateid"];
	$cname = $_POST["catename"];

	if(empty(trim($cname))){
		$error=" Category Name cannot be empty!";
	}

	if(empty($error)){
		//check cate name with other cate
		$cname1=mysqli_real_escape_string($conn,$cname);
		$res1=mysqli_query($conn,"SELECT * FROM category where categoryName='$cname1' and categoryID!='$cid'");
		if(mysqli_num_rows($res1)<=0){
			$res2=mysqli_query($conn,"UPDATE category SET categoryName='$cname1' WHERE categoryID='$cid'");
			if($res2){
				$_SESSION['success']="Updated Successful!";
				header('location: category.php');
			}else{
				$_SESSION['wrong']="Something went wrong!";
			}
		}else{
			$error=" Category Name existed!";
		}
	}


}
?>

        
        <div class="page-wrapper">
            
            <div class="container-fluid">
                
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Edit Category</h3>
                        <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="category.php">Category</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        
                    </div>
                </div>


					<!-- DataTales Example -->
					<div class="card shadow mb-4">
					 
					   
					  <div class="card-body">

						
						<div class="table-responsive">

						  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							
							<tbody>
							
							<?php
							if(isset($_GET["id"]))
							{
								$cid=$_GET["id"];
								$result= mysqli_query($conn, "SELECT * from category WHERE categoryID='$cid'");
								$row = mysqli_fetch_assoc($result);
							}
								
							?>
						 
						 	<h4 class="card-title">Edit Category</h4>
							 <br></br>

							<form name="addfrm" method="post" action="">
							<?php if(!isset($cname)){
								$cname=$row['categoryName'];
								}	?>	
							<div class="form-group">
								<label for="example-email" class="col-md-10">Category ID</label>
								<div class="col-md-12">
									<input type="text" class="form-control form-control-line" name="cateid1" value="<?php echo $row['categoryID']; ?>" disabled>
									<input type="hidden" class="form-control form-control-line" name="cateid" value="<?php echo $row['categoryID']; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="example-email" class="col-md-12">Category Name</label>
								<div class="col-md-12">
								<input type="text" name="catename" class="form-control form-control-line" value="<?php echo $cname;?>"required>
								<?php 
									if(isset($error)){?>
									<div class="error fa fa-exclamation-triangle"><?php echo $error; ?></div>
									<?php
									}
								?>
								</div>
							</div>
							
							<div style="padding-left:10px;">
							<button class="btn btn btn-primary check_out"input type="submit" name="savebtn" value="Save" onclick=" return confirmation();">Save</button>
							
							<a href="category.php"><button class="btn btn btn-primary check_out" type="button">Back</button></a>
							</div>

							</form>
						</div>
						</div>
						</div>
						
						 </tr>
  
        </tbody>
      </table>

                     </div>
              </div>
			  </div>
			
<?php 
include('partials/footer.php');
include('alert.php');
?>

<style>
    .sidebar-nav ul li a.active, .sidebar-nav ul li a:hover {
    color: #6772e5;
}

</style>