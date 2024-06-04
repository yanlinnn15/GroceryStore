<footer class="footer style7">
    <div class="container">
        <div class="container-wapper">
            <div class="row">
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-sm hidden-md hidden-lg">
                    <div class="gnash-newsletter style1">
                        
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="gnash-custommenu default">
                        <h2 class="widgettitle">Payment Accepted</h2>
                        <ul class="menu">
                            <li class="menu-item" style="width:15em; margin-left:60px;" >
                               <img src="assets/images/pay.png" alt="">
                            </li>
                            
                            
                        </ul>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="gnash-custommenu default">
                        <h2 class="widgettitle">Information</h2>
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="faq.php">FAQs</a>
                            </li>
                            <li class="menu-item">
                                <a href="contact.php">Contact Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="about.php">About Us</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-xs">
                    <div class="gnash-newsletter style1">
                        <div class="newsletter-head">
                            <h3 class="title"><a href="contact.php">Contact Us</a></h3>
                            <ul class="menu">
                            <li class="menu-item">
                                <a href="mailto:ffreshgrocers@gmail.com">ffreshgrocers@gmail.com</a>
                            </li>
                            <li class="menu-item">
                                <a href="tel:+60166122132">+(60)-16 612 2132</a>
                            </li>
                        </ul>
                        </div>
                        
                    </div>
                </div>
               
            </div>
            <div class="footer-end">
            </div>
        </div>
    </div>
</footer>
<div class="footer-device-mobile">
    <div class="wapper">
        <div class="footer-device-mobile-item device-home">
            <a href="index.php">
					<span class="icon">
						<i class="fa fa-home" aria-hidden="true"></i>
					</span>
                Home
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <a href="gridproducts.php">
					<span class="icon">
						<i class="fa fa-shopping-bag" aria-hidden="true"></i>
					</span>
                <span class="text">Shop</span>
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <?php if(isset($_SESSION['user'])){ ?>
                <a href="shoppingcart.php"> <?php }else{ ?>
                    <a href="login-register.php">
                <?php } ?>
					<span class="icon">
						<i class="fa fa-shopping-basket" aria-hidden="true"></i>
					</span>
                <span class="text">Cart</span>
            </a>
        </div>

        
        <div class="footer-device-mobile-item device-home">
            <?php if(isset($_SESSION['user'])){ ?>
                <a href="account.php"> <?php }else{ ?>
                    <a href="login-register.php">
                <?php } ?>
					<span class="icon">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
                Account
            </a>
        </div>
    </div>
</div>
<a href="#" class="backtotop">
    <i class="fa fa-angle-double-up"></i>
</a>
<script src="assets/js/jquery-1.12.4.min.js"></script>
<script src="assets/js/jquery.plugin-countdown.min.js"></script>
<script src="assets/js/jquery-countdown.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/jquery.scrollbar.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/mobile-menu.js"></script>
<script src="assets/js/chosen.min.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/jquery.elevateZoom.min.js"></script>
<script src="assets/js/jquery.actual.min.js"></script>
<script src="assets/js/fancybox/source/jquery.fancybox.js"></script>
<script src="assets/js/lightbox.min.js"></script>
<script src="assets/js/owl.thumbs.min.js"></script>
<script src="assets/js/jquery.scrollbar.min.js"></script>
<script src='https://ditu.google.cn/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
<script src="assets/js/frontend-plugin.js"></script>
<script src="cartact.js"></script> <!-- for cart -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>