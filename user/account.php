<?php include('account-sidebar.php');?>
<style>
    .cus .row{
        margin-bottom: 30px;
    }
</style>

<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <div class="custom_blog_title" style="margin-left: 20px;">PERSONAL DETAIL
                        <a href="<?php echo SITEURL; ?>user/edit-profile.php?id=<?php echo $id ?>">
                            <button class="fa fa-edit" style="float: right; border-radius:100px;">
                            </button>
                         </a>
                           
                        </div>
                    </div>
                    <?php if(isset($_SESSION['user'])){
                        $id=$_SESSION['user'];
                        $sql="SELECT * from customer where cusID='$id' LIMIT 1";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)==1){
                            while($row = mysqli_fetch_assoc($res)) {
                                $fname=$row['cusFName'];
                                $lname=$row['cusLName'];
                                $email=$row['cusEmail'];
                                $pNum=$row['cusPhoneNo'];
                                $gender=$row['cusGender'];
                            }
                        }else{
                            header("location:".SITEURL."user/404page.php");
                        }
                        }?>
                   <div class="cus">
                   <div class="row">
                        <div class="col-sm-4">
                            <strong>Gender</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $gender; ?>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>First Name</strong>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $fname; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Last Name</strong>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $lname; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Phone Number</strong>
                            </div>
                            <div class="col-sm-8">
                                <?php echo $pNum; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Email</strong>
                            </div>
                            <div class="col-sm-4">
                                <?php echo $email; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Password</strong>
                            </div>
                            <div class="col-sm-8">
                                <a href="<?php echo SITEURL; ?>user/change-pass.php?id=<?php echo $id; ?>" style="margin-top: 0px;" class="gnash-button button">Change Password</a>
                            </div>
                        </div>                   
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
    


<?php include('partials_front/footer.php'); ?>

<?php 
    if(isset($_SESSION['changepass'])){
        echo "<script type='text/JavaScript'>
        swal.fire('Good job!', 'Password Changed Successful!', 'success');
        </script>";
        unset($_SESSION['changepass']);
    }

    if(isset($_SESSION['updateProfile'])){
        echo "<script type='text/JavaScript'>
        swal.fire('Good job!', 'Update Successful!', 'success');
        </script>";
        unset($_SESSION['updateProfile']);
    }
?>