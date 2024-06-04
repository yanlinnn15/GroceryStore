<?php include('account-sidebar.php'); ?>
<style>
textarea{
    border: none;
}
</style>
<?php if(isset($_SESSION['user'])){
         $id=$_SESSION['user'];
        ?>
<div class="col-lg-9">
    <div class="tab-content myaccount-tab-content myaccount-orders" id="account-page-tab-content">
            <div class="myaccount-address">
                <div class="row">
                    <h4 class="custom_blog_title" style="margin-left:30px">
                        MY ADDRESSES
                        <a href="<?php echo SITEURL; ?>user/add-newAddress.php?id=<?php echo $id; ?>" class="button" style="float: right;">+ Add New Address</a> 
                    </h4>
                </div>
                <?php 
                        $sql="SELECT * from address where cusID='$id'";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                            while($row = mysqli_fetch_assoc($res)){
                        ?>
                <div class="row"  style="padding: 10px; background:rgb(255,250,250); border-radius: 40px;">
                    <div class="col-sm-3">
                      <label for="" style="padding-top:15px ;"><?php echo $row['addressTitle']; ?></label>
                    </div>
                    <div class="col-sm-6">
                      <textarea name="" id="" cols="60" rows="4" readonly style="resize:none; overflow:auto;"><?php echo $row['street'];  echo"\n"; echo $row['postcode']; 
                      echo" "; echo $row['city']; echo" ";   echo" "; echo $row['state']; echo".\nPhone Number: "; echo  $row['receiverPhoneNo'];?>
                      </textarea>
                        <form action="" method="post">
                            <p style="margin-left:20px; margin-top:-15px;">
                                <a href="editaddress.php?cid=<?php echo $id."&aid=".$row['addressID']; ?>" class="button" style="float:left;">Update</a>
                                <button class="btn-warning" style="float:left; margin-left:10px;" name="dltad" value="<?php echo $row['addressID'];?>">Delete</button>
                            </p>
                        </form>
                    </div> 
                    <div class="col-sm-3" style="float: right;">
                        <?php switch($row['defaultad']){
                            case '0':
                                ?><form action="" method="post"><button style="float: right; size:8px" name="default" class="button" value="<?php echo $row['addressID']; ?>">Set As Default</button></form>    
                            <?php
                                break;
                            case '1': ?>   
                                <div class="button" disabled style="float: right; background-color:#00bfa5; border-radius: 3px; padding:8px;">Default</div>
                            <?php
                                break;
                        }
                        ?>
                    </div>
                </div>
                <div style="padding-bottom:8px;" ></div>
                <?php }
                        }else{echo "You don't have address";}}else{
                            header("location:".SITEURL."user/404page.php");
                        }?>
            </div>
        </div> 
    </div>
</div>
</div>
</div>
</div>

<?php include('partials_front/footer.php'); ?>
<?php 
    if(isset($_SESSION['edit'])){
        echo "<script type='text/JavaScript'>
        swal.fire('Good job!', 'Address Changed Successful!', 'success');
        </script>";
        unset($_SESSION['edit']);
    }

    if(isset($_SESSION['add'])){
        echo "<script type='text/JavaScript'>
        swal.fire('Good job!', 'Address Added Successful!', 'success');
        </script>";
        unset($_SESSION['add']);
    }
?>

<script>
    $(document).on('click', '.default', function(){
        var adID = $(this).attr("id");   
	});
</script>

<?php
//change defualt ad
if(isset($_POST['default'])){

    $aid=$_POST['default'];

    $res=mysqli_query($conn,"UPDATE address set defaultad=0 where cusID='".$_SESSION['user']."'"); //unset default address
    //update new default ad
    $res1=mysqli_query($conn,"UPDATE address set defaultad=1 where cusID='".$_SESSION['user']."' and addressID=$aid");

    if(mysqli_affected_rows($conn)>0){
        echo "<script type='text/JavaScript'>
        swal.fire('Success', 'Default Address Set!', 'Success');
        </script>";
        header("refresh:1");
    }else{
        echo "<script type='text/JavaScript'>
        swal.fire('Error', 'Default Address Failed', 'error');
        </script>";

    }

}

//delete ad 
if(isset($_POST['dltad'])){

    $aid=$_POST['dltad'];

    //default ad cannot be deleted
    $res=mysqli_query($conn,"DELETE from address where cusID='".$_SESSION['user']."' and addressID='$aid' and defaultad=0"); //unset default address

    if(mysqli_affected_rows($conn)>0){
        echo "<script type='text/JavaScript'>
        swal.fire('Success', 'Address Deleted!', 'Success');
        </script>";
        header("refresh:1.2");
    }else{
        echo "<script type='text/JavaScript'>
        swal.fire('Error', 'DEFAULT address cannot be deleted', 'error');
        </script>";

    }

}
?>