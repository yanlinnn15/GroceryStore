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

.alert {
  padding: 20px;
  background-color: #ff9800;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>


<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <h1 class="custom_blog_title">
                            <a href="wa.php" class="fa fa-chevron-circle-left" style="margin-left:20px;" data-toggle="popover" title="Back" data-content="BACK"></a>
                            <?php if(isset($_GET['a'])){ ?>

                                FORGOT WALLET PIN 
                                
                            <?php }else{ ?>
                                Wallet Activation 
                            <?php } ?>
                        </h1>
                    </div>
                    <form style="text-align:center" action="code.php" method="post">
                        <div>
                            <p><label style="color: grey;">Your code is sent to your email !</label></p>
                            <input type="password" maxlength="1" name="v1" require pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v2" require pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v3" require pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v4" require pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v5" require pattern="[0-9]{1}"/>
                            <input type="password" maxlength="1" name="v6" require pattern="[0-9]{1}"/>
                            <div>
                                <button style="margin: 20px;" name="submitcode">Continue</button>
                            </div>
                        </div>
                        <div>Haven't received the code? <a href="">Resend</a></div>
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