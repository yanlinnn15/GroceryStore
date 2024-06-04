<?php include('account-sidebar.php');
        include('addnew.php');
?>


<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <h1 class="custom_blog_title">
                            <a href="address.php" class="fa fa-chevron-circle-left" style="margin-left:20px;" data-toggle="popover" title="Back" data-content="BACK"></a>
                            ADD NEW ADDRESSES
                        </h1>
                    </div>
                    <?php if(!isset($rname) && !isset($street) && !isset($city) && !isset($adTitle) && !isset($state) && !isset($postcode) && !isset($pNum)){$rname=$street=$city=$state=$pNum=$adTitle=""; $postcode="";} ?>
                    <form action="" class="myaccount-form" method="POST">
                        <div class="myaccount-form-inner">
                            <div class="single-input">
                                <label>Address title*</label>
                                <input type="text" name="adTitle" value="<?php echo htmlspecialchars($adTitle); ?>" required>
                                <?php if(isset($ad_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $ad_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Name*</label>
                                <input type="text" name="rName" value="<?php echo htmlspecialchars($rname); ?>">
                                <?php if(isset($rname_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $rname_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Phone Number*</span></label>
                                <input type="text" name="pNum" required pattern="[0-9]{3}-[0-9]{3}[0-9]{4,5}" value="<?php echo htmlspecialchars($pNum); ?>" placeholder="XXX-XXXXXXX">
                            </div>
                            <div class="single-input">
                                <label>Street*</label>
                                <input type="text" name="street" required value="<?php echo htmlspecialchars($street); ?>">
                                <?php if(isset($street_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $street_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>City*</label>
                                <input type="text" name="city" class="input-text" required value="<?php echo htmlspecialchars($city); ?>">
                                <?php if(isset($city_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $city_error; ?></div>
                                <?php } ?>
                            </div>
                            <div class="single-input single-input-half">
                                <label>Postcode*</label>
                                <input type="text" name="postcode" class="input-text" required value="<?php echo htmlspecialchars($postcode); ?>" pattern="[0-9]{5}">
                                <?php if(isset($pos_error)){?>
                                    <div class="error fa fa-exclamation-triangle"><?php echo $pos_error; ?></div>
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