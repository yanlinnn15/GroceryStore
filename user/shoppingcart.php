<?php include('partials_front/header.php'); ?>
<?php include('partials_front/loginCheck.php'); ?>

<div class="site-content">
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin">
                        <a href="index.php">
								<span>
									Home
								</span>
                        </a>
                    </li>
                    <li class="trail-item trail-end active">
							<span>
								Shopping Cart
							</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="main-content-cart main-content col-sm-12">
                <h3 class="custom_blog_title">
                Shopping Cart
                </h3>
                <div class="page-main-content">
                    <div class="shoppingcart-content">
                    <div class="display">
                        
                    </div>
                </div>
                </div>
            </div>
            </div>
            </div>
            </div>
        </div>
    </main>
</div>
<?php include('partials_front/footer.php'); ?>

<script>
    load_cart();
    function load_cart()
    {
        $.ajax({
            url:"display_cart.php",
            method:"POST",
            dataType:"json",
            success:function(data)
            {
                $('.display').html(data.cartcontent);
            }
        });
    }
</script>