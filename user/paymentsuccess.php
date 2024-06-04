<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      .bo {
        text-align: center;
        padding: 40px 0;
        background: f2f2f2;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>

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
            <div class="bo">

              <div class="card">
              <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark">✓</i>
              </div>
                <h1>Success </h1> 
                <p>We received your purchase request;<br/> we'll be in touch shortly!</i></p>
                <p><a href="order.php" class="button">Go to Order</a></p>
                <p><a href="index.php" class="button">Go to Home</a></p>
              </div>
            </div>
      
        </div>
    </main>
</div>
<?php include('partials_front/footer.php'); ?>