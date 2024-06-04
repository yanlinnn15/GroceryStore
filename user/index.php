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

<div class="fullwidth-template">
        <div class="home-slider style1 rows-space-30">
            <div class="container">
                <div class="slider-owl owl-slick equal-container nav-center"
                     data-slick='{"autoplay":true, "autoplaySpeed":9000, "arrows":true, "dots":false, "infinite":true, "speed":1000, "rows":1}'
                     data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1}}]'>
                    <div class="slider-item style1">
                        <div class="slider-inner equal-element">
                            <div class="slider-infor">
                                <h5 class="title-small">
                                   <br>
                                </h5>
                                <h3 class="title-big">
                                   &nbsp;<br/>
                                    &nbsp;
                                </h3>
                                <div class="price">
                                    &nbsp;
                                    <span class="number-price">
											&nbsp;
										</span>
                                </div>
                                &nbsp;<br>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item style3">
                        <div class="slider-inner equal-element">
                            <div class="slider-infor">
                                <h5 class="title-small">
                                    &nbsp;
                                </h5>
                                <h3 class="title-big">
                                    &nbsp;<br>
                                    &nbsp;
                                </h3>
                                <div class="price">
                                    &nbsp;
                                    
                                    <span class="number-price">
											&nbsp;
										</span>
                                </div>
                                &nbsp;<br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gnash-product produc-featured rows-space-65">
            <div class="container">
                <h3 class="custommenu-title-blog">
                    Sales
                </h3>
                <div class="owl-products owl-slick equal-container nav-center"
                     data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":false, "dots":true, "infinite":false, "speed":800, "rows":1}'
                     data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":4}},{"breakpoint":"1200","settings":{"slidesToShow":3}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>
                    
                     <?php
                        $sql4="SELECT * FROM product where discountPercent>0 and productStatus='A' and pQty>0";
                        $res4=mysqli_query($conn,$sql4);
                        if(mysqli_num_rows($res4)>0){
                            while($row4=mysqli_fetch_assoc($res4)){
                                $proImage1 = $row4['pImage1'];
                                $proName = $row4['pName'];
                                $prorice=$row4['pPrice'];
                                $proID =$row4['productID'];
                                $addeddate=$row4['AddedTime'];
                                $ppqty=$row4['pQty'];
                        ?>
                
                        <div class="product-item style-5">
                                <div class="product-inner equal-element">
                                    <div class="product-top">
                                    <?php if((time()-(60*60*24*7)) < strtotime($addeddate)){?>
                                        <div class="flash">
													<span class="onnew">
														<span class="text">
															new
														</span>
													</span> 
                                        </div><?php }?>
                                    </div>
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $proID;?>">
                                                <img src="<?php echo $proImage1; ?>" alt="img" style="margin:auto;">
                                            </a>
                                            <?php if($ppqty>0){ ?>
                                            <div class="thumb-group">
                                                <div class="loop-form-add-to-cart">
                                                    <input type="hidden" name="hiddenQty" id="quantity<?php echo $proID;?>" value="1">
                                                    <input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $proID;?>" value="<?php echo $ppqty; ?>">
                                                    <button type="button" name="submitcart" id="<?php echo $proID;?>" class="single_add_to_cart_button button submitcart">
                                            <?php }else{ ?>
                                                    <div class="thumb-group" style="background-color: grey;">
                                                    <div class="loop-form-add-to-cart">
                                                        <input type="hidden" name="hiddenQty" id="quantity<?php echo $proID;?>" value="1">
                                                        <input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $proID;?>" value="<?php echo $ppqty; ?>">
                                                        <button type="button" name="submitcart" id="<?php echo $proID;?>" style="background-color: grey;" class="single_add_to_cart_button button submitcart" disabled>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $proID;?>"><?php echo $proName; ?></a>
                                        </h5>
                                        <div class="group-info">
                                        <?php
                                            $resrw=mysqli_query($conn,"select avg(rating) as 'rate',count(*) as 'ttl' from review where productID='$proID'");
                                            if(mysqli_num_rows($resrw)>0){
                                                $rowrw=mysqli_fetch_assoc($resrw);
                                                if($rowrw['ttl']>1){
                                                    $front=intval($rowrw['rate']);
                                                    if($rowrw['rate']>$front){
                                                        $end2=5;
                                                    }else{
                                                        $end2=0;
                                                    } ?>

                                                <div class="stars-rating">
                                                    <div class="star-rating">
                                                        <span class="star-<?php echo $front; ?>-<?php echo $end2; ?>"></span>
                                                    </div>
                                                    <div class="count-star">
                                                        (<?php echo $rowrw['ttl']; ?>)
                                                    </div>
                                                </div>
                                                

                                            <?php }else{ ?>
                                                <div class="stars-rating">
                                                &nbsp;
                                                </div>
                                            <?php }}

                                        ?>
                                            <div class="price">
                                                <?php if(!empty($row4['discountPercent'])){ ?>
                                                    <del>
                                                        RM <?php echo $prorice; ?>
                                                    </del>
                                                    <ins>
                                                        RM <?php echo number_format($prorice*((100-$row4['discountPercent'])/100), 2, '.', ','); ?>
                                                    </ins>
                                                    <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
                                                    <?php echo $row4['discountPercent']." % OFF"; ?>
                                                </span> 
                                               <?php }else{ ?>
                                                <ins>
                                                    RM <?php echo number_format($prorice*((100-$row4['discountPercent'])/100), 2, '.', ','); ?>
                                                </ins>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-wrapp rows-space-65">
            <div class="container">
                <div class="banner">
                    <div class="item-banner style17">
                        <div class="inner">
                            <div class="banner-content">
                                <h3 class="title">Free Shipping</h3>
                                <div class="description">
                                    <br>
                                </div>
                                <div class="banner-price">
                                    Start from:
                                    <span class="number-price">RM 90.00</span>
                                </div>
                                <a href="gridproducts.php" class="button btn-shop-now">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gnash-tabs  default rows-space-40">
            <div class="container">
                <h3 class="custommenu-title-blog product">
                    Our Products
                </h3>
                <div class="tab-head">
                    <ul class="tab-link">
                        <li class="active">
                            <a data-toggle="tab" aria-expanded="true" href="#bestseller">Bestseller</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" aria-expanded="true" href="#top-rated">Top Rated</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-container">
                    <div id="bestseller" class="tab-panel active">
                        <div class="gnash-product">
                            <ul class="row list-products auto-clear equal-container product-grid">
                            <?php
                                $sql4="select * from product, orderdetail, orderp where orderdetail.orderID=orderp.orderID and product.productID=orderdetail.productID and orderp.status!=1 and orderp.status!=7 and productStatus='A' and pQty>0 group by product.productID order by sum(qty) desc limit 8; ";
                                $res4=mysqli_query($conn,$sql4);
                                if(mysqli_num_rows($res4)>0){
                                    while($row4=mysqli_fetch_assoc($res4)){
                                        $proImage1 = $row4['pImage1'];
                                        $proName = $row4['pName'];
                                        $prorice=$row4['pPrice'];
                                        $proID =$row4['productID'];
                                        $addeddate=$row4['AddedTime'];
                                        $ppqty=$row4['pQty'];
                                ?>
                         <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                <div class="product-inner equal-element">
                                    <div class="product-top">
                                    <?php if((time()-(60*60*24*7)) < strtotime($addeddate)){?>
                                        <div class="flash">
													<span class="onnew">
														<span class="text">
															new
														</span>
													</span> 
                                        </div><?php }?>
                                    </div>
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $proID;?>">
                                                <img src="<?php echo $proImage1; ?>" alt="img" style="margin:auto;">
                                            </a>
                                            <?php if($ppqty>0){ ?>
                                            <div class="thumb-group">
                                                <div class="loop-form-add-to-cart">
                                                    <input type="hidden" name="hiddenQty" id="quantity<?php echo $proID;?>" value="1">
                                                    <input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $proID;?>" value="<?php echo $ppqty; ?>">
                                                    <button type="button" name="submitcart" id="<?php echo $proID;?>" class="single_add_to_cart_button button submitcart">
                                            <?php }else{ ?>
                                                    <div class="thumb-group" style="background-color: grey;">
                                                    <div class="loop-form-add-to-cart">
                                                        <input type="hidden" name="hiddenQty" id="quantity<?php echo $proID;?>" value="1">
                                                        <input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $proID;?>" value="<?php echo $ppqty; ?>">
                                                        <button type="button" name="submitcart" id="<?php echo $proID;?>" style="background-color: grey;" class="single_add_to_cart_button button submitcart" disabled>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $proID;?>"><?php echo $proName; ?></a>
                                        </h5>
                                        <div class="group-info">
                                        <?php
                                            $resrw=mysqli_query($conn,"select avg(rating) as 'rate',count(*) as 'ttl' from review where productID='$proID'");
                                            if(mysqli_num_rows($resrw)>0){
                                                $rowrw=mysqli_fetch_assoc($resrw);
                                                if($rowrw['ttl']>0){
                                                    $front=intval($rowrw['rate']);
                                                    if($rowrw['rate']>$front){
                                                        $end2=5;
                                                    }else{
                                                        $end2=0;
                                                    } ?>

                                                <div class="stars-rating">
                                                    <div class="star-rating">
                                                        <span class="star-<?php echo $front; ?>-<?php echo $end2; ?>"></span>
                                                    </div>
                                                    <div class="count-star">
                                                        (<?php echo $rowrw['ttl']; ?>)
                                                    </div>
                                                </div>
                                                

                                            <?php }else{ ?>
                                                <div class="stars-rating">
                                                &nbsp;
                                                </div>
                                            <?php }}

                                        ?>
                                            <div class="price">
                                                <?php if(!empty($row4['discountPercent'])){ ?>
                                                    <del>
                                                        RM <?php echo $prorice; ?>
                                                    </del>
                                                    <ins>
                                                        RM <?php echo number_format($prorice*((100-$row4['discountPercent'])/100), 2, '.', ','); ?>
                                                    </ins>
                                                    <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
                                                    <?php echo $row4['discountPercent']." % OFF"; ?>
                                                </span> 
                                               <?php }else{ ?>
                                                <ins>
                                                    RM <?php echo number_format($prorice*((100-$row4['discountPercent'])/100), 2, '.', ','); ?>
                                                </ins>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } }?>
                        </div>
                    </div>
                    <!-- Top Rate -->
                    <div id="top-rated" class="tab-panel">
                        <div class="gnash-product">
                            <ul class="row list-products auto-clear equal-container product-grid">
                            <?php
                                $sql4="select * from product,review where product.productID=review.productID and productStatus='A' and pQty>0 group by product.productID order by avg(rating) desc limit 8; ";
                                $res4=mysqli_query($conn,$sql4);
                                if(mysqli_num_rows($res4)>0){
                                    while($row4=mysqli_fetch_assoc($res4)){
                                        $proImage1 = $row4['pImage1'];
                                        $proName = $row4['pName'];
                                        $prorice=$row4['pPrice'];
                                        $proID =$row4['productID'];
                                        $addeddate=$row4['AddedTime'];
                                        $ppqty=$row4['pQty'];
                                ?>
                         <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                <div class="product-inner equal-element">
                                    <div class="product-top">
                                    <?php if((time()-(60*60*24*7)) < strtotime($addeddate)){?>
                                        <div class="flash">
													<span class="onnew">
														<span class="text">
															new
														</span>
													</span> 
                                        </div><?php }?>
                                    </div>
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $proID;?>">
                                                <img src="<?php echo $proImage1; ?>" alt="img" style="margin:auto;">
                                            </a>
                                            <?php if($ppqty>0){ ?>
                                            <div class="thumb-group">
                                                <div class="loop-form-add-to-cart">
                                                    <input type="hidden" name="hiddenQty" id="quantity<?php echo $proID;?>" value="1">
                                                    <input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $proID;?>" value="<?php echo $ppqty; ?>">
                                                    <button type="button" name="submitcart" id="<?php echo $proID;?>" class="single_add_to_cart_button button submitcart">
                                            <?php }else{ ?>
                                                    <div class="thumb-group" style="background-color: grey;">
                                                    <div class="loop-form-add-to-cart">
                                                        <input type="hidden" name="hiddenQty" id="quantity<?php echo $proID;?>" value="1">
                                                        <input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $proID;?>" value="<?php echo $ppqty; ?>">
                                                        <button type="button" name="submitcart" id="<?php echo $proID;?>" style="background-color: grey;" class="single_add_to_cart_button button submitcart" disabled>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $proID;?>"><?php echo $proName; ?></a>
                                        </h5>
                                        <div class="group-info">
                                        <?php
                                            $resrw=mysqli_query($conn,"select avg(rating) as 'rate',count(*) as 'ttl' from review where productID='$proID'");
                                            if(mysqli_num_rows($resrw)>0){
                                                $rowrw=mysqli_fetch_assoc($resrw);
                                                if($rowrw['ttl']>0){
                                                    $front=intval($rowrw['rate']);
                                                    if($rowrw['rate']>$front){
                                                        $end2=5;
                                                    }else{
                                                        $end2=0;
                                                    } ?>

                                                <div class="stars-rating">
                                                    <div class="star-rating">
                                                        <span class="star-<?php echo $front; ?>-<?php echo $end2; ?>"></span>
                                                    </div>
                                                    <div class="count-star">
                                                        (<?php echo $rowrw['ttl']; ?>)
                                                    </div>
                                                </div>
                                                

                                            <?php }else{ ?>
                                                <div class="stars-rating">
                                                &nbsp;
                                                </div>
                                            <?php }}

                                        ?>
                                            <div class="price">
                                                <?php if(!empty($row4['discountPercent'])){ ?>
                                                    <del>
                                                        RM <?php echo $prorice; ?>
                                                    </del>
                                                    <ins>
                                                        RM <?php echo number_format($prorice*((100-$row4['discountPercent'])/100), 2, '.', ','); ?>
                                                    </ins>
                                                    <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
                                                    <?php echo $row4['discountPercent']." % OFF"; ?>
                                                </span> 
                                               <?php }else{ ?>
                                                <ins>
                                                    RM <?php echo number_format($prorice*((100-$row4['discountPercent'])/100), 2, '.', ','); ?>
                                                </ins>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } }?>
                        </div>
                    </div>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gnash-iconbox-wrapp default">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-4">
                        <div class="gnash-iconbox  default">
                            <div class="iconbox-inner">
                                <div class="icon-item">
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
                    <div class="col-md-5 col-sm-4">
                        <div class="gnash-iconbox  default">
                        <div class="iconbox-inner">
                                        <div class="icon-item">
                                            <span class="placeholder-text"></span>
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
            </div>
        </div>
        
    </div>
</div>
<?php include('partials_front/footer.php'); ?>