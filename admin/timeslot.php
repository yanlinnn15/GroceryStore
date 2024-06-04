<?php include('partials/header.php');?>
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
                        <h3 class="text-themecolor">Time Slot</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Time Slot</li>
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
                    $sql="SELECT * FROM timeslot where timeSlot!='' ";
                    $timeslotPage=10;
                    if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
                        $sql.=" AND (timeslot like '%".$_GET['skeyword']."%' or dprice like '%".$_GET['skeyword']."%' or timeRange like '%".$_GET['skeyword']."%' or numberOfSlot like '%".$_GET['skeyword']."%')";
                    }


                    $res=mysqli_query($conn,$sql); 
                    if($res){
                        $ttl=mysqli_num_rows($res);
                    }else{
                        $ttl=0;
                    }

                    $numPage = ceil($ttl/$timeslotPage);

                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page=$_GET['page'];
                    }else{
                        $page=1;
                    }

                    $starting_page_result=($page-1)*$timeslotPage;

                    $sql7=$sql." LIMIT ".$starting_page_result.','.$timeslotPage;

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
                                                <input type="text" class="searchTerm" placeholder="Search timeslot..." name="skey" <?php if(isset($_GET['skeyword'])){ ?> value="<?php echo $_GET['skeyword'];?>" <?php }?>>
                                                <button input type="submit" class="searchButton" name="submitsearch">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                           
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Time Range</th>
                                                <th>Slot</th>
                                                <th>Price (RM)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
			
                                            $c=0;
											while($row = mysqli_fetch_assoc($res7))
											{	
										?>
                                            <tr>
                                                <td><?php echo $row['timeSlot']?></td>
                                                <td><?php echo $row['timeRange']?></td>
                                                <td><?php echo $row['numberOfSlot']?></td>
                                                <td><?php echo $row['dprice']?></td>
                                                <td>
													<a href="edittimeslot.php?id=<?php echo $row['timeSlot']?>"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-pencil"></i></button></a>				
													<!--<a href="timeslot.php?del&bid=<?php echo $row['timeSlot']; ?>" onclick="return confirmation();" class="btn btn btn-danger delete_cat"><i class="fa fa-trash"></i></a></td>-->
								
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
                                $url="timeslot.php?";
                                
                                if(isset($_GET['skeyword'])){
                                    $url.="skeyword=".$_GET['skeyword']."&";
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
    $res= mysqli_query($conn, "select * from orderp where timeslot = $bid");
    if(mysqli_num_rows($res)<=0){
        //timeslot have no link to product
        $res2=mysqli_query($conn, "delete from timeslot where timeSlot = $bid");
        if($res2){
            $_SESSION['success']="Delete Successful!";
        }else{
            $_SESSION['wrong']="Something Went Wrong!";
        }
    }else{
        $_SESSION['fail']="Sorry, this timeslot cannot be deleted!";
    }

	header("Location: $url");
}


?>

<!-- delete confirmation -->
<script type="text/javascript">
    function confirmation()
    {
        answer = confirm("Do you want to delete this timeslot?");
        return answer;
    }
</script>

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
            header("location:".SITEURL."admin/timeslot.php?skeyword=".$keyw);
        }else{
            header("location:timeslot.php");
        }
    }
?>