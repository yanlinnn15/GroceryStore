<?php include('account-sidebar.php'); ?>

<style>
input[type=password] {
    padding: 10px;
    border: 1px solid #ddd;
    width: 50px;
    height: 50px;
    text-align: center;
    font-size: 30px;
}
</style>


<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <h1 class="custom_blog_title">
                            <a href="wa.php" class="fa fa-chevron-circle-left" style="margin-left:20px;" data-toggle="popover" title="Back" data-content="BACK"></a>
                            Set Wallet Pin
                        </h1>
                    </div>
                    <form style="text-align:center" method="post" action="walletPinVali.php">
                        <div>
                            <!--check customer status is in wActivate=2 2 means activate but not set pin yet or not -->
                            <?php 
                                $res=mysqli_query($conn,"SELECT * FROM customer where wActivate=2 and cusID='".$_SESSION['user']."'");
                                //if not exist 
                                if(mysqli_num_rows($res)!=1){
                                    //redirect to 404
                                    header("location: 404page.php");
                                }
                            
                            ?>
                            <p>
                            <div style="margin-left: -16em; color:black;"><label for="">Enter Pin</label></div>
                            <input type="password" maxlength="1" name="v1" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v2" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v3" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v4" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v5" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v6" required pattern="[0-9]{1}"/>
                            </p>
                            <p>
                                
                            <div style="margin-left: -15em; color:black;"><label for="">Re-enter PIN</label></div>
                            <input type="password" maxlength="1" name="cv1" requiredd pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="cv2" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="cv3" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="cv4" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="cv5" required pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="cv6" required pattern="[0-9]{1}"/>
                            </p>
                            <div>
                                <button style="margin: 20px;" name="setpass">Continue</button>
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

<script>
    $("input").keyup(function() {
    if($(this).val().length >= 1) {
      var input_flds = $(this).closest('form').find(':input');
      input_flds.eq(input_flds.index(this) + 1).focus();
    }
});
</script>

<?php
    if(isset($_SESSION['fail'])){ ?>
            <script>
   
                Swal.fire(
                    'Error',
                    '<?php echo $_SESSION['fail'];?>',
                    'Info'
                );

            </script>
        <?php 
            unset($_SESSION['fail']);
} ?>