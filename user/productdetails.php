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
<style>
    .seller-reply-wrapper {
    position: relative;
    background-color: #f8f8f8;
    padding: 15px 15px 15px 48px;
    margin-top: 20px;
}
</style>
        
<div class="main-content main-content-details single no-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin">
                            <a href="index.php">Home</a>
                        </li>
                        <?php 
                            if(isset($_GET['productid'])){
                                $pid=$_GET['productid'];
                                $sql="SELECT * FROM PRODUCT where productID='$pid'";
                                $res=mysqli_query($conn,$sql);
                                if($res){
                                    if(mysqli_num_rows($res)>0){
                                        while($row=mysqli_fetch_assoc($res)){
                                            $pImage1 = $row['pImage1'];
                                            $pImage2 = $row['pImage2'];
                                            $pImage3 = $row['pImage3'];
                                            $pImage4 = $row['pImage4'];
                                            $qty = $row['pQty'];
                                            $pName = $row['pName'];
                                            $pDesc=$row['pDesc'];
                                            $price=$row['pPrice'];
                                            $dis=$row['discountPercent'];
                                            $atime=$row['AddedTime'];
                                        }
                                        
                                        $sql2="SELECT category.categoryID,categoryName FROM category inner join product on product.categoryID = category.categoryID where productid='$pid'";
                                        $res2=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($res2)>0){
                                            while($row2=mysqli_fetch_assoc($res2)){
                                                $cateID=$row2['categoryID'];
                                                $categoryName=$row2['categoryName'];
                                            }
                                        }else{
                                            $categoryName="";
                                        }
                        ?>
                        <?php if($categoryName!=""){ ?>      
                        <li class="trail-item">
                            <a href="<?php echo SITEURL; ?>user/gridproducts.php?cateid=<?php echo $cateID;?>"><?php echo $categoryName; ?></a>
                        </li><?php } ?>
                        <li class="trail-item">
                            <a href="gridproducts.php?page=1">Products</a>
                        </li>
                        <li class="trail-item trail-end active">
                            <?php echo $pName ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="content-area content-details full-width col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="site-main">
                    <div class="details-product">
                        <div class="details-thumd">
                            <div class="image-preview-container image-thick-box image_preview_container">
                            <?php if($qty<=0){?>
                                        <span class="soldout">
                                            Sold Out
                                        </span>
                                    <?php } ?>
                                <img id="img_zoom" data-zoom-image="<?php echo $pImage1; ?>"
                                     src="<?php echo $pImage1; ?>" alt="img">
                                <a href="#" class="btn-zoom open_qv"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div>
                            <div class="product-preview image-small product_preview">
                                <div id="thumbnails" class="thumbnails_carousel owl-carousel" data-nav="true"
                                     data-autoplay="false" data-dots="false" data-loop="false" data-margin="10"
                                     data-responsive='{"0":{"items":3},"480":{"items":3},"600":{"items":3},"1000":{"items":3}}'>
                                    <a href="#" data-image="<?php echo $pImage1; ?>"
                                       data-zoom-image="<?php echo $pImage1; ?>" class="active">
                                        <img src="<?php echo $pImage1; ?>"
                                             data-large-image="<?php echo $pImage1; ?>" alt="img">
                                    </a>
                                    <?php if($pImage2!=null){ ?>
                                    <a href="#" data-image="<?php echo $pImage2; ?>"
                                       data-zoom-image="<?php echo $pImage2; ?>">
                                        <img src="<?php echo $pImage2; ?>"
                                             data-large-image="<?php echo $pImage2; ?>" alt="img">
                                    </a> <?php } ?>

                                    <?php if($pImage3!=null){ ?>
                                    <a href="#" data-image="<?php echo $pImage3; ?>"
                                       data-zoom-image="<?php echo $pImage3; ?>">
                                        <img src="<?php echo $pImage3; ?>"
                                             data-large-image="<?php echo $pImage3; ?>" alt="img">
                                    </a> <?php } ?> 

                                    <?php if($pImage4!=null){ ?>
                                    <a href="#" data-image="<?php echo $pImage4; ?>"
                                       data-zoom-image="<?php echo $pImage4; ?>">
                                        <img src="<?php echo $pImage4; ?>"
                                             data-large-image="<?php echo $pImage4; ?>" alt="img">
                                    </a> <?php } ?> 
                                </div>
                            </div>
                        </div>
                        <div class="details-infor">
                            <h1 class="product-title">
                                <?php echo $pName; ?>
                            </h1>
                            <?php
                                $resrw=mysqli_query($conn,"select avg(rating) as 'rate',count(*) as 'ttl' from review where productID='$pid'");
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
                                    <div class="availability">
                                    <a style="color: grey;">Not rating yet</a>
                                    </div>
                                <?php }}

                            ?>
                            <div class="availability">
                                Availability:
                                <?php if($qty>0){?>
                                <a> In Store <?php }else{ ?>
                                <a style="color: grey;"> Sold Out  
                                <?php } ?>
                                </a>
                            </div>
                            <div class="price">
                            <?php if(!empty(trim($dis))){ ?>
                                <del style="color:#929292; font-size:18px; margin-right: 4px; padding-bottom: 10px;">
                                    RM <?php echo $price; ?>
                                </del>
                                <span>
                                    RM <?php echo number_format($price*((100-$dis)/100), 2, '.', ','); ?>
                                </span>
                                <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:10px;" >
                                    <?php echo $dis." % OFF"; ?>
                                </span>
                                <?php }else{?>
                                    <span>
                                        RM <?php echo $price; ?>
                                    </span>

                                <?php } ?>
                                
                            </div>
                            
                            
                            <div class="group-button">
                                <div class="quantity-add-to-cart">
                                    <div class="quantity">
                                        <div class="control">
                                            <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                            <input type="number" data-step="1" data-min="1" value="1" title="Qty"
                                                   class="input-qty qty" id="quantity<?php echo $pid;?>" size="4">
                                            <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                        </div>
                                    </div>
                                    <?php if($qty>0){?>
                                        <input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $pid;?>" value="<?php echo $qty; ?>">
                                        <button class="single_add_to_cart_button button submitcart" id="<?php echo $pid;?>">Add to cart</button> 
                                    <?php }else{ ?>
                                        <button class="single_add_to_cart_button button submitcart" style="background-color: grey;" id="<?php echo $pid;?>" disabled>Add to cart</button>
                                    <?php } ?>
                                    <span style="margin-top: 40px; font-size:small"><?php echo $qty; ?> piece available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-details-product">
                        <ul class="tab-link">
                            <li class="active">
                                <a data-toggle="tab" aria-expanded="true" href="#product-descriptions">Descriptions </a>
                            </li>
                            <?php $resre=mysqli_query($conn,"SELECT count(*) as 'ttl' FROM review where productID=$pid");
                                    $rowre=mysqli_fetch_assoc($resre);
                            
                            ?>
                            <li class="">
                                <a data-toggle="tab" aria-expanded="true" href="#reviews">Reviews(<?php echo $rowre['ttl']; ?>)</a>
                            </li>
                        </ul>
                        <div class="tab-container">
                            <div id="product-descriptions" class="tab-panel active">
                                <p>
                                    <?php echo $pDesc; ?>
                                </p>
                            </div>
                        
                            <div id="reviews" class="tab-panel">
                                <div class="reviews-tab">
                                    <div class="comments">
                                        <h2 class="reviews-title">
                                            <?php echo $rowre['ttl']; ?> review(s)
                                        </h2>

                                        <?php 
                                            if($rowre['ttl']>0){
                                                $resre1=mysqli_query($conn,"SELECT * FROM review,customer where productID=$pid and customer.cusID=review.cusID");
                                                while($rowre1=mysqli_fetch_assoc($resre1)){ ?>
                                                
                                                <ol class="commentlist">
                                                <li class="conment">
                                                    <div class="conment-container">
                                                        <a href="#" class="avatar">
                                                            <img src="assets/images/avartar.png" alt="img" style="width:70px">
                                                        </a>
                                                        <div class="comment-text">
                                                        <?php
                                                            $front=intval($rowre1['rating']);
                                                            if($rowre1['rating']>$front){
                                                                $end2=5;
                                                            }else{
                                                                $end2=0;
                                                            } ?>

                                                            <div class="stars-rating">
                                                                <div class="star-rating">
                                                                    <span class="star-<?php echo $front; ?>-<?php echo $end2; ?>"></span>
                                                                </div>
                                                                <div class="count-star">
                                                                </div>
                                                            </div>
                                                            <p class="meta">
                                                                <strong class="author"><?php echo $rowre1['cusLName']; ?></strong>
                                                                <span>-</span>
                                                                <span class="time"><?php echo $rowre1['rtime']; ?></span>
                                                            </p>
                                                            <div class="description">
                                                                <p>
                                                                    <?php
                                                                        if($rowre1['status']==1){
                                                                             if($rowre1['comment']==""){
                                                                                echo "No comment";
                                                                            }else{
                                                                                echo $rowre1['comment'];
                                                                            } ?>
                                                                       <?php }else{
                                                                           echo "Content block :(";
                                                                      } ?>
                                                                </p>
                                                            </div>

                                                            <?php
                                                                 if($rowre1['reply']!=""){ ?>

                                                            <div class="seller-reply-wrapper">
                                                                <p class="meta" style="color: green;">
                                                                    <strong class="author">Seller Response</strong>
                                                                    <span>-</span>
                                                                    <span class="time"><?php echo $rowre1['retime']; ?></span>
                                                                </p>
                                                                <div class="description">
                                                                    <p><?php echo $rowre1['reply']; ?></p>
                                                                </div>
                                                            </div>



                                                        <?php     }

                                                            ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                </ol>
                                                <hr>

                                        <?php    }}
                                        
                                        ?>
                                        
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: left;"></div>
                    <div class="related products product-grid">
                    <h2 class="product-grid-title">You may also like</h2>
                    <div class="owl-products owl-slick equal-container nav-center"  data-slick ='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}' data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":4}},{"breakpoint":"1200","settings":{"slidesToShow":3}},{"breakpoint":"992","settings":{"slidesToShow":3}},{"breakpoint":"480","settings":{"slidesToShow":2}},{"breakpoint":"360","settings":{"slidesToShow":2}}]'>
                    <?php
                        $sql4="SELECT * FROM product inner join category on product.categoryID = category.categoryID where product.categoryID='$cateID' and product.categoryID!=0 and productid!='$pid' and pQty>0 and productStatus='A'";
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
                
                        <div class="product-item">
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
                                                    <div class="availability">
                                                    <a style="color: grey;">&nbsp;</a>
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
        </div>
    </div>
</div>
</div>
<?php include('partials_front/footer.php'); ?>

<?php }else{
            header("location:".SITEURL."user/404page.php");}
        }
        }else{
            header("location:".SITEURL."user/404page.php");
        }
?> 