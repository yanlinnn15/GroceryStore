<?php include('partials_front/header.php'); ?>

<div class="main-content main-content-404 right-sidebar">
    <div class="container">
        <div class="row">
            <div class="content-area content-404 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    <section class="error-404 not-found">
                        <div class="images">
                            <img src="assets/images/404.png" alt="img">
                        </div>
                        <div class="text-404">
                            <h1 class="page-title">
                                Error 404 Not Found
                            </h1>
                            <p class="page-content">
                                <?php if(isset($_SESSION['user'])){ ?>
                                We're sorry but the page you are looking for does nor exist. <br/> <?php }else{?>
                                We're sorry but the page you are looking for does nor exist or you may need to Log In to access this page. <a href="login-register.php"><strong>Log In</strong></a> <?php }?>
                                <p><a href="index.php" class="gnash-button button" style="margin: auto"> Return to Home page</a></p>
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('partials_front/footer.php'); ?>