<?php 
    ob_start();
    include ('../config/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fresh Grocers</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image" href="assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../js/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="assets/css/jquery.scrollbar.min.css">
    <link rel="stylesheet" href="assets/css/mobile-menu.css">
    <link rel="stylesheet" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="../js/sweetalert2.all.min.js"></script>
</head>
<style>
    .swal2-popup { width: 500px;
	    font-size:16px;
    }
    form i {
    margin-left: -30px;
    cursor: pointer;
}
</style>
</style>
<body class="home">
<header class="header style7">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <div class="header-message">
                    <?php if(isset($_SESSION['user'])){
                        $id=$_SESSION['user']; 
                        $sql="SELECT cusLName FROM customer where cusID='$id'"; //GET customer  last name
                        $res=mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($res);
                        $fname=$row['cusLName'];
                        ?>
                        Welcome, <?php echo $fname; ?> ! 
                        <?php }else{ ?>Welcome to Fresh Grocers! <?php } ?>
                </div>
            </div>
            <div class="top-bar-right">
                <ul class="header-user-links">
                    <?php if(isset($_SESSION['user'])){
                            $id=$_SESSION['user'];
                            $sql1="SELECT * FROM customer where cusID='$id' limit 1";
                            $res1=mysqli_query($conn,$sql1);
                            $row = mysqli_fetch_assoc($res1);
                            if(mysqli_num_rows($res1)==1){ $wallet=$row['walletAmount'];?>
                                <?php if($row['wActivate']==1){ ?>
                                    <li><a href="<?php echo SITEURL; ?>user/wa.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 -1 16 16">
                                    <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
                                    
                                    </svg>  RM <?php echo $wallet; ?></a></li>
                               <?php }else if($row['wActivate']==2){ ?>

                                <a href="wa.php" class="" style="padding:8px; background-color:white; color:green; border-radius:2px; opacity:0.89;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" fill="currentColor" class="bi bi-wallet" viewBox="0 -1 16 16">
                                <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
                                
                                </svg>&nbsp;Set Pin</a></li>


                            <?php   ?>
                            <?php }else{ ?>

                                <li><a href="wa.php" class="" style="padding:8px; background-color:white; color:green; border-radius:2px; opacity:0.89;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" fill="currentColor" class="bi bi-wallet" viewBox="0 -1 16 16">
                                <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
                                
                                </svg>&nbsp;Activate Wallet</a></li>
                                
                            <?php }}
                            
                            ?>
                        
                    <?php }else{ ?>
                        <li><a href="login-register.php">Login or Register</a></li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main-header">
            <div class="row">
                <div class="col-lg-3 col-sm-4 col-md-3 col-xs-7 col-ts-12 header-element">
                    <div class="logo">
                        <a href="index.php">
                            <img src="assets/images/logo.png" alt="img">
                        </a>
                    </div>
                </div>
                <!-- search product by keyword form-->
                <div class="col-lg-7 col-sm-8 col-md-6 col-xs-5 col-ts-12">
                    <div class="block-search-block">
                        <form class="form-search form-search-width-category" method="POST">
                            <div class="form-content">
                                <div class="inner">
                                    <input type="text" class="input" name="search" value="" placeholder="Search here">
                                </div>
                                <div class="category">
                                    <select title="cate" data-placeholder="All Categories" class="chosen-select"
                                            tabindex="1" name="cate">
                                        <?php $sql1="SELECT * FROM category";
                                            $res1=mysqli_query($conn,$sql1);
                                            if($res1){ ?>
                                                <option value="">All</option>
                                                <?php if(mysqli_num_rows($res1)>0){ //check only
                                                    while($row=mysqli_fetch_assoc($res1)){
                                                        $cateID=$row['categoryID'];
                                                        $cateName=$row['categoryName']; ?>
                                                        <option value="<?php echo $cateID; ?>"><?php echo $cateName; ?></option>
                                                    <?php }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                    

                                <button class="btn-search" type="submit" name="searchsubmit">
                                    <span class="icon-search"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end of search product by keyword form-->
                <div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
                    <div class="header-control">
                        <!--<div class="block-account block-header gnash-dropdown">
                            <a href="wishlist.php">
                                <span class="fa fa-heart-o"></span>
                            </a>
                        </div>-->
                        

                        <div class="minicartid">
                            <?php include('minicart.php'); ?>
                        </div>
                        
                        <div class="block-account block-header gnash-dropdown">
                            <?php if(isset($_SESSION['user'])){ ?>
                                <a href="account.php"> <!--data-gnash="gnash-dropdown"-->
                            <?php }else{ ?>
                                <a href="login-register.php">
                            <?php } ?>
                                <span class="flaticon-user"></a></span>
                                
                                
                                
                            </a>
                        </div>
                        <a class="menu-bar mobile-navigation menu-toggle" href="index.php">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- category -->
    <div class="header-nav-container rows-space-20">
        <div class="container">
            <div class="header-nav-wapper main-menu-wapper">
                <div class="vertical-wapper block-nav-categori">
                    <div class="block-title">
							<span class="icon-bar">
								<span></span>
								<span></span>
								<span></span>
							</span>
                        <span class="text">All Categories</span>
                    </div>
                    <div class="block-content verticalmenu-content">
                        <ul class="gnash-nav-vertical vertical-menu gnash-clone-mobile-menu">
                            <?php $sql2="SELECT * FROM category";
                                $res2=mysqli_query($conn,$sql2);
                                if($res2){
                                    if(mysqli_num_rows($res2)>0){ //check only
                                        while($row=mysqli_fetch_assoc($res2)){
                                            $cateID=$row['categoryID'];
                                            $cateName=$row['categoryName']; ?>
                                                <li class="menu-item">
                                                <a href="<?php echo SITEURL; ?>user/gridproducts.php?cateid=<?php echo $cateID;?>" class="gnash-menu-item-title" title="<?php echo $cateName;?>"><?php echo $cateName;?></a>
                                            </li>
                                        <?php }
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="header-nav">
                    <div class="container-wapper">
                        <ul class="gnash-clone-mobile-menu gnash-nav main-menu " id="menu-main-menu">
                            <li class="menu-item">
                                <a href="index.php" class="gnash-menu-item-title" title="Home">Home</a>
                                
                            </li>
                            <li class="gnash-clone-mobile-menu gnash-nav main-menu "> 
                                <a href="gridproducts.php?page=1" class="gnash-menu-item-title" title="Product">SHOP</a>
                                <!--<span class="toggle-submenu"></span>menu-item menu-item-has-children
                                <ul class="submenu">
                                    <li class="menu-item menu-item-has-children">
                                        <a href="gridproducts.php?page=1" class="gnash-menu-item-title" title="Product">SHOP</a>
                                        <span class="toggle-submenu"></span>
                                        <ul class="submenu">
                                            <li><a href="">Haha</a></li>
                                            <li><a href="">Haha</a></li>
                                            <li><a href="">Haha</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Haha</a></li>
                                    <li><a href="">Haha</a></li>
                                </ul>
                            </li>-->

                            <!--<li class="menu-item">
                                <a href="membership.php" class="gnash-menu-item-title" title="Membership">MEMBERSHIP</a>
                            </li>-->

                            <li class="menu-item">
                                <a href="about.php" class="gnash-menu-item-title" title="About US">ABOUT</a>
                            </li>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="header-device-mobile">
    <div class="wapper">
        <div class="item mobile-logo">
            <div class="logo">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="img">
                </a>
            </div>
        </div>
        <div class="item item mobile-search-box has-sub">
            <a href="#">
						<span class="icon">
							<i class="fa fa-search" aria-hidden="true"></i>
						</span>
            </a>
            <div class="block-sub">
                <a href="#" class="close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <div class="header-searchform-box">
                    <form class="header-searchform" method="POST">
                        <div class="searchform-wrap">
                            <input type="text" class="search-input" placeholder="Enter keywords to search..." name="search">
                            <input type="hidden" name="cate" value="">
                            <input type="submit" class="searchsubmit" name="searchsubmit" value="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </a>
        </div>
    </div>
</div>

<!-- passing the keyword data to the product page -->
<?php 
    if(isset($_POST['searchsubmit'])){
        if($_POST['search']!="" && $_POST['cate']!=""){
            header("location:".SITEURL."user/gridproducts.php?keyword=".$_POST['search']."&cateid=".$_POST['cate']);
        }else if($_POST['search']!="" && $_POST['cate']==""){
            header("location:".SITEURL."user/gridproducts.php?keyword=".$_POST['search']);
        }else if($_POST['search']=="" && $_POST['cate']!=""){
            header("location:".SITEURL."user/gridproducts.php?cateid=".$_POST['cate']);
        }else if($_POST['search']=="" && $_POST['cate']==""){
            header("location:".SITEURL."user/gridproducts.php");
        }

    }
?>
<!-- end -->