<?php 
    include('partials/header.php');
?>

<?php

if (isset($_POST['out']))
{
    $i=$j=0;
	if(isset($_POST['check'])){
        foreach($_POST['check'] AS $value){
            ++$i;
            $res=mysqli_query($conn,"UPDATE orderp set status=3, updated_Time=CURRENT_TIMESTAMP where orderID=$value");
            if(mysqli_affected_rows($conn)==1){
                $res1=mysqli_query($conn,"SELECT * FROM customer,orderp,timeslot where orderp.orderID=$value and orderp.cusID=customer.cusID and orderp.timeslot=timeslot.timeSlot");
                $row1=mysqli_fetch_assoc($res1);
                $time=$row1['timeRange'];
                $name=$row1['cusLName'];
                $to=$row1['cusEmail'];
                $subject="Order #".$value." -Out of Delivery";
                $message="
                    Hi $name,<br><br>

                    Your order#$value is out of delivery now.<br> 
                    Delivery Time will be within $time. <br>
            
                    Thanks! &#8211; FreshGrocers<br>
                ";
                $headers ="From: ffreshgrocers@gmail.com \r\n";
                $headers = "MIME-Version: 1.0" . "\r\n"; //set content type when sending html email
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to,$subject,$message,$headers);
                ++$j;
            }
        }
    }else{ ?>

    <script>     
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Select at least 1 order!',
            showConfirmButton: false,
            timer: 1500
        });
    </script>

    <?php } 

    if($i==$j && $i>0){
    
    ?>



   <script>     
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Order Updated',
        showConfirmButton: false,
        timer: 1500
    });
   </script>
<?php header("order-toship.php"); }} ?>

<style>
    input[type=checkbox]
{
  -webkit-appearance:checkbox;
}
table td > input:not([type='checkbox']) {
    height: 100%;
}
</style>

<script>
//select all
$(function () {
       $('#selectall').click(function (event) {
          
           var selected = this.checked;
           // Iterate each checkbox
           $(':checkbox').each(function () { this.checked = selected; });

       });
    });
</script>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Order To Ship</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="allorder.php">All Order</a></li>
                            <li class="breadcrumb-item active"><a href="order-toship.php">Order To Ship</a></li>
                        </ol>
                    </div>                   
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
				<?php 
                    $sql="SELECT * FROM orderp,payment,timeslot,orderstatus,customer where orderp.orderID=payment.orderID and orderp.timeslot=timeslot.timeSlot and orderstatus.osID=orderp.status and orderp.cusID=customer.cusID and orderp.status=2 ";
                    $orderpPage=25;
                    if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
                        $sql.=" AND (orderDate like '%".$_GET['skeyword']."%' or cusEmail like '%".$_GET['skeyword']."%' or orderp.orderID like '%".$_GET['skeyword']."%' or totalPrice like '%".$_GET['skeyword']."%' or shipDate like '%".$_GET['skeyword']."%' or timeRange like '%".$_GET['skeyword']."%' or osName like '%".$_GET['skeyword']."%') ";
                    }
                    if(isset($_GET['sort']) && !empty($_GET['sort'])){
                        $day=$_GET['sort']-1;
                        $NewDate=Date('Y-m-d', strtotime("+ $day days"));
                        $sql.=" and shipDate = '$NewDate' " ;
                    }

                    $res=mysqli_query($conn,$sql); 
                    if($res){
                        $ttl=mysqli_num_rows($res);
                    }else{
                        $ttl=0;
                    }

                    $numPage = ceil($ttl/$orderpPage);

                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page=$_GET['page'];
                    }else{
                        $page=1;
                    }

                    $starting_page_result=($page-1)*$orderpPage;

                    $sql7=$sql."order by orderp.orderID asc LIMIT ".$starting_page_result.','.$orderpPage;

                    $res7=mysqli_query($conn,$sql7);
                    
                    ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="block">
                                    <form method="post">
                                        <div class="wrap">
                                            <div class="search">
                                                <input type="text" class="searchTerm" placeholder="Search order..." name="skey" <?php if(isset($_GET['skeyword'])){ ?> value="<?php echo $_GET['skeyword'];?>" <?php }?>>
                                                <button input type="submit" class="searchButton" name="submitsearch">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                           
                                            </div>
                                        </div>
                                    </form>
                                    <div style="float: left;">
                                        <form action="" name="sort" onchange="submit_form()" id="sort" method="post">
                                            <select name="sort" id="" class="custom-select">
                                                <option value="" selected disabled hidden>Select Sort...</option>
                                                <option value="1" <?php if(isset($_GET['sort'])){ if($_GET['sort']==1){?> selected <?php }} ?> > Ship Today</option>
                                                <option value="2" <?php if(isset($_GET['sort'])){ if($_GET['sort']==2){?> selected <?php }} ?> > Ship Tomorrow</option>
                                                <option value="3"<?php if(isset($_GET['sort'])){ if($_GET['sort']==3){?> selected <?php }} ?> > Ship Next Tomorrow</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" onClick="toggle(this)" id="selectall" name="selectall"><label for="selectall">ID</label></th>
                                                <th>Time</th>
                                                <th>Cus Email</th>
                                                <th>Total Item(s)</th>
                                                <th>Total (RM)</th>
                                                <th>Ship Date</th>
                                                <th>Ship Time</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <form method="post" action="order-toship.php">
                                            <div><input type="submit" name="out" value="Out of delivery" class="btn btn-primary" style="margin-top: 20px;">
                                            <button type="button" name="print" class="btn btn-primary" id="print" style="margin-top: 20px;">Print <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
										<?php
                                            $c=0;
											while($row = mysqli_fetch_assoc($res7))
											{	
                                                $res4=mysqli_query($conn,"SELECT count(*) as total FROM orderdetail where orderID='".$row['orderID']."'");
                                                $row1=mysqli_fetch_assoc($res4);
										?>
                                            <tr>
                                                <td><input type="checkbox" class="check" name="check[]" id="<?php echo $row['orderID']; ?>" value="<?php echo $row['orderID']; ?>"><label for="<?php echo $row['orderID']; ?>"><?php echo $row['orderID']; ?></label></td>
                                                <td><?php echo $row['orderDate']; ?></td>
                                                <td><?php echo $row['cusEmail']; ?></td>
                                                <td><?php echo $row1['total']; ?></td>
                                                <td><?php echo "RM ".$row['totalPrice']; ?></td>
                                                <td><?php echo $row['shipDate']; ?></td>
                                                <td><?php echo $row['timeRange']; ?></td>
                                                <td><button type="button" class="btn btn-unsuccess" style="font-size: 12px;"><?php echo $row['osName']; ?></button></td>
                                                <td>
                                                <!--<a href="editorderp.php?id=<?php echo $row['orderID']?>"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-file-pdf-o"></i></button></a>-->
                                                <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">-->
                                                <a href="ode.php?oid=<?php echo $row['orderID']?>"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-pencil"></i></button></a>
                                                <a href="print.php?id=<?php echo $row['orderID']?>" target="_blank"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-file-pdf-o"></i></button></a>
                                            </tr>
                                            <?php
											}
											?>
                                            </form>
                                            </form>  

                                            <?php 

                                                if(mysqli_num_rows($res7)<=0){?>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>No result Found!<strong></td>
                                                    </tr>
                                                <?php $numPage=1; } ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Pagination -->
                                <?php 
                                $url="order-toship.php?";
                                
                                if(isset($_GET['skeyword'])){
                                    $url.="skeyword=".$_GET['skeyword']."&";
                                }
                                if(isset($_GET['sort'])){
                                    $url.="sort=".$_GET['sort']."&";
                                }

                                ?>

                                <div class="pagination">
                                    <a href="<?php echo $url;?>page=<?php if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;} if($current==1){echo 1; }else{echo $current=$current-1;}?>">&laquo;</a>
                                    <?php
                                    if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;}
                                    for($page=1;$page<=$numPage;$page++){ 
                                        if($current==$page){?>
                                            <a href="<?php echo $url;?>page=<?php echo $page;?>" class="active"><?php echo $page; ?></a>
                                        <?php }else{ ?>
                                            <a href="<?php echo $url;?>page=<?php echo $page;?>"><?php echo $page; ?></a>
                                        <?php }} ?>
                                    <a href="<?php echo $url;?>page=<?php if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;} if($current==$numPage){echo $numPage; }else{echo $current=$current+1;} ?>">&raquo;</a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php 
require('alert2.php');
include('partials/footer.php');
?>

<!-- submit sort form when onchange -->
<script>
    function submit_form(){
        var form = document.getElementById("sort");
        form.submit();
    }
</script>

<!-- search form -->
<?php
    if(isset($_POST['submitsearch'])){

        $keyw=$_POST['skey'];

        if(!empty(trim($keyw))){
            $keyw1=mysqli_real_escape_string($conn,$keyw);
            header("location:".SITEURL."admin/order-toship.php?skeyword=".$keyw);
        }else{
            header("location:order-toship.php");
        }
    }
?>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."admin/order-toship.php?";

        if($_GET['skeyword']){
            $url.="skeyword=".$_GET['skeyword']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>

<script>
$( "#print" ).click(function() {
    var buckets = new Array();
    $( "input[name='check[]']:checked" ).each( function() {
            buckets.push( $( this ).val() );
    } );

    if (buckets.length === 0){
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Select at least 1 order!',
            showConfirmButton: false,
            timer: 1500
        });
        
    }else{
        window.open('print.php?id='+buckets, '_blank');
    }

});
</script>