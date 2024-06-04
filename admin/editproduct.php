<?php include('partials/header.php');?>
<?php

    if(isset($_POST['updateproduct'])){
		$pid=$_GET["id"];
        $pdis=NULL;
        $cateID=NULL;

        //check product name 
        if(empty($_POST['pname'])){
            $pname_error =" Product Name cannot be empty!";
        }
        
        //check price empty or not
        if(empty($_POST['pprice'])){
            $pprice_error =" Product price cannot be empty!";
        }else if(is_numeric($_POST['pprice'])==false || $_POST['pprice']<=0){ //not empty check for price 
            $pprice_error =" Please enter a valid price!";
        }

        //check product qty
        if($_POST['pqty']==" "){
            $pqty_error =" Product quantity cannot be empty";
        }else if(is_numeric($_POST['pqty'])==false || $_POST['pqty']<0 ||  $_POST['pqty']>5000){ //not empty check for price
            $pqty_error =" Product Quantity must be between 0 to 5000";
        }

        //if discount is set then check the condition
        if(isset($_POST['pdis'])){
            if(is_numeric($_POST['pdis'])==false || $_POST['pdis']<=0 || $_POST['pdis']>100){
                $pdis_error =" Please enter a valid discount!";
                $pdis=$_POST['pdis'];
            }
        }

        //check category
        if(empty($_POST['cate'])){
            $cate_error =" Category cannot be empty!";
        }

        $pname=$_POST['pname'];
        $pprice=$_POST['pprice'];
        $pqty=$_POST['pqty'];
        $cateID=$_POST['cate'];
        $status=$_POST['status'];
        $desc=$_POST['desc'];

        if(empty($pname_error) && empty($pprice_error) && empty($pqty_error) && empty($p1_error)){
            $pname=mysqli_real_escape_string($conn,$pname);
            $desc=mysqli_real_escape_string($conn,$_desc);

            $sql="UPDATE product SET
                pName='$pname',
                pPrice='$pprice',
                pQty='$pqty',
                pDesc='$desc',
                categoryID='$cateID',
                productStatus='$status'
				where productID='$pid';
            ";

            $res=mysqli_query($conn,$sql);

            if($res){ ?>
           <?php header("location: product.php");
                $_SESSION['success']="Success!";
            }else{?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                </script>
            <?php }
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
                <h3 class="text-themecolor">Edit Product</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Product</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
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
        <?php
						if(isset($_GET["id"]))
						{
							$pid=$_GET["id"];
							$result= mysqli_query($conn, "SELECT *from product WHERE productID='$pid'");
							$row = mysqli_fetch_assoc($result);
						}else{
                            header('location: pages-error-404.php');
                            
                        }
						
					?>

        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Edit Product #<?php echo $_GET["id"]; ?></h4>
                    <form action="" method="post">
                    <div class="table-responsive">
                    <div class="card">
                    <?php if(!isset($pname)){$pname=$row['pName'];} if(!isset($pprice)){$pprice=$row['pPrice'];} if(!isset($pqty)){$pqty=$row['pQty'];} if(!isset($pdis)){$pdis=$row['discountPercent'];} if(!isset($cateID)){$cateID=$row['categoryID'];} if(!isset($p1)){$p1=$row['pImage1'];} if(!isset($p2)){$p2=$row['pImage2'];} if(!isset($p3)){$p3=$row['pImage3'];} if(!isset($p4)){$p4=$row['pImage4'];} if(!isset($desc)){$desc=$row['pDesc'];} if(!isset($status)){$status=$row['productStatus'];}?>
                    <div class="card-body">
                        <form class="form-horizontal form-material">
                            <div class="form-group">
                                <label class="col-md-12">Product Name*</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="New product" class="form-control form-control-line" name="pname" value="<?php echo htmlspecialchars($pname); ?>">
                                </div>
                                <?php if(isset($pname_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $pname_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Product Price*</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="product price" class="form-control form-control-line" name="pprice" id="example-email" value="<?php echo htmlspecialchars($pprice); ?>">
                                    <?php if(isset($pprice_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $pprice_error; ?></div>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6">Category</label>
                                <div class="col-md-6">
                                   <select name="cate" class="form-control form-control-line">
                                   <?php 
                                        $res3=mysqli_query($conn,"SELECT * FROM category");
                                        if(mysqli_num_rows($res3)>0){
                                            while($row3=mysqli_fetch_assoc($res3)){ ?>
                                       <option value="<?php echo $row3['categoryID']; ?>" <?php if($cateID==$row3['categoryID']){ ?> selected <?php } ?>><?php echo $row3['categoryName']; ?></option>         
                                  <?php  }
                                        } ?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Product Quantity*</label>
                                <div class="col-md-6">
                                    <input type="number" name="pqty" class="form-control form-control-line" value="<?php echo htmlspecialchars($pqty); ?>">
                                </div>
                                <?php if(isset($pqty_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $pqty_error; ?></div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Product Discount (%)</label>
                                <div class="col-md-7">
                                    <input type="number" placeholder="Min 0 Max 100" name="pdis" class="form-control form-control-line" value="<?php echo htmlspecialchars($pdis); ?>">
                                </div>
                                <?php if(isset($pdis_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $pdis_error; ?></div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Description</label>
                                <div class="col-md-12">
                                    <textarea name="desc" id="" cols="30" rows="10" class="form-control form-control-line"><?php echo htmlspecialchars($desc); ?></textarea>

                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label class="col-md-6">Status</label>
                                <div class="col-md-6">
                                   <select name="status" class="form-control form-control-line">
                                       <option value="A" <?php if($status=='A'){ ?> selected <?php } ?>>Active</option>      
                                       <option value="I" <?php if($status=='I'){ ?> selected <?php } ?>>Inactive</option>     
                                   </select>
                                </div>
                            </div>

                            <div class="form-group"  style="float: right;">
                                <div class="col-sm-12">
                                    <a href="product.php" class="btn btn-warning">Back</a>
                                    <button class="btn btn-success" name="updateproduct">Save</button>
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
<?php include('partials/footer.php');?>
