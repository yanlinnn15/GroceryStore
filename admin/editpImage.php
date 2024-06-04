<?php include('partials/header.php');?>
<?php
    //update pimage 1
    if(isset($_POST['submitp1'])){
        if(empty($_FILES['p1']['name'])){ ?>
            <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '<?php echo "Something went wrong"; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>
        <?php }else{
            $p1="../product/".$_FILES['p1']['name'];
            move_uploaded_file($_FILES['p1']['tmp_name'],$p1);
            $p1=mysqli_real_escape_string($conn,$p1);
            $res=mysqli_query($conn,"UPDATE product set pImage1='$p1' where productID='".$_GET["id"]."'");
            if(mysqli_affected_rows($conn)==1){ ?>
                <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo "Uploaded Successful"; ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
                </script>
        <?php }
    }
}
?>

<?php
    //update pimage 2
    if(isset($_POST['submitp2'])){
        if(empty($_FILES['p2']['name'])){ ?>
            <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '<?php echo "Something went wrong"; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>
        <?php }else{
            $p2="../product/".$_FILES['p2']['name'];
            move_uploaded_file($_FILES['p2']['tmp_name'],$p2);
            $p2=mysqli_real_escape_string($conn,$p2);
            $res=mysqli_query($conn,"UPDATE product set pImage2='$p2' where productID='".$_GET["id"]."'");
            if(mysqli_affected_rows($conn)==1){ ?>
                <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo "Uploaded Successful"; ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
                </script>
        <?php }
    }
}
?>

<?php
    //update pimage 2
    if(isset($_POST['submitp3'])){
        if(empty($_FILES['p3']['name'])){ ?>
            <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '<?php echo "Something went wrong"; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>
        <?php }else{
            $p3="../product/".$_FILES['p3']['name'];
            move_uploaded_file($_FILES['p3']['tmp_name'],$p3);
            $p3=mysqli_real_escape_string($conn,$p3);
            $res=mysqli_query($conn,"UPDATE product set pImage3='$p3' where productID='".$_GET["id"]."'");
            if(mysqli_affected_rows($conn)==1){ ?>
                <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo "Uploaded Successful"; ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
                </script>
        <?php }
    }
}
?>

<?php
    //update pimage 2
    if(isset($_POST['submitp4'])){
        if(empty($_FILES['p4']['name'])){ ?>
            <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '<?php echo "Something went wrong"; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>
        <?php }else{
            $p4="../product/".$_FILES['p4']['name'];
            move_uploaded_file($_FILES['p4']['tmp_name'],$p4);
            $p4=mysqli_real_escape_string($conn,$p4);
            $res=mysqli_query($conn,"UPDATE product set pImage3='$p4' where productID='".$_GET["id"]."'");
            if(mysqli_affected_rows($conn)==1){ ?>
                <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo "Uploaded Successful"; ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
                </script>
        <?php }
    }
}
?>
<style>
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 266px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}
</style>
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
        if(empty($_POST['pqty'])){
            $pqty_error =" Product quantity cannot be empty";
        }else if(is_numeric($_POST['pqty'])==false || $_POST['pqty']<=0 ||  $_POST['pqty']>5000){ //not empty check for price
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
                <script>
                    alert('Success');
                </script>
           <?php header("location: product.php");
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
                <h3 class="text-themecolor">Edit Product Image</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Product</a></li>
                    <li class="breadcrumb-item active">Edit Product Image</li>
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
                    <h4 class="card-title">Edit Product Image </h4>
                    Product #<?php echo $_GET["id"]; ?> 
                    <div class="table-responsive">
                    <div class="card">

                    <?php 
                        if(!empty($row['pImage1'])){$p1=$row['pImage1'];}else{$p1='assets/images/noimage1.jpg';}
                        if(empty($row['pImage2'])){$p2='assets/images/noimage1.jpg';}else{ $p2=$row['pImage2'];} 
                        if(empty($row['pImage3'])){$p3='assets/images/noimage1.jpg';}else{ $p3=$row['pImage3'];} 
                        if(empty($row['pImage4'])){$p4='assets/images/noimage1.jpg';}else{ $p4=$row['pImage4'];} 
                    ?>
                    <div class="card-body">
                       <p class="col-12">
                            
                        <div class="gallery">
                            <div class="desc">Image 1</div>
                            <a target="_blank" href="<?php echo $row['pImage1'];?>">
                                <img src="<?php echo $row['pImage1'];?>" width="500" height="400">
                            </a>
                            <div class="desc"><button class="btn btn-primary" data-toggle="modal" data-target="#pImage1">
                            <?php
                                 if(empty($row['pImage1'])){
                                 echo "Add"; }else{ echo "Change"; } 
                            ?>
                            </button></div>
                        </div>

                        <div class="gallery">
                            <div class="desc">Image 2</div>
                            <a target="_blank" href="<?php echo $p2;?>">
                                <img src="<?php echo $p2;?>" width="500" height="400">
                            </a>
                            <div class="desc"><button class="btn btn-primary"  data-toggle="modal" data-target="#pImage2">
                            <?php
                                 if(empty($row['pImage2'])){
                                 echo "Add"; }else{ echo "Change"; } 
                            ?>
                            </button></div>
                        </div>

                        <div class="gallery">
                            <div class="desc">Image 3</div>
                            <a target="_blank" href="<?php echo $p3;?>">
                                <img src="<?php echo $p3;?>" width="500" height="400">
                            </a>
                            <div class="desc"><button class="btn btn-primary"  data-toggle="modal" data-target="#pImage3">
                            <?php
                                 if(empty($row['pImage3'])){
                                 echo "Add"; }else{ echo "Change"; } 
                            ?>
                            </button></div>
                        </div>

                        <div class="gallery">
                            <div class="desc">Image 4</div>
                            <a target="_blank" href="<?php echo $p4;?>">
                                <img src="<?php echo $p4;?>" width="500" height="400">
                            </a>
                            <div class="desc"><button class="btn btn-primary"  data-toggle="modal" data-target="#pImage4">
                            <?php
                                 if(empty($row['pImage4'])){
                                 echo "Add"; }else{ echo "Change"; } 
                            ?>
                            </button></div>
                        </div>
                       </p>  
                    </div>
                    <p style="float:right;">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <a href="product.php" class="btn btn-warning">Back</a>
                                </div>
                            </div>
                        </p>
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
<?php include('partials/footer.php');?>

<!-- IMAGE 1-->
<div class="modal fade" id="pImage1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image 1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-md-12">Product Image 1 *</label>
                    <div class="col-md-12">
                        <input type="file" placeholder="Image 1" name="p1" class="form-control form-control-line" accept=".jpg, .jpeg, .png, .jfif" required>
                    </div>
                </div>                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submitp1">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- IMAGE 2-->
<div class="modal fade" id="pImage2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image 2</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-md-12">Product Image 2</label>
                    <div class="col-md-12">
                        <input type="file" placeholder="Image 2" name="p2" class="form-control form-control-line" accept=".jpg, .jpeg, .png, .jfif" required>
                    </div>
                </div>                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submitp2">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- IMAGE 3-->
<div class="modal fade" id="pImage3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image 3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-md-12">Product Image 3 *</label>
                    <div class="col-md-12">
                        <input type="file" placeholder="Image 3" name="p3" class="form-control form-control-line" accept=".jpg, .jpeg, .png, .jfif" required>
                    </div>
                </div>                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submitp3">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- IMAGE 4-->
<div class="modal fade" id="pImage4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image 4</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-md-12">Product Image 4 *</label>
                    <div class="col-md-12">
                        <input type="file" placeholder="Image 4" name="p4" class="form-control form-control-line" accept=".jpg, .jpeg, .png, .jfif" required>
                    </div>
                </div>                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submitp4">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>