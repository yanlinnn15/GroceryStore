<?php 
    include('account-sidebar.php');
?>

<script type="text/javascript">
    function submit() {
        document.getElementById('osform').submit();
};
</script>
<div class="col-lg-9">
    <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
            <div class="myaccount-orders">
                <h4 class="small-title">MY ORDERS</h4>
                <div class="container">
                <link rel="stylesheet" href="assets/css/style3.css">
                        <form action="" id="osform">
                        <select name="os" id="os" style="border: 1px solid black; margin-bottom:10px;" onchange="submit()">
                        <option value="" disabled hidden selected>Select..</option>
                        <?php
                            $res=mysqli_query($conn,"SELECT * FROM orderstatus");
                            while($row=mysqli_fetch_assoc($res)){ 
                        ?>
                                <option value="<?php echo $row['osID']; ?>" <?php if(isset($_GET['os'])){ if($_GET['os']==$row['osID']){ ?> selected <?php } } ?>><?php echo $row['osName']; ?></option>
                        <?php } ?>
                        </select>
                        </form>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="orders-container">

                                    <?php 
                                        $sql="SELECT * FROM orderp where cusID='".$_SESSION['user']."'";

                                        if(isset($_GET['os'])){
                                            $sql.=" and status='".$_GET['os']."'";
                                        }

                                        $sql.=" order by orderDate desc";

                                        $res1=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($res1)>0){
                                            while($row1=mysqli_fetch_assoc($res1)){
                                    ?>
                                    <div class="order-item">
                                        <table class="table table-responsive1">
                                            <thead>
                                                <tr>
                                                    <th class="px-3">My Order</th>
                                                    <th class="text-center">Items</th>
                                                    <th class="text-right pr-5">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-4">
                                                        <div>
                                                            <h6 class="order-number">Order#<?php echo $row1['orderID']; ?></h6>
                                                            <p class="date"><?php echo $row1['orderDate']; ?></p>
                                                            <p class="price">Total : RM <?php echo $row1['totalPrice']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div>
                                                            <?php
                                                                $res3=mysqli_query($conn,"SELECT count(*) as total from orderdetail where orderID='".$row1['orderID']."'");
                                                                $row3=mysqli_fetch_assoc($res3);
                                                                echo $row3['total']; ?>
                                                                &nbsp;item(s)
                                                        </div>
                                                    </td>
                                                    <td class="text-right pr-5">
                                                        <div class="pending">
                                                            <?php 
                                                                $res4=mysqli_query($conn,"SELECT * FROM orderstatus where osID='".$row1['status']."'");
                                                                $row4=mysqli_fetch_assoc($res4);
                                                                if($row1['status']=='1' || $row1['status']=='7'){ ?>
                                                                <div class="pending">
                                                                <?php echo $row4['osName']; 

                                                                if($row1['status']=='1'){

                                                                        $ressorderdate=mysqli_query($conn,"select orderDate+ INTERVAL '1' HOUR as 'expired' from orderp where orderID='".$row1['orderID']."';");                                                        
                                                                        $rowdate=mysqli_fetch_assoc($ressorderdate);
                                                                        $date_today = date($rowdate['expired'], strtotime('+1 hour'));
                                                                    ?>
                                                                    <script>
                                                                        var count_id="<?php echo $date_today; ?>";
                                                                        var countDownDate = new Date(count_id).getTime();
                                                                        var x=setInterval(function(){

                                                                            var now=new Date().getTime();

                                                                            var distance = countDownDate-now;

                                                                            var hours = Math.floor((distance%(1000*60*60*24))/(1000*60*60));

                                                                            var minutes=Math.floor((distance%(1000*60*60))/(1000*60));

                                                                            var seconds=Math.floor((distance%(1000*60))/1000);

                                                                            //output the result in an element with id="demo";

                                                                            document.getElementById("demo").innerHTML="Left "+hours+"h "+ minutes+"m "+seconds+"s ";

                                                                            if(distance<=0){
                                                                                clearInterval(x);
                                                                                document.getElementById("demo").innerHTML="Your order had expired.";
                                                                            }
                                                                        },0);
                                                                    </script>
                                                                    <div id="demo"></div>

                                                            <?php
                                                                }
                                                                
                                                            }else{ ?>
                                                                <div class="done">
                                                                <?php echo $row4['osName']; } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right px-1">
                                                        <div>
                                                            <a class="view-details" href="order-details.php?oid=<?php echo $row1['orderID']; ?>"><strong>View Details</strong></a>
                                                        </div>
                                                    </td>
                                                    <td class="text-right px-2">
                                                        <div>
                                                           <?php switch($row1['status']){ 
                                                               case 1:
                                                                $res=mysqli_query($conn,"SELECT * FROM")
                                                                
                                                                ?>
                                                                <form action="" method="post">
                                                                    <?php 

                                                                    $res7=mysqli_query($conn,"SELECT * FROM payment where orderID='".$row1['orderID']."'");
                                                                    $row7=mysqli_fetch_assoc($res7);
                                                                    if($row7['pmID']==2){ ?>
                                                                        <a href="walletpayment.php?payID=<?php echo $row7['paymentID']; ?>" class="btn btn-info">Pay Now</a>
                                                                    <?php }else{ ?>
                                                                        <a href="creditcardpayment.php?payID=<?php echo $row7['paymentID']; ?>" class="btn btn-info">Pay Now</a>
                                                                    <?php }
                                                                    ?>

                                                                    <a href="javascript:void(0);" class="btn btn-warning" onclick="cancel(<?php echo $row1['orderID']; ?>)">Cancel Order</a>
                                                                    
                                                                </form>
                                                                <?php break;
                                                                case 4: ?>
                                                                    <a href="order.php?re&oid=<?php echo $row1['orderID'] ?>" class="btn btn-info">Received</a>
                                                                <?php break;
                                                                case 5:
                                                                    $respro1=mysqli_query($conn,"SELECT * FROM review where orderID='".$row1['orderID']."'"); //check rated or not rated
                                                                    if(mysqli_num_rows($respro1)>0){ ?>
                                                                        Rated
                                                                    <?php }else{
                                                                        
                                                                        ?>
                                                                        <a href="review.php?id=<?php echo $row1['orderID'] ?>" class="btn btn-info" >Rate Now</a>
                                                                    <?php } 
                                                                    ?>
                                                                <?php break; 
                                                            ?>

                                                           <?php } ?>
                                                           <td class="text-right px-1">
                                                        <div>
                                                            <?php if($row1['status']!=1 && $row1['status']!=7){ ?>
                                                                <a href="https://localhost/onlinegrocery/admin/print.php?id=<?php echo $row1['orderID']; ?>" target="_blank" style="color: green;"><strong>Receipt</strong></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php }}else{ echo "No record Found!"; }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- dashboard-section end -->
            </div>
        </div> 
    </div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="assets/css/style.css">
<?php include('partials_front/footer.php'); ?>

<?php if(isset($_SESSION['success'])){?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?php echo $_SESSION['success']; ?>',
            showConfirmButton: true,
        })
    </script>
<?php unset($_SESSION['success']); } ?>

<script>
    function cancel(order){
        Swal.fire({
            icon: "warning",
        text: 'Do you want to cancel this order?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: `No`,
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="order.php?ccl&oid="+order;
            
        } 
        });
    }
</script>

<?php
if (isset($_REQUEST["re"])) 
{
	$oid = $_REQUEST["oid"]; 
    
    $res=mysqli_query($conn,"SELECT * FROM orderp where orderID='$oid'");

    if(mysqli_num_rows($res)>0){
        //order exist and check status
        $row=mysqli_fetch_assoc($res);
        if($row['status']==4){
            $res1=mysqli_query($conn,"Update orderp set status=5, updated_Time=current_timestamp where orderID='$oid' and status=4");
            if(mysqli_affected_rows($conn)>0){

                $_SESSION['success']="Order Completed!";
                
            }
        }
    }

	header("Location: ". $_SERVER["HTTP_REFERER"]);
}
?>

<?php
if (isset($_REQUEST["ccl"])) 
{
	$oid = $_REQUEST["oid"]; 
    
    $res=mysqli_query($conn,"SELECT * FROM orderp where orderID='$oid'");

    if(mysqli_num_rows($res)>0){
        //order exist and check status
        $row=mysqli_fetch_assoc($res);
        if($row['status']==1){
            $res1=mysqli_query($conn,"Update orderp set status=7, updated_Time=current_timestamp where orderID='$oid' and status=1");
            if(mysqli_affected_rows($conn)>0){
                $_SESSION['success']="Order Cancelled!";  
            }
        }
    }

	header("Location: ". $_SERVER["HTTP_REFERER"]);
}
?>