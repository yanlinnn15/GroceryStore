<?php 
    ob_start();
    include ('../config/connect.php');
    include('partials/loginCheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Fresh Grocers Admin Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard1.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- page css -->
    <link href="css/pages/icon-page.css" rel="stylesheet">
    <link rel="stylesheet" href="../js/bootstrap-icons.css" />
    <script src="../js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!--<div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Wrap</p>
        </div>
    </div> -->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">

                            <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/images/logo.png" alt="homepage" class="dark-logo"  />
                            <!-- Light Logo icon -->
                            <!-- Logo text --><span>
                            <!-- dark Logo text -->
                          
                            <!-- Light Logo text -->    
                            <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" /></span> </a>
                        </b>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"></a>
                            
                        </li>

                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <?php
                                $aid=$_SESSION['admin'];
                                $res=mysqli_query($conn,"SELECT aName from admin where adminID='$aid'");
                                $row=mysqli_fetch_assoc($res);
                            ?>
                            
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" style="font-size: 16px;" href="pages-profile.php">Hello,&nbsp;&nbsp;<?php echo $row['aName']; ?>&nbsp;</a> 
                            <a href="logout.php" class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"><i class="fa fa-sign-out" style="font-size: 25px; text-align:center; margin-top:15px;"></i></a>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar ">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
				
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav ">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
						
                        <!--<li> <a class="waves-effect waves-dark" href="pages-profile.php" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">Profile</span></a>
                        </li>--> 
						
                        <?php if(isset($_SESSION['adminType'])){
                            if($_SESSION['adminType']=="SuperAdmin"){?>
                                    <li> <a class="waves-effect waves-dark" href="adminlist.php" aria-expanded="false"><i class="fa fa-drivers-license-o"></i><span class="hide-menu">Admin List</span></a>
                        </li>

                        <?php    }   

                        }?>
						
						<li> <a class="waves-effect waves-dark" href="product.php" aria-expanded="false"><i class="fa fa-shopping-bag"></i><span class="hide-menu">Product</span></a>
                        </li>
						<li> <a class="waves-effect waves-dark" href="category.php" aria-expanded="false"><i class="fa fa-list-alt"></i><span class="hide-menu">Product Category</span></a>
                        </li>
						<!--<li> <a class="waves-effect waves-dark" href="paymentmethod.php" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Payment Method</span></a>
                        </li>
						<li> <a class="waves-effect waves-dark" href="shipmentmethod.php" aria-expanded="false"><i class="fa fa-car"></i><span class="hide-menu">Shipment Method</span></a>
                        </li>-->
						<li class='sub-menu'><a class="waves-effect waves-dark" href="allorder.php" aria-expanded="false"><i class="fa fa-file-text"></i><span class="hide-menu">Order&nbsp;<div class='fa fa-caret-down right'></div></span></a>
                            <ul>
                                <li><a href='allorder.php'>All Orders</a></li>
                                <li><a href='order-topay.php'>To Pay</a></li>
                                <li><a href='order-toship.php'>To Ship</a></li>
                                <li><a href='order-od.php'>Out for Delivery</a></li>
                                <li><a href='order-delivered.php'>Delivered Orders</a></li>
                                <li><a href='order-cp.php'>Completed Orders</a></li>
                                <li><a href='order-cancel.php'>Cancelled Orders</a></li>
                            </ul>
                        </li>
                        
						<li> <a class="waves-effect waves-dark" href="customer.php" aria-expanded="false"><i class="fa fa-user-o"></i><span class="hide-menu">Customer</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="timeslot.php" aria-expanded="false"><i class="fa fa-clock-o"></i><span class="hide-menu">Time Slot</span></a>
                        </li>
						<li> <a class="waves-effect waves-dark" href="reviewproduct.php" aria-expanded="false"><i class="fa fa-comments"></i><span class="hide-menu">Review</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="contactus.php" aria-expanded="false"><i class="fa fa-envelope-o"></i><span class="hide-menu">Contact</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="productlowstock.php" aria-expanded="false"><i class="fa fa-refresh"></i><span class="hide-menu">Product Low Stock</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false"><i class="fa fa-sign-out"></i><span class="hide-menu">Log Out</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->