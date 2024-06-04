<?php include('partials/header.php');?>

<?php
    if(isset($_POST['addproduct'])){
        $p1=$p2=$p3=$p4=NULL;
        $pdis=NULL;

        if(empty($_POST['pname'])){
            $pname_error =" Product Name cannot be empty!";
        }
        
        if(empty($_POST['pprice'])){
            $pprice_error =" Product price cannot be empty!";
        }else if(is_numeric($_POST['pprice'])==false || $_POST['pprice']<=0){
            $pprice_error =" Please enter a valid price!";
        }

        if($_POST['pqty']==""){
            $pqty_error =" Product quantity cannot be empty";
        }else if(is_numeric($_POST['pqty'])==false || $_POST['pqty']<0 ||  $_POST['pqty']>5000){
            $pqty_error =" Product Quantity must be between 0 to 5000";
        }

        if(!empty(trim($_POST['pdis']))){
            if(is_numeric($_POST['pdis'])==false || $_POST['pdis']<0 || $_POST['pdis']>100){
                $pdis_error =" Please enter a valid discount!";
                $pdis=$_POST['pdis'];
            }else{
                $pdis=$_POST['pdis'];
            }
        }

        if(empty($_POST['cate'])){
            $cate_error =" Category cannot be empty!";
        }

        if(empty($_FILES['p1']['name'])){
            $p1_error =" You must have at least 1 Image";
        }else{
            $p1="../product/".$_FILES['p1']['name'];
            move_uploaded_file($_FILES['p1']['tmp_name'],$p1);
        }

        if(!empty($_FILES['p2']['name'])){
            $p2="../product/".$_FILES['p2']['name'];
            move_uploaded_file($_FILES['p2']['tmp_name'],$p2);
        }
        if(!empty($_FILES['p3']['name'])){
            $p3="../product/".$_FILES['p3']['name'];
            move_uploaded_file($_FILES['p3']['tmp_name'],$p3);
        }
        if(!empty($_FILES['p4']['name'])){
            $p4="../product/".$_FILES['p4']['name'];
            move_uploaded_file($_FILES['p4']['tmp_name'],$p4);
        }
        $pname=$_POST['pname'];
        $pprice=$_POST['pprice'];
        $pqty=$_POST['pqty'];
        $cateID=$_POST['cate'];
        $status=$_POST['status'];
        $desc=$_POST['desc'];

        if(empty($pname_error) && empty($pprice_error) && empty($pqty_error) && empty($p1_error) && empty($pdis_error) && empty($cate_error)){
            $pname=mysqli_real_escape_string($conn,$pname);
            $p1=mysqli_real_escape_string($conn,$p1);
            $p2=mysqli_real_escape_string($conn,$p2);
            $p3=mysqli_real_escape_string($conn,$p3);
            $p4=mysqli_real_escape_string($conn,$p4);
            $desc=mysqli_real_escape_string($conn,$desc);
            $sql="INSERT into product SET
                pName='$pname',
                pPrice='$pprice',
                pQty='$pqty',
                pImage1='$p1',
                pImage2='$p2',
                pImage3='$p3',
                pImage4='$p4',
                pDesc='$desc',
                discountPercent='$pdis',
                productStatus='$status',
                categoryID='$cateID';
            ";

            $res=mysqli_query($conn,$sql);

            if($res){ ?>
           <?php header("location: product.php");
                $_SESSION['success']="Added Successful!";
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
                <h3 class="text-themecolor">Add New Product</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Product</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
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
                    <h4 class="card-title">New Product</h4>
                    <form action=""method="post" enctype="multipart/form-data">
                    <div class="table-responsive">
                    <div class="card">
                    <?php if(!isset($pname)){$pname="";} if(!isset($pprice)){$pprice="";} if(!isset($cateID)){$cateID="";} if(!isset($pqty)){$pqty="";} if(!isset($p1)){$p1="";} if(!isset($p2)){$p2="";} if(!isset($p3)){$p3="";} if(!isset($p4)){$p4="";} if(!isset($desc)){$desc="";} if(!isset($pdis)){$pdis="";}?>
                    <div class="card-body">
                        <form class="form-horizontal form-material" >
                            <div class="form-group">
                                <label class="col-md-12">Product Name *</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="New product" class="form-control form-control-line" name="pname" value="<?php echo htmlspecialchars($pname); ?>">
                                </div>
                                <?php if(isset($pname_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $pname_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Product Price (RM) *</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Min RM 0.01" class="form-control form-control-line" name="pprice" id="example-email" value="<?php echo htmlspecialchars($pprice); ?>">
                                </div>
                                <?php if(isset($pprice_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $pprice_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Product Quantity *</label>
                                <div class="col-md-7">
                                    <input type="number" placeholder="Min 0 Max5000" name="pqty" class="form-control form-control-line" value="<?php echo htmlspecialchars($pqty); ?>">
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
                                <label class="col-md-6">Category *</label>
                                <div class="col-md-6">
                                   <select name="cate" class="form-control form-control-line">
                                   <option value="" selected hidden>Choose ..</option> 
                                   <?php 
                                        $res3=mysqli_query($conn,"SELECT * FROM category");
                                        if(mysqli_num_rows($res3)>0){
                                            while($row3=mysqli_fetch_assoc($res3)){ ?>
                                       <option value="<?php echo $row3['categoryID']; ?>" <?php if($row3['categoryID']==$cateID){ ?> selected <?php } ?> ><?php echo $row3['categoryName']; ?></option>         
                                  <?php  }
                                        } ?>
                                   </select>
                                </div>
                                <?php if(isset($cate_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $cate_error; ?></div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Product Image 1 *</label>
                                <div class="col-md-12">
                                    <input type="file" placeholder="Image 1" name="p1" class="form-control form-control-line" value="<?php echo $p1; ?>" accept=".jpg, .jpeg, .png, .jfif">
                                </div>
                                <?php if(isset($p1_error)){?>
                                        <div class="error fa fa-exclamation-triangle"><?php echo $p1_error; ?></div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Product Image 2</label>
                                <div class="col-md-12">
                                    <input type="file" placeholder="Image 2" name="p2" class="form-control form-control-line" value="<?php echo htmlspecialchars($p2); ?>" accept=".jpg, .jpeg, .png, .jfif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Product Image 3</label>
                                <div class="col-md-12">
                                    <input type="file" placeholder="Image 3" name="p3" class="form-control form-control-line" value="<?php echo htmlspecialchars($p3); ?>" accept=".jpg, .jpeg, .png, .jfif"> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Product Image 4</label>
                                <div class="col-md-12">
                                    <input type="file" placeholder="Image 4" name="p4" class="form-control form-control-line" value="<?php echo htmlspecialchars($p4); ?>" accept=".jpg, .jpeg, .png, .jfif">
                                </div>
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
                                       <option value="A" selected>Active</option>      
                                       <option value="I">Inactive</option>     
                                   </select>
                                </div>
                            </div>
                            

                            <div class="form-group"  style="float: right;">
                                <div class="col-sm-12">
                                    <a href="product.php" class="btn btn-warning">Back</a>
                                    <button class="btn btn-success" name="addproduct">Add</button>
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