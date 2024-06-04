<?php
	if(isset($_POST['submitaddress'])){

        $id=$_SESSION['user'];
		
		//get data from form
		$adTitle=$_POST['adTitle'];
		$rname=$_POST['rName'];
		$street=$_POST['street'];
		$state=$_POST['state'];
		$city=$_POST['city'];
        $postcode=$_POST['postcode'];
        $pNum=$_POST['pNum'];
        if(isset($_POST['defaultad'])){
			$defaultad=$_POST['defaultad'];
		}else{
			$defaultad=0;
		}

		//checkv variable from user input
		if(empty(trim($street)) || strlen($street)<4){
			$street_error=" Street must be at least 4 character";
		}

        if(empty(trim($rname))){
			$rname_error=" Name cannot be empty!";
		}
        if(empty(trim($adTitle))){
			$ad_error=" Address Title cannot be empty!";
		}

        if(empty(trim($postcode))){
			$pos_error=" State cannot be empty!";
		}

        if(empty(trim($city))){
			$city_error=" City cannot be empty!";
		}

		//if all pass
		if(empty($rname_error) && empty($street_error) && empty($ad_error) && empty($pos_error1) && empty($city_error)){
			$rname=mysqli_real_escape_string($conn,$rname);
			$street=mysqli_real_escape_string($conn,$street);
			$state=mysqli_real_escape_string($conn,$state);
			$adTitle=mysqli_real_escape_string($conn,$adTitle);
            $city=mysqli_real_escape_string($conn,$city);
            $pNum=mysqli_real_escape_string($conn,$pNum);
            $postcode=mysqli_real_escape_string($conn,$postcode);

            $res2=mysqli_query($conn,"SELECT * FROM address where cusID=$id");
            if(mysqli_num_rows($res2)<=0){
                $defaultad=1;
            }else{
				if($defaultad==1){
					$res6=mysqli_query($conn,"update address set defaultad=0 where cusID=$id");
				}
			}

			$sql1="INSERT INTO address SET
				addressTitle='$adTitle',
				receiverName='$rname',
				receiverPhoneNo='$pNum',
				street='$street',
                state='$state',
				city='$city',
                postcode='$postcode',
                cusID='$id',
                defaultad='$defaultad'
			";

			$res1=mysqli_query($conn,$sql1);

			if($res1){
				if(isset($_GET['id'])){
				    header("location:".SITEURL."user/address.php");
					$_SESSION['add']="Success";
				}
                else{
					$aid = mysqli_insert_id($conn);
                header("location:".SITEURL."user/checkout.php?choosed=".$aid);
                }
			}else{?>
                <script>alert("<?php echo $id; ?>");</script>
				
            <?php }

		}
    }
?>