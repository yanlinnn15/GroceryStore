<?php include('account-sidebar.php'); ?>

<?php
	if(isset($_POST['submitaddress'])){

        $cid=$_GET['cid'];
        $aid=$_GET['aid'];
		
		//get data from form
		$adTitle=$_POST['adTitle'];
		$rname=$_POST['rName'];
		$street=$_POST['street'];
		$state=$_POST['state'];
		$city=$_POST['city'];
        $code=$_POST['postcode'];
        $pNum=$_POST['pNum'];

		//checkv variable from user input
		if(empty(trim($street)) || strlen($street)<=4){
			$street_error=" Street must be at least 4 character";
		}

        if(empty(trim($rname))){
			$rname_error=" Name cannot be Empty!";
		}
        if(empty(trim($adTitle))){
			$ad_error=" Address Title cannot be Empty!";
		}

        if(empty(trim($state))){
			$state_error=" State cannot be Empty!";
		}


        if(empty(trim($code))){
			$code_error=" Please enter a valid postcode!";
		}

		//if all pass
		if(empty($rname_error) && empty($street_error) && empty($ad_error) && empty($state_error1) && empty($city_error)){
			$rname=mysqli_real_escape_string($conn,$rname);
			$street=mysqli_real_escape_string($conn,$street);
			$state=mysqli_real_escape_string($conn,$state);
			$adTitle=mysqli_real_escape_string($conn,$adTitle);
            $city=mysqli_real_escape_string($conn,$city);
            $pNum=mysqli_real_escape_string($conn,$pNum);

			$sql1="UPDATE address SET
				addressTitle='$adTitle',
				receiverName='$rname',
				receiverPhoneNo='$pNum',
				street='$street',
                state='$state',
				city='$city',
                postcode='$code'
                where addressID='$aid' and cusID='$cid';
			";

			$res1=mysqli_query($conn,$sql1);

			if($res1){
				$_SESSION['edit']="Address Added Successful";
				header("location:".SITEURL."user/address.php");
			}else{
				
            }

		}
    }
?>

<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <h1 class="custom_blog_title">
                            <a href="address.php" class="fa fa-chevron-circle-left" style="margin-left:20px;" data-toggle="popover" title="Back" data-content="BACK"></a>
                            EDIT ADDRESSES
                        </h1>
                    </div>
                    <form action="" class="myaccount-form" method="POST">
                        <?php 
                            $cid = $_GET['cid'];
                            $aid = $_GET['aid'];
                            $sql="SELECT * from address where cusID='$cid' AND addressID='$aid' LIMIT 1";
                            $res=mysqli_query($conn,$sql);
                            if($res){
                                if(mysqli_num_rows($res)==1){
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $at=$row['addressTitle'];
                                        $rn=$row['receiverName'];
                                        $rpn=$row['receiverPhoneNo'];
                                        $st=$row['street'];
                                        $ct=$row['city'];
                                        $code=$row['postcode'];
                                        $sta=$row['state'];
                                    }
                                }
                            }else{
                                header("location:".SITEURL."user/404page.php");
                            }
                        ?>
                        <div class="myaccount-form-inner">
                            <div class="single-input">
                                <label>Address title*</label>
                                <input type="text" name="adTitle" <?php if(isset($adTitle)){?> value="<?php echo htmlspecialchars($adTitle); ?>" <?php }else{?> value="<?php echo $at ?>" <?php } ?> required>
                                <?php if(isset($ad_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $ad_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Name*</label>
                                <input type="text" name="rName" <?php if(isset($rname)){?> value="<?php echo htmlspecialchars($rname); ?>" <?php }else{?> value="<?php echo $rn ?>" <?php } ?> required>
                                <?php if(isset($rname_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $rname_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Phone Number*</span></label>
                                <input type="text" name="pNum" required pattern="[0-9]{3}-[0-9]{3}[0-9]{4,5}" <?php if(isset($pNum)){?> value="<?php echo htmlspecialchars($pNum); ?>" <?php }else{?> value="<?php echo $rpn ?>" <?php } ?>>
                            </div>
                            <div class="single-input">
                                <label>Street*</label>
                                <input type="text" name="street" required <?php if(isset($street)){?> value="<?php echo htmlspecialchars($street); ?>" <?php }else{?> value="<?php echo $st ?>" <?php } ?>>
                                <?php if(isset($street_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $street_error; ?></div>
                                <?php } ?>
                            </div>

                            <div class="single-input single-input-half">
                                <label>City*</label>
                                <input type="text" name="city" class="input-text" required <?php if(isset($city)){?> value="<?php echo htmlspecialchars($city); ?>" <?php }else{?> value="<?php echo $ct ?>" <?php } ?>>
                                <?php if(isset($city_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $city_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Postcode*</label>
                                <input type="text" name="postcode" class="input-text" required value="<?php echo htmlspecialchars($code); ?>">
                                <?php if(isset($code_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $code_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>State</label>
                                <input type="text" value="Johor" disabled>
                                <input type="hidden" name="state" required value="Johor">
                            </div>

                            <div style="margin-top: 57px;">
                                <input type="checkbox" name="defaultad" value="1" id="default"><label for="default">&nbsp;Set As Default</label>
                            </div>
                            
                            <input type="submit" value="SAVE" class="button" name="submitaddress" style="width:22%; float:right; height: 3.2em; margin-top: 55px;">
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