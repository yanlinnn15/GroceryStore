<?php include('partials/header.php');?>
<?php
$url=$_SERVER['HTTP_REFERER'];
if(isset($_POST['savebtn']))	
{
	$bid=$_POST["timeSlot"];
	$slot = mysqli_real_escape_string($conn,$_POST["slot"]);
    $price = mysqli_real_escape_string($conn,$_POST["price"]);

	if(!empty($slot)){
		if($slot<0 || $slot>50){
			$s_error=" Number of Slot must be within 0-999";
		}
	}

	if(!empty($price)){
		if($price<0 || $price>20){
			$p_error=" Price must be within 0-20";
		}
	}

   if(empty($s_error) && empty($p_error)){
		$sql="UPDATE timeslot SET numberOfSlot='$slot', dprice='$price' WHERE timeSlot='$bid'";
		$res1=mysqli_query($conn, $sql);
		if($res1){
			$_SESSION['success']="Update Successful!";
			header("location:timeslot.php");
		}else{
			$_SESSION['wrong']="Something went wrong..";
		}
   }
	
}

?>
<head>
<style>
.right{
	margin-left:10px;
	margin-top:0px;
	width: 200px;
	height: 120px;	
}
</style>
        <div class="page-wrapper">
            <div class="container-fluid">
                
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Edit TimeSlot</h3>
                        <ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="timeslot.php">Time Slot</a></li>
                            <li class="breadcrumb-item active">Edit TimeSlot</li>
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
								$bid=$_GET["id"];
								$result= mysqli_query($conn, "SELECT *from timeslot WHERE timeSlot='$bid'");
								$row = mysqli_fetch_assoc($result);
							}else{
								header("location: pages-error-404.php");
							}
								
							?>

							<?php 
                            if(!isset($timeslotname)){
								$timeslotname=$row['timeRange'];
							}
                            if(!isset($slot)){
                                $slot=$row['numberOfSlot'];
							}
                            if(!isset($price)){
                                $price=$row['dprice'];
							}
                            
                            
                            ?>
						 
							<h4 class="card-title">Edit timeslot</h4>
							 <br></br>

							<form method="post">
								<div class="form-group">
									<label for="example-email" class="col-md-10">ID</label>
									<div class="col-md-12">
										<input type="text" name="timeSlot1" value="<?php echo $row['timeSlot']; ?>" class="form-control form-control-line" disabled>
										<input type="hidden" name="timeSlot" value="<?php echo $row['timeSlot']; ?>" class="form-control form-control-line" >
									</div>
								</div>
								

								<div class="form-group">
									<label for="example-email" class="col-md-10">Time Range</label>
									<div class="col-md-12">
										<input type="text" name="timeslotname1" value="<?php echo $timeslotname;?>"required class="form-control form-control-line" disabled>
										<input type="hidden" name="timeRange" value="<?php echo $timeslotname;?>"required class="form-control form-control-line">
									</div>
								</div>

                                <div class="form-group">
									<label for="example-email" class="col-md-10">Number of Slot (Min 0 Max 50) *</label>
									<div class="col-md-12">
										<input type="number" min="0" max="50" name="slot" value="<?php echo htmlspecialchars($slot);?>"required class="form-control form-control-line">
										<?php if(isset($s_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $s_error; ?></div>
                                <?php } ?>
									</div>
								</div>

                                <div class="form-group">
									<label for="example-email" class="col-md-10">Price (RM) *</label>
									<div class="col-md-12">
										<input type="number" step="0.01" min="0.00" max="10.00" name="price" value="<?php echo htmlspecialchars($price);?>"required class="form-control form-control-line">
										<?php if(isset($p_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $p_error; ?></div>
                                <?php } ?>
									</div>
								</div>

								<div style="padding-left:10px;">
									<input type="submit" name="savebtn" value="Save" class="btn btn btn-primary">
									<a href="timeslot.php"><button class="btn btn btn-primary check_out" type="button">Back</button></a>
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
	require "alert.php";
?>