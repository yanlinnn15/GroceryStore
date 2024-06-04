<?php 
    include('partials/header.php');
?>

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
                        <h3 class="text-themecolor">Order Delivered</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="allorder.php">All Order</a></li>
                            <li class="breadcrumb-item active"><a href="order-delivered.php">Order Delivered</a></li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
				<?php 
                    $sql="SELECT * FROM orderp,payment,timeslot,orderstatus,customer where orderp.orderID=payment.orderID and orderp.timeslot=timeslot.timeSlot and orderstatus.osID=orderp.status and orderp.cusID=customer.cusID and orderp.status=4 ";
                    $orderpPage=25;
                    if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
                        $sql.=" AND (orderDate like '%".$_GET['skeyword']."%' or cusEmail like '%".$_GET['skeyword']."%' or orderp.orderID like '%".$_GET['skeyword']."%' or totalPrice like '%".$_GET['skeyword']."%' or shipDate like '%".$_GET['skeyword']."%' or timeRange like '%".$_GET['skeyword']."%' or osName like '%".$_GET['skeyword']."%') ";
                    }
                    if(isset($_GET['sort']) && !empty($_GET['sort'])){
                        switch($_GET['sort']){
                            case '1':
                                $sql.=" order by orderp.orderID desc";
                                break;
                            case '2':
                                $sql.=" order by orderp.orderID asc";
                                break;
                           
                                
                        }
                    }else{
                        $sql.=" order by orderp.orderID asc";
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

                    $sql7=$sql." LIMIT ".$starting_page_result.','.$orderpPage;

                    $res7=mysqli_query($conn,$sql7);
                    
                    ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="block">
                                    <form action="" method="post">
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
                                                <option value="1" <?php if(isset($_GET['sort'])){ if($_GET['sort']==1){?> selected <?php }} ?>>Sort by Descending</option>
                                                <option value="2" <?php if(isset($_GET['sort'])){ if($_GET['sort']==2){?> selected <?php }} ?>>Sort by Ascending</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Time</th>
                                                <th>Cus Email</th>
                                                <th>Total Item(s)</th>
                                                <th>Total (RM)</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
			
                                            $c=0;
											while($row = mysqli_fetch_assoc($res7))
											{	
                                                $res4=mysqli_query($conn,"SELECT count(*) as total FROM orderdetail where orderID='".$row['orderID']."'");
                                                $row1=mysqli_fetch_assoc($res4);
										?>
                                            <tr>
                                                <td><?php echo $row['orderID']; ?></td>
                                                <td><?php echo $row['orderDate']; ?></td>
                                                <td><?php echo $row['cusEmail']; ?></td>
                                                <td><?php echo $row1['total']; ?></td>
                                                <td><?php echo "RM ".$row['totalPrice']; ?></td>
                                                <td><button type="button" class="btn btn-unsuccess" style="font-size: 12px;"><?php echo $row['osName']; ?></button></td>
                                                <td>
                                                <!--<a href="editorderp.php?id=<?php echo $row['orderID']?>"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-file-pdf-o"></i></button></a>-->
                                                <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">-->
                                                <a href="ode.php?oid=<?php echo $row['orderID']?>"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-pencil"></i></button></a>    		
								
                                            </tr>
                                            <?php
											}
											?>

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
                                $url="order-delivered.php?";
                                
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
<?php

//delete
if (isset($_REQUEST["del"])) 
{
	$bid = $_REQUEST["bid"]; 
    $url=$_SERVER['HTTP_REFERER'];
    
    //check bid link with product or not
    $res= mysqli_query($conn, "select * from product where orderpID = $bid");
    if(mysqli_num_rows($res)<=0){
        //orderp have no link to product
        $res2=mysqli_query($conn, "delete from orderp where orderpID = $bid");
        if($res2){
            $_SESSION['success']="Delete Successful!";
        }else{
            $_SESSION['wrong']="Something Went Wrong!";
        }
    }else{
        $_SESSION['fail']="Sorry, this orderp cannot be deleted!";
    }

	header("Location: $url");
}


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
            header("location:".SITEURL."admin/order-delivered.php?skeyword=".$keyw);
        }else{
            header("location:order-delivered.php");
        }
    }
?>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."admin/order-delivered.php?";

        if($_GET['skeyword']){
            $url.="skeyword=".$_GET['skeyword']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>