<?php include('partials/header.php');?>
<script src="js/canvasjs/canvasjs.min.js"></script>
<style>
    body{
    font-size: 18px;
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#a8aef0,#929aed);
}

.bg-c-green {
    background: linear-gradient(45deg,#ffb3c2, #ff99ad);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#ffb380,#ffa366);
}

.bg-c-pink {
    background: linear-gradient(45deg,#6699ff,#4d88ff);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>
        </div>

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
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Sales Chart and browser state-->
                <!-- ============================================================== -->
                
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="container">
                        <div class="row">
                        <div class="col-md-4 col-xl-3">
                        <a href="adminlist.php">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    
                                    <h6 class="m-b-20">Admin</h6>
                                    <h2 class="text-right"><i class="fa fa-drivers-license-o f-left"></i><span><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from admin"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></h2>
                                    <p class="m-b-0"><span class="f-right">&nbsp;</span></p>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-md-4 col-xl-3">
                           <a href="product.php">
                           <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Product</h6>
                                    <h2 class="text-right"><i class="fa fa-shopping-bag f-left"></i><span><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from product"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></h2>
                                    <p class="m-b-0">In stock<span class="f-right"><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from product where pQty>0"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></p>
                                </div>
                            </div>
                           </a>
                        </div>
                        
                        <div class="col-md-4 col-xl-3">
                            <a href="category.php">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Category</h6>
                                    <h2 class="text-right"><i class="fa fa-list-alt f-left"></i><span><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from category"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></h2>
                                    <p class="m-b-0">&nbsp;</p>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-md-4 col-xl-3">
                            <a href="allorder.php">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Orders Received</h6>
                                    <h2 class="text-right"><i class="fa fa-file-text f-left"></i><span><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from orderp"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></h2>
                                    <p class="m-b-0">Completed Orders<span class="f-right"><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from orderp where status=5"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></p>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a href="customer.php">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Customer</h6>
                                    <h2 class="text-right"><i class="fa fa fa-user-o f-left"></i><span><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from customer"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></h2>
                                    <p class="m-b-0">&nbsp;</p>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-md-4 col-xl-3">

                            <a href="timeslot.php">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Time Slot</h6>
                                    <h2 class="text-right"><i class="fa fa-clock-o f-left"></i><span><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from timeslot"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></h2>
                                    <p class="m-b-0">&nbsp;</p>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-md-4 col-xl-3">
                            <a href="reviewproduct.php">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Review & Rating</h6>
                                    <h2 class="text-right"><i class="fa fa-comments f-left"></i><span><?php $res =mysqli_query($conn,"SELECT count(*) as 'total' from review"); $row=mysqli_fetch_assoc($res); echo $row=$row['total'];  ?></span></h2>
                                    <p class="m-b-0">&nbsp;</p>
                                </div>
                            </div>
                            </a>
                        </div>

                </div>
                <div>
                </div>
                </div>   
                </div>
                </div>
                </div>    
                </div>
                <div class="row">
                   <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                            <div id="chartTopsale" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

<?php include('partials/footer.php');?>

<!-- Total Sales in 10 day -->
<script>
window.onload = function() {

    var chart1 = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light2", 
        title: {
            text: "Sales in 10 Days"
        },
        axisY: {
            title: "Sales (RM)"
        },
        data: [{
            type: "line",
            yValueFormatString: "RM 0.00",
            indexLabel: "{y}",
            dataPoints: [
                <?php 
                    
                for($i=9;$i>=0;$i--){
                    $date=date('Y-m-d',strtotime("-$i days"));
                    $re=mysqli_query($conn,"SELECT sum(totalPrice) as ttl FROM orderp where status!=1 and status!=7 and CAST(orderDate AS DATE)='$date' group by CAST(orderDate AS DATE)");
                    $row1=mysqli_fetch_assoc($re); ?>
                    { y: <?php if(!empty($row1['ttl'])){echo $row1['ttl'];}else{echo "0.00";} ?>, label: "<?php echo $date; ?>" },

                <?php } ?>    
            ]
        }]
    });
    var chart2 = new CanvasJS.Chart("chartTopsale", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light2", 
        title:{
            text: "5 Best Selling Products in 30 days"
        },
        data: [{        
            type: "pie", 
            indexLabel: "{label} : {y}", 
            dataPoints: [ 
                <?php
                $result = mysqli_query($conn, "select pName,sum(qty) as 'Sale' from product, orderdetail, orderp where orderdetail.orderID=orderp.orderID and product.productID=orderdetail.productID and orderp.status!=1 and orderp.status!=7 and orderDate between CURRENT_TIMESTAMP - INTERVAL '29' DAY and CURRENT_TIMESTAMP group by product.productID order by sum(qty) desc limit 5;");
                while($row=mysqli_fetch_assoc($result)){ ?>
                { y: <?php echo $row['Sale']; ?>, label: "<?php echo $row['pName']; ?>" },
    <?php } ?>
            ]
            }]
        });
    chart1.render();
    chart2.render();

}
</script>
