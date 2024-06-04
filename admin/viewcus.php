<?php include('partials/header.php');?>
<style>
    body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
</style>

<?php

	if(isset($_POST['save'])){
		
		//get data from register form	
		$status=$_POST['status'];

        $sql1="UPDATE customer SET
            cstatus='$status'
            where cusID='".$_GET['cusid']."';
        ";

        $res1=mysqli_query($conn,$sql1);

        if($res1){
            $_SESSION['success']="Updated Successfully!";
        }else{
            $_SESSION['wrong']="Something went wrong!";

        }
    }
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
                        <h3 class="text-themecolor">Customer</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="customer.php">Customer</a></li>
                            <li class="breadcrumb-item active">View & Edit Customer</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                <?php if(isset($_GET['cusid'])){
                        $aid=$_GET['cusid'];
                        $sql2="SELECT * from customer where cusID='$aid'";
                        $res2=mysqli_query($conn,$sql2);
                        if($res2){
                            if(mysqli_num_rows($res2)==1){
                                $row1 = mysqli_fetch_assoc($res2);
                            ?>

                    
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                            <div class="container">
                                <div class="main-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column align-items-center text-center">
                                                        
                                                        <div class="mt-3">
                                                        <i class="fa fa-user-circle-o" aria-hidden="true" style="height: 120px; font-size:111px;"></i>
                                                            <h4>ID: <?php echo $row1['cusID']; ?></h4>
                                                            <p class="text-secondary mb-1">Created Date: <?php echo $row1['created_date']; ?> </p>
                                                            <!--<button class="btn btn-primary">Follow</button>
                                                            <button class="btn btn-outline-primary">Message</button>-->
                                                        </div>
                                                    </div>
                                                    <hr class="my-4">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h5 class="mb-0">First Name</h5>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <h4><?php echo $row1['cusFName']; ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h5 class="mb-0">Last Name</h5>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <h4><?php echo $row1['cusLName']; ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h5 class="mb-0">Gender</h5>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <h4><?php echo $row1['cusGender']; ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h5 class="mb-0">Email</h5>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                        <h4><?php echo $row1['cusEmail']; ?></h4>

                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h5 class="mb-0">Phone</h5>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            <h4><?php echo $row1['cusPhoneNo']; ?></h4>
                                                        </div>
                                                    </div>
                                                    <form method="post">
                                                        <div class="row mb-3">
                                                            <div class="col-sm-3">
                                                                <h5 class="mb-0">Account Status</h5>
                                                            </div>
                                                            <div class="col-sm-9 text-secondary">
                                                                    <select name="status" class="form-control">
                                                                    <?php if($row1['cstatus']=="1"){ ?>
                                                                        <option value="1" selected>Active</option>
                                                                    <?php }else{?>
                                                                        <option value="1">Active</option>

                                                                    <?php }
                                                                        if($row1['cstatus']=="0"){ ?>
                                                                            <option value="0" selected>Inactive</option>
                                                                        <?php }else{ ?>
                                                                            <option value="0">Inactive</option>
                                                                        <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-3"></div>
                                                            <div class="col-sm-9 text-secondary">
                                                                <input type="submit" class="btn btn-primary px-4" name="save" value="Save">
                                                            </div>
                                                        </div>

                                                        
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php 
                                        $sql="SELECT * FROM orderp,payment,timeslot,orderstatus,customer where orderp.orderID=payment.orderID and orderp.timeslot=timeslot.timeSlot and orderstatus.osID=orderp.status and orderp.cusID=customer.cusID and customer.cusID='".$_GET['cusid']."'";
                                        $orderpPage=5;
                                        if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
                                            $sql.=" AND (orderDate like '%".$_GET['skeyword']."%' or orderp.orderID like '%".$_GET['skeyword']."%' or totalPrice like '%".$_GET['skeyword']."%' or shipDate like '%".$_GET['skeyword']."%' or timeRange like '%".$_GET['skeyword']."%' or osName like '%".$_GET['skeyword']."%') ";
                                        }
                                        if(isset($_GET['sort']) && !empty($_GET['sort'])){
                                            $so=$_GET['sort'];
                                            $sql.=" and osID=$so ";
                                           
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
                                        <h3 class="text-themecolor">All Orders</h3>
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
                                                                <option value="" selected>All</option>
                                                                <?php 
                                                                $res11=mysqli_query($conn,'select * from orderstatus');
                                                                while($row11=mysqli_fetch_assoc($res11)){ ?>
                                                                <option value="<?php echo $row11['osID']; ?>" <?php if(isset($_GET['sort'])){if($row11['osID']==$_GET['sort']){ ?> selected <?php }} ?>><?php echo $row11['osName']; ?></option>
                                                                
                                                                <?php 
                                                                }
                                                                
                                                                ?>
                                                                
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
                                                                <th>Total Item(s)</th>
                                                                <th>Total (RM)</th>
                                                                <th>Ship Date</th>
                                                                <th>Ship Time</th>
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
                                                                <td><?php echo $row1['total']; ?></td>
                                                                <td><?php echo "RM ".$row['totalPrice']; ?></td>
                                                                <td><?php echo $row['shipDate']; ?></td>
                                                                <td><?php echo $row['timeRange']; ?></td>
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
                                                $id=$_GET['cusid']; 
                                                $url="viewcus.php?cusid=$id&";
                                                
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <!-- Column -->
                            </div>
                            <?php
                            }else{
                                header("location: pages-error-404.php");
                            }
                        }
                    }else{
                        header("location: pages-error-404.php");
                    }
               
                
                ?>
            <!-- Row -->
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
<?php 
include('partials/footer.php');
include('alert2.php');
?>

<script>
    function submit_form(){
        var form = document.getElementById("sort");
        form.submit();
    }
</script>

<!-- search form -->
<?php
    if(isset($_POST['submitsearch'])){

        $id=$_GET['cusid'];
        $keyw=$_POST['skey'];

        if(!empty(trim($keyw))){
            $keyw1=mysqli_real_escape_string($conn,$keyw);
            header("location:".SITEURL."admin/viewcus.php?cusid=$id&skeyword=".$keyw);
        }else{
            header("location:order-toship.php");
        }
    }
?>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){
        $id=$_GET['cusid'];

        $sort=$_POST['sort'];
        $url=SITEURL."admin/viewcus.php?cusid=$id&";

        if($_GET['skeyword']){
            $url.="skeyword=".$_GET['skeyword']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>