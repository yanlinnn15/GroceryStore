<?php
include('../config/connect.php');
$ttlPrice = 0;

if(isset($_SESSION['user'])){ 
    $id=$_SESSION['user'];
    $output="";
    $sql9="SELECT * FROM cart inner join product on product.productID=cart.productID where cusID='$id' and (pQty<=0 or productStatus='I')";
    $res9=mysqli_query($conn,$sql9);
    if(mysqli_num_rows($res9)>0){
        $output.='<form class="cart-form">
            <table class="shop_table">
            <thead>
            <tr>
                <th class="product-remove"></th>
                <th class="product-thumbnail"></th>
                <th class="product-name"></th>
                <th class="product-price"></th>
                <th class="product-quantity"></th>
                <th class="product-subtotal"></th>
            </tr>
            </thead>
            <tbody>';

            while($row9=mysqli_fetch_assoc($res9)){
                $image=$row9['pImage1'];
                $pname=$row9['pName'];
                $pprice=$row9['pPrice'];
                $qty=$row9['qty'];
                $pqty=$row9['pQty'];
                $productid=$row9['productID'];
                $output .= '<tr class="cart_item">
                <td class="product-remove">
                    <input type="button" class="btn btn-danger delete" id="'.$productid.'" value="Delete" >
                </td>
                <td class="product-thumbnail">
                    <a href="'.SITEURL.'user/productdetails.php?productid='.$productid.'">
                        <img src="'.$image.'" alt="img" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" style="opacity:0.5">
                        <span class="soldout">
                        '; if($row9['productStatus']=='I'){
                            $output.='Unavailable';
                            }else{
                                $output.='Sold Out';

                            }
                            $output.='   
                    </span>
                    </a>
                </td>
                <td class="product-name" data-title="Product">
                    <a href="'.SITEURL.'user/productdetails.php?productid='.$productid.'" class="title" style="opacity:0.5">'.$pname.'</a>
                    <div class="price" style="opacity:0.5">';
                        if(!empty($row9['discountPercent'])){
                            $disp=number_format(($pprice*(100-$row9['discountPercent'])/100),2);
                            $output .='
                            <del style="color:#929292">RM '.number_format($pprice,2).'</del>
                            <span>RM '.number_format($disp,2).'</span>
                            <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
                                '.$row9['discountPercent']." % OFF".'
                            </span>';
                        }else{ 
                            $disp=$pprice;
                            $output.='<span>RM '.number_format($disp,2).'</span>';
                        }
                        $output.='
                        
                    </div>
                </td>
                <td class="product-quantity" data-title="Quantity">
                </td>
                <td class="product-price" data-title="Price">
                            <span class="title" style="font-size:16px; color: green;">
                                <a href="gridproducts.php?cateid='.$row9["categoryID"].'" class="title"><u>Find Similar</u></a>
                            </span>
                </td>
            </tr>';

            }

            $output.=' 
    </tbody>
    </table>
    </form>
    <div class="control-cart">
    ';

            
    }
    $sql8="SELECT * FROM cart inner join product on product.productID=cart.productID where cusID='$id' and pQty>0 and productStatus='A'";
            $res8=mysqli_query($conn,$sql8);
            $countp=mysqli_num_rows($res8);

            if(mysqli_num_rows($res8)>0){
                $proceed=0;
                $output .= '
                <div class="cart-form">
                    <input type="hidden" id="count" value="'.$countp.'">
                    <table class="shop_table">
                        <thead>
                        <tr>
                            <th class="product-remove"></th>
                            <th class="product-thumbnail"></th>
                            <th class="product-name"></th>
                            <th class="product-price"></th>
                            <th class="product-quantity"></th>
                            <th class="product-subtotal"></th>
                        </tr>
                        </thead>
                        <tbody>';
                    while($row8=mysqli_fetch_assoc($res8)){
                        $image=$row8['pImage1'];
                        $pname=$row8['pName'];
                        $pprice=$row8['pPrice'];
                        $qty=$row8['qty'];
                        $pqty=$row8['pQty'];
                        $productid=$row8['productID'];
                        
                        $output .= '                      
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <input type="button" class="btn btn-danger delete" id="'.$productid.'" value="Delete" >
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="'.SITEURL.'user/productdetails.php?productid='.$productid.'">
                                                <img src="'.$image.'" alt="img"
                                                        class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                                            </a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a href="'.SITEURL.'user/productdetails.php?productid='.$productid.'" class="title">'.$pname.'</a>
                                            <div class="price">';
                                                if(!empty($row8['discountPercent'])){
                                                    $disp=number_format(($pprice*(100-$row8['discountPercent'])/100),2);
                                                    $output .='
                                                    <del style="color:#929292">RM '.number_format($pprice,2).'</del>
                                                    <span>RM '.number_format($disp,2).'</span>
                                                    <span style=" padding:2px 4px; background-color:orange; color:white; line-height: 1px; font-size:1.05rem; margin-left:5px;" >
                                                       '.$row8['discountPercent']." % OFF".'
                                                    </span>';
                                                }else{ 
                                                    $disp=$pprice;
                                                    $output.='<span>RM '.number_format($disp,2).'</span>';
                                                }
                                                if($qty>$pqty){
                                                    $proceed=1;
                                                    $output.='<p style="color: red; font-size:14px;">Sorry, you have exceed the stock! This item only left '.$pqty.'!</p>';
                                                }
                                                $output.='
                                                
                                            </div>
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                                <div class="quantity">
                                                    <div class="control">
                                                        <a class="btn-number qtyminus quantity-minus" href="javascript:void(0)">-</a>
                                                        <input type="number" data-step="1" min="0"  data-min="0" data-max="5" value="'.(int)$qty.'" title="Qty"
                                                            class="input-qty qty update" size="4" id="'.$productid.'">
                                                        <input type="hidden" id="productquan'.$productid.'" value="'.(int)$pqty.'">
                                                        <a href="javascript:void(0)" class="btn-number qtyplus quantity-plus">+</a>
                                                    </div>
                                                </div>
                                            </td>
                                        
                                        <td class="product-price" data-title="Price">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">
                                                            RM
                                                        </span>
                                                        '.number_format((float)$disp*(int)$qty,2).'
                                                    </span>
                                        </td>
                                    </tr>';
                                    $p=number_format((float)$disp*(int)$qty, 2, '.', '');
                                    $ttlPrice+=$p;
                    }
                    $output .= '
                    <tr>
                        <td class="actions">
                            <div class="order-total">
                                <span class="title">
                                    Total Price:
                                </span>
                                <span class="total-price">
                                            RM '.number_format($ttlPrice,2).'
                                        </span>
                                <p>**Not include delivery fee</p>
                            </div>
                        </td>
                    </tr>
	                ';
        }else{
            if(mysqli_num_rows($res9)<=0){
                $output .= '
            <div style="text-align: center; font-weight:bold;" class="title">Your cart is empty!</div>
            ';
            }
        }
    $output.=' 
    </tbody>
    </table>
    </div>
    <div class="control-cart">
    <a href="gridproducts.php" class="button">Back to Shopping</a>';

    if(mysqli_num_rows($res8)>0){
        $countp=mysqli_num_rows($res8);
        $output.=' 
        <input type="hidden" value="'.$proceed.'" id="getproceed">
        <a onclick="Check('.$countp.','.$proceed.')" id="CartCheck" class="button">Checkout</a>
        ';

    }

   $output.=' </div>
   </div>
   </div>
   </div>
   </div>';
    $data = array(
        'cartcontent'	=>	$output
    );	

    echo json_encode($data);
}
?>