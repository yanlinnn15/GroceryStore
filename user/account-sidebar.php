<?php 
    include('partials_front/header.php');
    include('partials_front/loginCheck.php');
?>

<link rel="stylesheet" href="assets/css/emm.css">
<!-- Main Content Begin -->
<div class="main-content main-content-contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="trail-item trail-end active">
                            My Account
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--account side bar start here-->
    <div class="account-page-area section-space-y-axis-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="account-dashboard-tab" data-bs-toggle="tab" href="account.php" role="tab" aria-controls="account-dashboard" aria-selected="true">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="account-dashboard-tab" data-bs-toggle="tab" href="wa.php" role="tab" aria-controls="account-dashboard" aria-selected="true">My Wallet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="account-orders-tab" data-bs-toggle="tab" href="order.php" role="tab" aria-controls="account-orders" aria-selected="false">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="address.php" role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="account-logout-tab" href="logout.php" role="tab" aria-selected="false">Logout</a>
                        </li>
                    </ul>
                </div>

