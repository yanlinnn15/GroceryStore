<?php include('account-sidebar.php'); //get oid?>
<style>
    .text-warning{
        -webkit-text-stroke-width: 1px;
        -webkit-text-stroke-color: orange;
        color: #ffd700 /* gold */
    }
    .fa-star {
        cursor: pointer;
    }
</style>

<?php 
    if(isset($_GET['id'])){
        $oid=$_GET['id'];
        //only product in completed status can be comment
        $respro=mysqli_query($conn,"SELECT * FROM orderdetail, product, orderp where orderdetail.orderID=$oid and orderdetail.productID=product.productID and orderdetail.orderID=orderp.orderID and orderp.status=5");
        $respro1=mysqli_query($conn,"SELECT * FROM review where orderID=$oid"); //check product have commented or not
        if(mysqli_num_rows($respro)>0 && mysqli_num_rows($respro1)<=0){ ?>

<div class="col-lg-9">
        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                <div class="myaccount-details">
                    <div class="row">
                        <div class="custom_blog_title" style="margin-left: 20px;">GIVE REVIEWS
                        </div>
                    </div>
                    <div class="row">

                    <div class="review_form_wrapper" style="margin-left: 20px;">
                        <div class="review_form">
                        <div class="comment-respond">
                            <form class="comment-form-review" method="post">
                                <ul class="list-product-order">
                                        <input type="hidden" name="oid" value="<?php echo $oid; ?>">
                                           <?php  while($row=mysqli_fetch_assoc($respro)){ ?>
                                             <li class="product-item-order">
                                        <div class="product-thumb">
                                            <a href="productdetails.php?productid=<?php echo $row['productID']; ?>">
                                                <img src="<?php echo $row['pImage1']; ?>" alt="img">
                                            </a>
                                        </div>
                                        <div class="product-order-inner">
                                            <h5 class="product-name">
                                            <a href="productdetails.php?productid=<?php echo $row['productID']; ?>"><?php echo $row['pName']; ?></a>
                                            <input type="hidden" name="id[]" id="rate" value="<?php echo $row['productID']; ?>">
                                            </h5>
                                            <h4>
                                                <i class="fa fa-star submit_star mr-1 text-warning" id="submit_star_1_<?php echo $row['productID']; ?>"  data-rating="1" data-va="<?php echo $row['productID']; ?>"></i>
                                                <i class="fa fa-star submit_star mr-1 text-warning" id="submit_star_2_<?php echo $row['productID']; ?>"  data-rating="2" data-va="<?php echo $row['productID']; ?>"></i>
                                                <i class="fa fa-star submit_star mr-1 text-warning" id="submit_star_3_<?php echo $row['productID']; ?>"   data-rating="3" data-va="<?php echo $row['productID']; ?>"></i>
                                                <i class="fa fa-star submit_star mr-1 text-warning" id="submit_star_4_<?php echo $row['productID']; ?>"   data-rating="4" data-va="<?php echo $row['productID']; ?>"></i>
                                                <i class="fa fa-star submit_star mr-1 text-warning" id="submit_star_5_<?php echo $row['productID']; ?>"   data-rating="5" data-va="<?php echo $row['productID']; ?>"></i>
                                                <input type="hidden" name="rate[]" id="rate<?php echo $row['productID']; ?>" value="5">
                                            </h4>
                                            
                                                <p class="comment-form-comment">
                                                    <label>
                                                        Review
                                                        <span class="required"></span>
                                                    </label>
                                                    <textarea title="review" id="comment" name="comment[]" cols="20" rows="3"></textarea>
                                                </p>
                                        
                                        </div>
                                        </li>
                                    
                                    <?php }
                                    }else{
                                        header("location:404page.php");
                                    }
                                    ?>
                                            </ul>

                                    <input type="submit" name="submit" style="float: right;">
                            </form>
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
</div>
<?php }else{
        header("location:404page.php");
    }
?> 

<?php include('partials_front/footer.php'); ?>

<script>
function reset_background(va)
{
    for(var count = 2; count <= 5; count++)
    {
        $('#submit_star_'+count+'_'+va).addClass('star-light');
        $('#submit_star_'+count+'_'+va).removeClass('text-warning');
    }
}

$(document).on('click', '.submit_star', function(){

    rating_data = $(this).data('rating');
    var va = $(this).data('va');
    reset_background(va);

    for(var count = 2; count <= rating_data; count++)
    {
        $('#submit_star_'+count+'_'+va).addClass('text-warning');
    }
    $("#rate"+va).val(rating_data);

});

</script>