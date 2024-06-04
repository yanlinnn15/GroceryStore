<?php include('addnew.php'); ?>
<?php if(!isset($rname) && !isset($street) && !isset($city) && !isset($adTitle) && !isset($state) && !isset($postcode) && !isset($pNum)){$rname=$street=$city=$state=$pNum=$adTitle=""; $postcode="";} ?>
<form method="post" enctype="multipart/form-data">
    <p class="form-row">
        <label class="text">Address Title</label>
        <input type="text" name="adTitle" value="<?php echo htmlspecialchars($adTitle); ?>" class="input-text" required>
        <?php if(isset($ad_error)){?>
            <div class="error fa fa-exclamation-triangle"><?php echo $ad_error; ?></div>
        <?php } ?>
    </p>
    <p class="form-row form-row-first">
        <label class="text">Name *</label>
        <input type="text" name="rName" value="<?php echo htmlspecialchars($rname); ?>" class="input-text">
        <?php if(isset($rname_error)){?>
            <div class="error fa fa-exclamation-triangle"><?php echo $rname_error; ?></div>
        <?php } ?>
    </p>
    <p class="form-row form-row-last">
        <label class="text">Phone Number *</label>
        <input type="text" name="pNum" placeholder="XXX-XXXXXXXXX" required pattern="[0-9]{3}-[0-9]{3}[0-9]{4,5}" value="<?php echo htmlspecialchars($pNum); ?>"  class="input-text">
    </p>
    <p class="form-row">
        <label class="text">Street *</label>
        <input type="text" name="street" required value="<?php echo htmlspecialchars($street); ?>" class="input-text">
        <?php if(isset($street_error)){?>
            <div class="error fa fa-exclamation-triangle"><?php echo $street_error; ?></div>
        <?php } ?>
    </p>
    <p class="form-row form-row-first">
        <label class="text">Postcode *</label>
        <input name="postcode" type="text" class="input-text" pattern="[0-9]{5}" value="<?php echo htmlspecialchars($postcode); ?>" required>
    </p>
    <p class="form-row form-row-last">
        <label class="text">City *</label>
        <input name="city" type="text" class="input-text" value="<?php echo htmlspecialchars($city); ?>"  required>
        <?php if(isset($city_error)){?>
        <div class="error fa fa-exclamation-triangle"><?php echo $city_error; ?></div>
        <?php } ?>
    </p>
    
    <p class="form-row form-row-first">
        <label class="text">State</label>
        <input title="state" type="text" class="input-text" value="Johor" disabled>
        <input type="hidden" value="Johor" class="input-text" name="state">
    </p>
    <?php 
        $res5=mysqli_query($conn,"SELECT * FROM address where cusID='".$_SESSION["user"]."'");
        if(mysqli_num_rows($res5)<=0){ ?>
            <p class="form-row">
                ** First Address be will your default address
                <input type="hidden" name="defaultad" value="1">
            </p>
        <?php }else{ ?>
            <input type="checkbox" name="defaultad" value="1" id="default"><label for="default">&nbsp;Set As default</label>

        <?php }

    ?>
    <p>
        <input type="submit" name="submitaddress" value="Save">
    </p>
</form>
