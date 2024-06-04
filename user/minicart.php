<div class="block-minicart gnash-mini-cart block-header gnash-dropdown" id="minicart">
    <a href="javascript:void(0);" class="shopcart-icon" data-gnash="gnash-dropdown">
        Cart
        <?php if(isset($_SESSION['user'])){ ?>
        <span class="count"></span> <?php } ?>
    </a>
    <?php
        if(isset($_SESSION['user'])){?>
            <div class="shopcart-description gnash-submenu">
            <div class="content-wrap">
            <div id="mini-cart-content"> </div>
            
        </div>
    </div>

<?php }else{ ?>
    <div class="no-product gnash-submenu">
        <p class="text">
            You haven't Sign In :( <br>
            <span>
                <a href="login-register.php">Login / Register</a>   
            </span>
        </p>
    </div>
<?php }?>