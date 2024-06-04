<?php 
    include('account-sidebar.php');
?>
<link rel="stylesheet" href="assets/css/wallet.css">
<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <?php
                        $row=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer where cusID='".$_SESSION['user']."'"));
                        if($row['wActivate']==1){ //if wallet activate?>
                                <div class="row">
                                    <div class="custom_blog_title" style="margin-left: 20px;">MY WALLET
                                    
                                    <div class="dropdown" style="float: right;">
                                    <button class="dropbtn"><i class="fa fa-ellipsis-v" style="font-size:24px;"></i></button>
                                    <div class="dropdown-content">
                                        <a href="resetpin.php">Change PIN</a>
                                    </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                <div class="wallet-container text-center">

                                    <div class="amount-box text-center">
                                        <img src="https://www.iconpacks.net/icons/2/free-coin-wallet-icon-2204-thumb.png" alt="wallet">
                                        <p>Total Balance</p>
                                        <p class="amount">RM <?php echo $row['walletAmount'];?></p>
                                    </div>

                                    <div class="btn-group text-center">
                                        <a href="topup.php" class="button btn btn-outline-light">Top Up</a>
                
                                        <!--<button type="button" class="btn btn-outline-light">Widthdraw</button>-->
                                        </div>
                                        <div>
                                        <div class="txn-history">
                                            <p>
                                                <b>History</b>
                                                  <select name="" id="sorttrans" style="float:right;" onchange="location = this.value;">
                                                      <option value="" disabled hidden selected>All</option>
                                                      <option value="wa.php?sid=Payment">Payment</option>
                                                      <option value="wa.php?sid=Topup">Topup</option>
                                                  </select>
                                            </p>
                                            <hr>
                                            <?php
                                                  $sql1="SELECT * FROM  wallettransaction,p_t_status where cusID='".$_SESSION['user']."' and wallettransaction.status=p_t_status.sid ";
                                                  
                                                  if(isset($_GET['sid']))
                                                  {
                                                    $sql1.=" and transName='".$_GET['sid']."'";
                                                  }

                                                  $sql1.=" order by wallettransaction.createdTime desc";

                                                  $res1=mysqli_query($conn,$sql1);

                                                  if(mysqli_num_rows($res1)>0){

                                                ?>
                                                  <ul class="responsive-table">
                                                        <li class="table-header">
                                                          <div class="col col-1">Date</div>
                                                          <div class="col col-2">Type</div>
                                                          <div class="col col-3">Amount(RM)</div>
                                                          <div class="col col-4">Status</div>
                                                          <div class="col col-5">Detail</div>
                                                        </li>
                                                      <?php while($row1=mysqli_fetch_assoc($res1)){ ?>

                                                        <li class="table-row">
                                                          <div class="col col-1"><?php echo $row1['createdTime']; ?></div>
                                                          <div class="col col-2"><?php echo $row1['transName']; ?></div>
                                                          <div class="col col-3"><?php echo $row1['transAmount']; ?></div>
                                                          <div class="col col-4"><?php echo $row1['stype']; ?></div>
                                                          <div class="col col-5"><?php if($row1['transName']=='Payment'){

                                                              echo "Payment for order #".$row1['paymentID'];

                                                          } ?></div>
                                                        </li>


                                                     <?php } ?>
                                                    
                                                  </ul>

                                                  <?php }else{
                                                    echo "No result Found!";
                                                  } ?>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php }else if($row['wActivate']==2){
                            header("location: setpass.php");

                        }else{?>
                                <div class="row">
                                    <div class="custom_blog_title" style="margin-left: 20px;">WALLET ACTIVATION
                                    
                                    </div>
                                    </div>
                                        <div class="row" style="text-align: center;">
                                            <div class="col-lg-4 col-md-5 col-sm-4 col-lg-offset-1">
                                                <div class="gnash-iconbox  layout1">
                                                    <div class="iconbox-inner">
                                                        <div class="icon-item">
                                                            <span class="placeholder-text">02</span>
                                                            <span class="icon flaticon-closed-lock"></span>
                                                        </div>
                                                        <div class="content">
                                                            <h4 class="title">
                                                                Wallet Guarantee
                                                            </h4>
                                                            <div class="text">
                                                                Safe & Secure!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-4 col-lg-offset-1">
                                                <div class="gnash-iconbox  layout1">
                                                    <div class="iconbox-inner">
                                                        <div class="icon-item">
                                                            <span class="placeholder-text">02</span>
                                                            <span class="icon flaticon-tick"></span>
                                                        </div>
                                                        <div class="content">
                                                            <h4 class="title">
                                                                Easy & Convenient
                                                            </h4>
                                                            <div class="text">
                                                                Simple Steps!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="activate.php" method="post">
                                            <div style="margin-top: 30px; padding-bottom: 20px; text-align:center;">
                                                <button class="activate" name="activate">Activate Now</button>
                                            </div>
                                        </form>
                                        </div>
                                    <?php } ?>
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

<script>
  $( "select" ).change(function() {
    document.getElementById("sort").submit();
});
</script>

<?php
if(isset($_SESSION['success'])){ ?>

<script>
Swal.fire({
  icon: 'success',
  title: 'Successful!',
  text: '<?php echo $_SESSION['success']; ?>',
})
</script>

<?php unset($_SESSION['success']); }?>