<?php include('partials_front/header.php'); ?>
<?php 
	if(isset($_SESSION['user'])){
		$rescheck=mysqli_query($conn,"SELECT * from customer where cstatus=1 and cusID='".$_SESSION['user']."'");
		if(mysqli_num_rows($rescheck)!=1){
			unset($_SESSION['user']);
			$_SESSION['inactive']="Your account is inactive!";
			header("location:".SITEURL."user/login-register.php");
		}
	}
?>
<div class="main-content main-content-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            About Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-about col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <h3 class="custom_blog_title">About Us</h3>
                    <div class="page-main-content">
                        <div class="header-banner banner-image">
                            <div class="banner-wrap">
                                <div class="banner-header">
                                    <div class="col-lg- col-md-offset-7">
                                        <div class="content-inner">
                                            <h2 class="title">
                                                We are
                                            </h2>
                                            <div class="sub-title">
                                                Providing Fresh Food  <br>
                                                Deliver Quality and Fresh product
                                            </div>
                                            <a href="gridproducts.php" class="gnash-button button">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="gnash-iconbox  layout1">
                                    <div class="iconbox-inner">
                                        <div class="icon-item">
                                            <span class="placeholder-text">01</span>
                                            <span class="icon flaticon-rocket-ship"></span>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                Johor Free Delivery
                                            </h4>
                                            <div class="text">
                                                Free Delivery on all order from Johor with price more than RM 90.00 only
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1">
                                <div class="gnash-iconbox  layout1">
                                    <div class="iconbox-inner">
                                        <div class="icon-item">
                                            <span class="placeholder-text">02</span>
                                            <span class="icon flaticon-rocket-ship"></span>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                Fast Delivery
                                            </h4>
                                            <div class="text">
                                                Fast and Deliver On Time!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="team-member">
                            <div class="row">
                                <div class="col-sm-12 border-custom">
                                    <span></span>
                                </div>
                            </div>
                            <h2 class="custom_blog_title center" style="color: #8eb359;">
                                Fresh Grocers Important Persons
                            </h2>
                            <div class="team-member-slider nav-center owl-slick"
                                 data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}'
                                 data-responsive='[{"breakpoint":"0","settings":{"slidesToShow":1}},{"breakpoint":"480","settings":{"slidesToShow":1}},{"breakpoint":"767","settings":{"slidesToShow":2}},{"breakpoint":"991","settings":{"slidesToShow":3}},{"breakpoint":"1199","settings":{"slidesToShow":3}},{"breakpoint":"2000","settings":{"slidesToShow":3}}]'>
                                <div class="gnash-team-member">
                                    <div class="team-member-item">
                                        <!--<div class="member_avatar">
                                            <img src="assets/images/YL1.jpg" alt="img">
                                        </div>-->
                                        <h5 class="member_name">Tan Yan Lin</h5>
                                        <div class="member_position">
                                        </div>
                                    </div>
                                </div>
                                <div class="gnash-team-member">
                                    <div class="team-member-item">
                                        <!--<div class="member_avatar">
                                            <img src="assets/images/CJY.jpg" alt="img">
                                        </div>-->
                                        <h5 class="member_name">Chiang Joe Yee</h5>
                                        <div class="member_position">
                                        </div>
                                    </div>
                                </div>
                                <div class="gnash-team-member">
                                    <div class="team-member-item">
                                        <!--<div class="member_avatar">
                                            <img src="assets/images/TY.jpg" alt="img">
                                        </div>-->
                                        <h5 class="member_name">Ng Tze Yang</h5>
                                        <div class="member_position">
                                        </div>
                                    </div>
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