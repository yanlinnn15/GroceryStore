<?php include('partials_front/header.php'); ?>
<?php 
	if(isset($_SESSION['user'])){
		$rescheck=mysqli_query($conn,"SELECT * from customer where cstatus=1 and cusID='".$_SESSION['user']."'");
		if(mysqli_num_rows($rescheck)!=1){
			unset($_SESSION['user']);
			$_SESSION['inactive']="Your account is inactive!";
			header("login-register.php");
		}
	}
?>

<?php function getCurrentURL(){
	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$validURL = str_replace("&","&amp",$url);
	return $validURL;
}
?>
   
	<div class="main-content main-content-product left-sidebar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-trail breadcrumbs">
						<ul class="trail-items breadcrumb">
							<li class="trail-item trail-begin">
								<a href="index.php">Home</a>
							</li>
							<li class="trail-item trail-end active">
								Products
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="content-area shop-grid-content no-banner col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="site-main">
						<h3 class="custom_blog_title">
							Products
						</h3>
						<div class="shop-top-control">
							<form class="filter-choice select-form" method="POST" id="sort">
								<span class="title">Sort by</span>
								<select title="sort-by" data-placeholder="Choose option" class="chosen-select" name="sort" id="sort" onchange="submit_form()" id="sort">
									<option value="" disabled selected hidden>Choose Option..</option>
									<option value="1" <?php if(isset($_GET['sort'])){ if($_GET['sort']==1){?> selected <?php }}?> >Price: Low to High</option>
									<option value="2" <?php if(isset($_GET['sort'])){ if($_GET['sort']==2){?> selected <?php }}?>>Price：High to Low</option>
									<option value="3" <?php if(isset($_GET['sort'])){ if($_GET['sort']==3){?> selected <?php }}?>>Alphabelt：A-Z</option>
									<option value="4" <?php if(isset($_GET['sort'])){ if($_GET['sort']==4){?> selected <?php }}?>>Alphabelt：Z-A</option>
									<option value="5" <?php if(isset($_GET['sort'])){ if($_GET['sort']==5){?> selected <?php }}?>>By Newness</option>
								</select>
							</form>


						</div>
							<ul class="row list-products auto-clear equal-container product-grid">
							<?php

                                $sql="SELECT * FROM PRODUCT WHERE productStatus='A' ";

                                $productPerPage=8; //number of product in each page

                                if(isset($_GET['cateid']) && !empty($_GET['cateid'])){
                                    $sql.=" AND categoryID='".$_GET['cateid']."'";
                                }
                                if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
                                    $sql.=" AND pName like '%".$_GET['keyword']."%'";
                                }

                                if(isset($_GET['sort']) && !empty($_GET['sort'])){
                                    switch($_GET['sort']){
                                        case '1':
                                            $sql.=" order by pPrice ASC";
                                            break;
                                        case '2':
                                            $sql.=" order by pPrice DESC";
                                            break;
                                        case '3':
                                            $sql.=" order by pName ASC";
                                            break;
                                        case '4':
                                            $sql.=" order by pName DESC";
                                            break;
                                        case '5':
                                            $sql.=" order by AddedTime DESC";
                                            break;
                                    }
                                }
                                $res=mysqli_query($conn,$sql);
                                if($res){
                                    $ttl_pro=mysqli_num_rows($res); //total product
                                }else{
                                    $ttl_pro=0;
                                }

                                //total page available //cail is get the whole number
                                $numofPage = ceil($ttl_pro/$productPerPage);

                                //get page that we currently on
                                if(isset($_GET['page']) && is_numeric($_GET['page'])){
                                    $page=$_GET['page'];
                                }else{
                                    $page=1;
                                }

                                $starting_page_result=($page-1)*$productPerPage;

                                $sql7=$sql." LIMIT ".$starting_page_result.','.$productPerPage;
							
                                $res7=mysqli_query($conn,$sql7);
                                if($res7){
                                    if(mysqli_num_rows($res7)>0){
                                        while($row=mysqli_fetch_assoc($res7)){
                                            $pImage1 = $row['pImage1'];
                                            $pName = $row['pName'];
                                            $price=$row['pPrice'];
                                            $pID =$row['productID'];
											$pqty =$row['pQty'];
                                            $addeddate = $row['AddedTime'];
										
										?>
									<li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
										<div class="product-inner equal-element" style="float: right;">
											
											<div class="product-top" id='product'>
											<?php if((time()-(60*60*24*7)) < strtotime($addeddate)){?>
												<div class="flash">
													<span class="onnew">
														<span class="text">
															new
														</span>
													</span>
												</div><?php } ?>
											</div>
											<div class="product-top" id='product'>
											</div>
											<div class="product-thumb">
												<div class="thumb-inner">
													<a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $pID;?>">
														<img src="<?php echo $pImage1; ?>" alt="img">
													</a>
												
														<!--<div class="yith-wcwl-add-to-wishlist">
															<div class="yith-wcwl-add-button">
																<a href="<?php echo SITEURL; ?>user/addwishlist.php?id=<?php echo $pID;?>">Add to Wishlist</a>
															</div>
														</div>-->
												<?php if($pqty<=0){?>
												<span class="soldout">
													Sold Out
												</span>
												<?php } ?>
													<?php if($pqty>0){ ?>
														<div class="thumb-group">
														<div class="loop-form-add-to-cart">
															<input type="hidden" name="hiddenQty" id="quantity<?php echo $pID;?>" value="1">
															<input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $pID;?>" value="<?php echo $pqty; ?>">
															<button type="button" name="submitcart" id="<?php echo $pID;?>" class="single_add_to_cart_button button submitcart">
													<?php }else{?>
														<div class="thumb-group" style="background-color: grey;">
														<div class="loop-form-add-to-cart">
															<input type="hidden" name="hiddenQty" id="quantity<?php echo $pID;?>" value="1">
															<input type="hidden" name="hiddenPQty" id="Pquantity<?php echo $pID;?>" value="<?php echo $pqty; ?>">
															<button type="button" name="submitcart" id="<?php echo $pID;?>" class="single_add_to_cart_button button submitcart"  style="background-color: grey;" disabled>
													<?php } ?>
														</div>
														
													</div>
												</div>
											</div>
												<div class="product-info">												
													<h5 class="product-name product_title" style="font-size: 15px;">
														<a href="<?php echo SITEURL; ?>user/productdetails.php?productid=<?php echo $pID;?>"><?php echo $pName; ?></a>
													</h5>
												<div class="group-info">
													<?php
														$resrw=mysqli_query($conn,"select avg(rating) as 'rate',count(*) as 'ttl' from review where productID='$pID'");
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
													<?php if(!empty($row['discountPercent'])){ ?>
														<del>
															RM <?php echo $price; ?>
														</del>
														<ins>
															RM <?php echo number_format($price*((100-$row['discountPercent'])/100), 2, '.', ','); ?>
														</ins>
														<span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
															<?php echo $row['discountPercent']." % OFF"; ?>
														</span>
													<?php }else{ ?>

														<ins>
															RM <?php echo $price; ?>
														</ins>

													<?php }?>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?php }
									}else{ ?>
										<div style="text-align: center; font-weight:bold;" class="title">No record found!</div>
									<?php } 
							}else{
								echo "Something went wrong";
							}?>
						</ul>
						<?php

						if(mysqli_num_rows($res7)<=0){
						
						$numofPage=1; } ?>
							
						<!-- Pagination -->
						<?php
							$url="gridproducts.php?";

							if(isset($_GET['cateid'])){
								$url.="cateid=".$_GET['cateid']."&";
							}
							if(isset($_GET['keyword'])){
								$url.="keyword=".$_GET['keyword']."&";
							}
							if(isset($_GET['sort'])){
								$url.="sort=".$_GET['sort']."&";
							}

						?>
						<div class="pagination clearfix style2" style="margin-top:20px;">
							<div class="nav-link">
							<a href="<?php echo $url;?>page=<?php if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;} if($current==1){echo 1; }else{echo $current=$current-1;}?>
							" class="page-numbers"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>
							<?php
							if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;}
							for($page=1;$page<=$numofPage;$page++){ 
								if($current==$page){?>
									<a href="<?php echo $url;?>page=<?php echo $page;?>" class="page-numbers current"><?php echo $page; ?></a>
								<?php }else{ ?>
									<a href="<?php echo $url;?>page=<?php echo $page;?>" class="page-numbers"><?php echo $page; ?></a>
								<?php }} ?>	
							<a href="<?php echo $url;?>page=<?php if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;} if($current==$numofPage){echo $numofPage; }else{echo $current=$current+1;} ?>" class="page-numbers"><i class="icon fa fa-angle-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php include('partials_front/footer.php'); ?>

<!-- submit sort form when onchange -->
<script>
    function submit_form(){
        var form = document.getElementById("sort");
        form.submit();
    }
</script>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."user/gridproducts.php?";

        if($_GET['keyword']){
            $url.="keyword=".$_GET['keyword']."&";
        }
		if($_GET['cateid']){
            $url.="cateid=".$_GET['cateid']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>