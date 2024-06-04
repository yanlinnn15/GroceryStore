<?php
//display mini cart 
include('../config/connect.php');
include('partials_front/loginCheck.php');
$ttlPrice = 0;
$ttlava=0;
$ttlun=0;
$ttlItem=0;

$id=$_SESSION['user'];
$output = '';

$sql10="SELECT pName,pPrice,pImage1,qty,cart.productID FROM cart inner join product on product.productID=cart.productID where cusID='$id'";
$res10=mysqli_query($conn,$sql10);
if(mysqli_num_rows($res10)>0){
    $ttlItem=mysqli_num_rows($res10);
    $sql8="SELECT pName,pPrice,pImage1,qty,cart.productID FROM cart inner join product on product.productID=cart.productID where cusID='$id' and pQty>0 and productStatus='A'";
    $res8=mysqli_query($conn,$sql8);
    $countp=mysqli_num_rows($res8);
    $output .= '
    <h3 class="title">Shopping Cart</h3>
    <ul class="minicart-items">';
    if(mysqli_num_rows($res8)>0){
        while($row8=mysqli_fetch_assoc($res8)){
            $image=$row8['pImage1'];
            $pname=$row8['pName'];
            $pprice=$row8['pPrice'];
            $qty=$row8['qty'];
            $productid=$row8['productID'];
            $output .='     
                <li class="product-cart mini_cart_item">
                <input type="hidden" id="count" value="'.$countp.'">
                <div class="product-remove">
                    <button name="delete" id="'.$productid.'" style="background-color:white; color: black;" class="delete"><i class="fa fa-trash-o" ></i></a></button>
                </div>
                <a href="'.SITEURL.'user/productdetails.php?productid='.$productid.'" class="product-media">
                    <img src="'.$image.'" alt="img">
                </a>
                <div class="product-details">
                    <h5 class="product-name">
                        <a href="'.SITEURL.'user/productdetails.php?productid='.$productid.'">'.$pname.'</a>
                    </h5>
                    <div class="variations">
                        <span class="attribute_color">
                            RM '.$pprice.'
                        </span>
                        <span class="product-quantity">
                            ( x'.$qty.' )
                        </span>
                    </div>
                    <span class="product-price">
                        <span class="price">
                            <span>RM '.number_format((float)$pprice*(int)$qty,2).'</span>
                        </span>
                    </span>
                </div>
            </li>
            ';

                $ttlPrice+=((float)$pprice*(int)$qty);
                $ttlava++;
        }
    }
        $ttlun=$ttlItem-$ttlava;

        if($ttlun>0){
            $output.='<li class="product-cart mini_cart_item">'.$ttlun.' unvailable item(s) in cart...</li>';
        }
        
        $output .= '
            </ul>
            <div class="subtotal">
            ';
        if(mysqli_num_rows($res8)>0){
            $output .= '
                <span class="total-title">Subtotal: </span>
                <span class="total-price">
                            <span class="Price-amount">
                            RM '.number_format($ttlPrice,2).'
                            </span>
                        </span>
            </div>
            ';
        }
        $output.='
        </div>
        <div class="actions">
        <a class="button button-viewcart" href="shoppingcart.php">
            <span>View Bag</span>
        </a>';

        if(mysqli_num_rows($res8)>0){
            $output.='<a href="JavaScript:void(0);" class="button button-checkout"  onclick="Check('.$countp.')"">
            <span>Checkout</span>
            </a>';
        }
        $output.='</div>';

        

}
else
{
	$output .= '
    <div class="no-product gnash-submenu">
        <p class="text">
                You have
                <span>
                    0 item(s)
                </span>
                in your bag
            </p>
    </div>
    ';
}
$data = array(
	'minicontent'	=>	$output,
	'count'	=>	$ttlItem
);	

echo json_encode($data);
?>