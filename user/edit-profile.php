<?php include('account-sidebar.php'); ?>

<style>
    .radio{
    font-size:5px;
    margin:0;
}

p .radio{
    display: inline-block;
}

<?php
    if(isset($_POST["submit-edit"])){
        $gender1=$_POST['gender'];
        $fname1=$_POST['firstN'];
        $lname1=$_POST['lastN'];
        $pnum1=$_POST['pnum'];
        $id=$_POST['id'];

        if(empty(trim($fname1))){
            $fname_error=" Your First Name cannot be NULL";
        }
        if(empty(trim($lname1))){
            $lname_error=" Your Last Name cannot be NULL~";
        }

        if(!isset($fname_error) && !isset($lname_error)){

            $fname1=mysqli_real_escape_string($conn,$fname1);
			$lname1=mysqli_real_escape_string($conn,$lname1);
			$gender1=mysqli_real_escape_string($conn,$gender1);
			$pnum1=mysqli_real_escape_string($conn,$pnum1);

            $sql1="UPDATE customer SET
            cusGender='$gender1',
            cusFName='$fname1',
            cusLName='$lname1',
            cusPhoneNo='$pnum1'
            WHERE cusID='$id';
            ";

            $res1=mysqli_query($conn,$sql1);

            if($res1){
                $_SESSION['updateProfile']="Update Successfully!";
                header("location:".SITEURL."user/account.php");
            }else{
                $error= "Failed to Edit, Try Again!";
            }

        }
    }
?>             

</style>
<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <h1 class="custom_blog_title">
                            <a href="account.php" class="fa fa-chevron-circle-left" style="margin-left:20px;" data-toggle="popover" title="Back" data-content="BACK"></a>
                            EDIT PERSONAL DETAIL
                            
                        </h1>
                    </div>
                    <form action="" class="myaccount-form" method="POST">
                        <?php 
                            $id = $_GET['id'];
                            $sql="SELECT * from customer where cusID='$id' LIMIT 1";
                            $res=mysqli_query($conn,$sql);
                            if($res){
                                if(mysqli_num_rows($res)==1){
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $fname=$row['cusFName'];
                                        $lname=$row['cusLName'];
                                        $pNum=$row['cusPhoneNo'];
                                        $gender=$row['cusGender'];
                                    }
                                }
                            }else{
                                header("location:".SITEURL."user/404page.php");
                            }
                            ?>
                        <div class="myaccount-form-inner">
                            <div class="single-input single-input-half">
                                <label>First Name*</label>
                                <input type="text" name="firstN" <?php if(isset($fname1)){?> value="<?php echo htmlspecialchars($fname1); ?>"<?php }else{ ?> value="<?php echo $fname;?>" <?php }?>>
                                <?php if(isset($fname_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $fname_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Last Name*</span></label>
                                <input type="text" name="lastN" <?php if(isset($lname1)){?> value="<?php echo htmlspecialchars($lname1); ?>"<?php }else{ ?> value="<?php echo $lname;?>" <?php }?>>
                                <?php if(isset($lname_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $lname_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Gender</label>
                                <select name="gender">
                                    <option value="" hidden disabled selected>Please Select</option>
                                    <option value="Male" <?php if($gender=='Male'){?> selected <?php } ?>>Male</option>
                                    <option value="Female" <?php if($gender=='Female'){?> selected <?php } ?>>Female</option>
                                    <option value="Other" <?php if($gender=='Other'){?> selected <?php } ?>>Other</option>
                                </select>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Phone Number</label>
                                <input type="tel" name="pnum" <?php if(isset($pNum)){?> value="<?php echo htmlspecialchars($pNum); ?>"<?php }else{ ?> value="<?php echo $pNum;?>" <?php }?> pattern="[0-9]{3}-[0-9]{3}[0-9]{4,5}">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <div class="single-input">
                                <button class="btn btn-custom-size lg-size btn-secondary btn-primary-hover rounded-0" type="submit" name="submit-edit">
                                    <span>SAVE CHANGES</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
    


<?php include('partials_front/footer.php'); ?>